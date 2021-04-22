<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\ProductOrder;
use App\OrderItem;
use App\User;
use App\Sale;
use App\Payment;
use App\Packageorder;
use App\Package;
use App\Plan;

class SaleController extends Controller
{
    public function clients()
    {
        $clients = User::has('sales')
        ->with(['sales' => function($query) {
            $query->packages()->latest();
        }])->get();

        return view('admin.sales.clients.index', compact('clients'));
    }

    public function clientShow($id)
    {
        $user = User::where('id', $id)->with(['sales' => function($query){
            $query->packages()->latest();
        }])->first();

        return view('admin.sales.clients.show', ['user' => $user]);
    }

    public function packageRenew(Request $request)
    {
        $data = $request->validate([
            'sale_id' => '',
            'plan' => '',
        ]);

        $sale = Sale::find($data['sale_id']);
        //$sale = Sale::find(18);

        if($sale)
        {
            if(Carbon::now()->lt($sale->packageOrder->end_date))
            {
                $startDate = $sale->packageOrder->end_date;
            }
            else
            {
                $startDate = Carbon::now();
            }

            $endDate = SaleController::calculateEndDate($startDate, $data['plan']);

            $packagePlan = SaleController::getPackagePlan($sale, $data['plan']);

            if(!$packagePlan)
            {
                $notification = array(
                    'messege' => 'Plan not found',
                    'alert' => 'error'
                );
            } 
            else 
            {
                $packageCost = $packagePlan->price + $packagePlan->price * $sale->tax / 100;
                
                //handle sale payment
                $payment = Auth::user()->payments()->create([
                    'user_id' => $sale->user->id,
                    'reference' => mt_rand(1000000000, 9999999999),
                    'status' => Payment::STATUS_PAID,
                    'method' => Payment::METHOD_CASH,
                    'paid_amount' => $packageCost,
                    'due' => 0,
                    'note' => '',
                ]);
    
                $newSale = Auth::user()->sales()->create([
                    'user_id' => $sale->user->id,
                    'payment_id' => $payment->id,
                    'reference' => SaleController::generatePackageReference(),
                    'subtotal' => $packagePlan->price,
                    'tax' => $sale->tax,
                    'total' => $packageCost,
                    'note' => '',
                    'document' => null,
                    'is_product' => false,
                ]);
    
                $newSale->packageOrder()->create([
                    'plan_id' => $packagePlan->id,
                    'package_id' => $sale->packageOrder->package->id,
                    'user_id' => $newSale->user->id,
                    'package_cost' => $packageCost,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'package_status' => Packageorder::ACTIVE,
                ]);
    
                $notification = array(
                    'messege' => 'Package Renew Success',
                    'alert' => 'success'
                );
            }

        }

        return redirect()->back()->with('notification', $notification);
    }

    public function updateLock(Request $request)
    {
        try {
            $data = $request->validate([
                'sale_id' => '',
                'status' => '',
            ]);
            $sale = Sale::find($data['sale_id'])->update([
                'is_locked' => $data['status'],
            ]);
    
            return response(['sale' => $sale], 200);
        } catch (\Throwable $th) {
            return response(['sale' => null], 500);
        }
    }

    public function productShow($id) 
    {
        $sale = Sale::find($id);
        return view('admin.sales.products.show', compact('sale'));

    }
    public function products()
    {
        $sales = Sale::products()->orderBy('created_at')->get();
        return view('admin.sales.products.index', compact('sales'));
    }

    public function productCreate(Request $request)
    {
        if($request->order) {
            $order = ProductOrder::where('id', $request->order)->with('orderitems', 'user')->first();
            $sale = new Sale([
                'id' => null,
                'user' => $order->user,
                'admin' => Auth::user(),
                'payment' => new Payment(['status' => 1, 'method' => 1, 'paid_amount' => 0, 'due' => 0, 'note' => '']),
                'reference' => SaleController::generateProductReference(),
                'subtotal' => 0,
                'tax' => 0,
                'total' => 0,
                'document' => null,
                'note' => null,
                'order' => $order,
                'orderitems' => $order->orderitems,
            ]);
            return view('admin.sales.products.create', compact('sale'));
        }
        return view('admin.sales.products.create', ['sale' => new Sale([
            'id' => null,
            'user' => User::first(),
            'admin' => Auth::user(),
            'payment' => new Payment(['status' => 1, 'method' => 1, 'paid_amount' => 0, 'due' => 0, 'note' => '']),
            'reference' => SaleController::generateProductReference(),
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0,
            'document' => null,
            'note' => null,
            'order' => null,
            'orderitems' => [],
        ])]);
    }

    public function productStore(Request $request)
    {
        $data = $request->validate([
            'user_id' => '',
            'admin_id' => '',
            'order_id' => '',
            'reference' => '',
            'order_item_id' => '',
            'product_id' => '',
            'title' => '',
            'price' => '',
            'qty' => '',
            'subtotal' => '',
            'tax' => '',
            'total' => '',
            'note' => '',
            'payment_status' => '',
            'payment_method' => '',
            'paid_amount' => '',
            'due' => '',
            'payment_note' => '',
        ]);

        //dd($data);

        //handle sale payment
        $payment = Auth::user()->payments()->create([
            'user_id' => $data['user_id'],
            'reference' => mt_rand(1000000000, 9999999999),
            'status' => $data['payment_status'],
            'method' => $data['payment_method'],
            'paid_amount' => $data['paid_amount'],
            'due' => $data['due'],
            'note' => $data['payment_note'],
        ]);

        $document = $request->document;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails())
                return redirect()->back()->withErrors($v->errors());

            $documentName = $document->getClientOriginalName();
            $documentPath = $document->storeAs('sales/documents', $data['reference'] . '-' . $documentName, 'local');
            $data['document'] = $data['reference'] . '-' . $documentName;
        }

        $sale = Auth::user()->sales()->create([
            'user_id' => $data['user_id'],
            'payment_id' => $payment->id,
            'reference' => $data['reference'],
            'subtotal' => $data['subtotal'],
            'tax' => $data['tax'],
            'total' => $data['total'],
            'note' => $data['note'],
            'document' => $data['document'] ?? null,
        ]);

        if($data['order_id'])
        {
            // update order
            ProductOrder::find($data['order_id'])->update(['sale_id' => $sale->id]);

            // handle order items
            $productOrder = ProductOrder::find($data['order_id']);
    
            if($productOrder)
            {
                $orderItems = $productOrder->orderitems;
        
                // delete deleted orderItems from DB
                foreach ($orderItems as $key => $orderItem) {
                    # code...
                    $filtered = array_filter($data['order_item_id'], function($order_item_id) use ($orderItem) {
                        return $order_item_id == $orderItem->id;
                    });
        
                    if(count($filtered) === 0)
                        $orderItem->delete();
                }
            }
        }


        // update and create orderItems
        foreach ($data['order_item_id'] as $key => $order_item_id) {
            # code...
            $orderItem = OrderItem::find($order_item_id);
            if($orderItem)
            {
                $orderItem->update([
                    'sale_id' => $sale->id,
                    'product_order_id' => $data['order_id'],
                    'product_id' => $data['product_id'][$key],
                    'user_id' => $data['user_id'],
                    'title' => $data['title'][$key],
                    'qty' => $data['qty'][$key],
                    'price' => $data['price'][$key],
                ]);
            }
            else
            {
                OrderItem::create([
                    'sale_id' => $sale->id,
                    'product_order_id' => $data['order_id'],
                    'product_id' => $data['product_id'][$key],
                    'user_id' => $data['user_id'],
                    'title' => $data['title'][$key],
                    'qty' => $data['qty'][$key],
                    'price' => $data['price'][$key],
                ]);
            }
        }

        return redirect()->route('admin.sales.products.index');
    }

    public function productEdit($id) {
        $sale = Sale::where('id', $id)->with('user', 'order', 'payment', 'orderitems')->first();

        //dd($sale);
        return view('admin.sales.products.edit', compact('sale'));
    }

    public function productUpdate(Request $request, $id) 
    {
        $data = $request->validate([
            'user_id' => '',
            'admin_id' => '',
            'order_id' => '',
            'reference' => '',
            'order_item_id' => '',
            'product_id' => '',
            'title' => '',
            'price' => '',
            'qty' => '',
            'subtotal' => '',
            'tax' => '',
            'total' => '',
            'note' => '',
            'payment_status' => '',
            'payment_method' => '',
            'paid_amount' => '',
            'due' => '',
            'payment_note' => '',
        ]);

        $sale = Sale::find($id);
        
        // handle order items

        if($sale)
        {
            $orderItems = $sale->orderitems;
    
            // delete deleted orderItems from DB
            foreach ($orderItems as $key => $orderItem) {
                # code...
                $filtered = array_filter($data['order_item_id'], function($order_item_id) use ($orderItem) {
                    return $order_item_id == $orderItem->id;
                });
    
                if(count($filtered) === 0)
                    $orderItem->delete();
            }
            // update and create orderItems
            foreach ($data['order_item_id'] as $key => $order_item_id) {
                # code...
                $orderItem = OrderItem::find($order_item_id);
                if($orderItem)
                {
                    $orderItem->update([
                        'sale_id' => $sale->id,
                        'product_order_id' => $data['order_id'] ?? null,
                        'product_id' => $data['product_id'][$key],
                        'user_id' => $data['user_id'],
                        'title' => $data['title'][$key],
                        'qty' => $data['qty'][$key],
                        'price' => $data['price'][$key],
                    ]);
                }
                else
                {
                    OrderItem::create([
                        'sale_id' => $sale->id,
                        'product_order_id' => $data['order_id'] ?? null,
                        'product_id' => $data['product_id'][$key],
                        'user_id' => $data['user_id'],
                        'title' => $data['title'][$key],
                        'qty' => $data['qty'][$key],
                        'price' => $data['price'][$key],
                    ]);
                }
            }

            // update payment
            $sale->payment->update([
                'user_id' => $data['user_id'],
                'admin_id' => Auth::user()->id,
                'status' => $data['payment_status'],
                'method' => $data['payment_method'],
                'paid_amount' => $data['paid_amount'],
                'due' => $data['due'],
                'note' => $data['payment_note'],
            ]);

            //update document
            if($request->document)
            {
                $v = Validator::make(
                    [
                        'extension' => strtolower($request->document->getClientOriginalExtension()),
                    ],
                    [
                        'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                    ]
                );
                if ($v->fails())
                    return redirect()->back()->withErrors($v->errors());
    
                $documentName = $request->document->getClientOriginalName();
                $documentPath = $request->document->storeAs('sales/documents', $data['reference'] . '-' . $documentName, 'local');
                 
                //update sale document
                $sale->update(['document' => $data['reference'] . '-' . $documentName]);
            }

            // update sale
            $sale->update([
                'user_id' => $data['user_id'],
                'admin_id' => Auth::user()->id,
                'payment_id' => $sale->payment->id,
                'reference' => $data['reference'],
                'subtotal' => $data['subtotal'],
                'tax' => $data['tax'],
                'total' => $data['total'],
                'note' => $data['note'],
            ]);
        }

        return redirect()->route('admin.sales.products.index');

    }

    public function deleteSaleFile($id)
    {
        try {
            //code...
            $sale = Sale::find($id);
            $status = Storage::disk('local')->delete('sales/documents/'.$sale->document);
            if($status) {
                $sale->update(['document' => null]);
                return response(['status' => $status], 200);
            }
            return response(['status' => $status], 404);
        } catch (\Throwable $th) {
            return response(['status' => null], 500);
        }
        
    }

    public function packages()
    {
        $sales = Sale::packages()->orderBy('created_at')->get();
        return view('admin.sales.packages.index', compact('sales'));
    }

    public function packageCreate(Request $request)
    {

        if($request->order) {
            $order = Packageorder::where('id', $request->order)->with('package', 'user', 'plan')->first();
            $sale = new Sale([
                'id' => null,
                'user' => $order->user,
                'admin' => Auth::user(),
                'payment' => new Payment(['status' => 1, 'method' => 1, 'paid_amount' => 0, 'due' => 0, 'note' => '']),
                'reference' => SaleController::generatePackageReference(),
                'subtotal' => 0,
                'tax' => 0,
                'total' => 0,
                'document' => null,
                'note' => null,
                'package_order' => $order,
            ]);
            return view('admin.sales.packages.create', compact('sale'));
        }
        return view('admin.sales.packages.create', [
            'sale' => new Sale([
                'id' => null,
                'user' => User::first(),
                'admin' => Auth::user(),
                'payment' => new Payment(['status' => 1, 'method' => 1, 'paid_amount' => 0, 'due' => 0, 'note' => '']),
                'reference' => SaleController::generatePackageReference(),
                'subtotal' => 0,
                'tax' => 0,
                'total' => 0,
                'document' => null,
                'note' => null,
                'package_order' => new Packageorder([
                    'id' => null,
                    'user' => User::first(),
                    'plan' => new Plan([
                        'id' => null,
                        'type' => 1,
                        'price' => 0,
                    ]),
                    'package' => new Package([
                        'id' => -1,
                        'name' => '',
                    ]),
                    'start_date' => Carbon::now()->format('Y-m-d'),
                    'package_status' => 1,
                ]),
            ])
        ]);
    }

    public function packageStore(Request $request)
    {
        $data = $request->validate([
            'user_id' => '',
            'admin_id' => '',
            'order_id' => '',
            'reference' => '',
            'package_id' => '',
            'name' => '',
            'plan_id' => '',
            'plan_type' => '',
            'plan_price' => '',
            'start_date' => '',
            'package_status' => '',
            'subtotal' => '',
            'tax' => '',
            'total' => '',
            'note' => '',
            'payment_status' => '',
            'payment_method' => '',
            'paid_amount' => '',
            'due' => '',
            'payment_note' => '',
        ]);

        //handle sale payment
        $payment = Auth::user()->payments()->create([
            'user_id' => $data['user_id'],
            'reference' => mt_rand(1000000000, 9999999999),
            'status' => $data['payment_status'],
            'method' => $data['payment_method'],
            'paid_amount' => $data['paid_amount'],
            'due' => $data['due'],
            'note' => $data['payment_note'],
        ]);

        $document = $request->document;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails())
                return redirect()->back()->withErrors($v->errors());

            $documentName = $document->getClientOriginalName();
            $documentPath = $document->storeAs('sales/documents', $data['reference'] . '-' . $documentName, 'local');
            $data['document'] = $data['reference'] . '-' . $documentName;
        }

        $sale = Auth::user()->sales()->create([
            'user_id' => $data['user_id'],
            'payment_id' => $payment->id,
            'reference' => $data['reference'],
            'subtotal' => $data['subtotal'],
            'tax' => $data['tax'],
            'total' => $data['total'],
            'note' => $data['note'],
            'document' => $data['document'] ?? null,
            'is_product' => false,
        ]);

        if($data['order_id'])
        {
            // update order
            PackageOrder::find($data['order_id'])->update([
                'sale_id' => $sale->id,
                'plan_id' => $data['plan_id'],
                'package_id' => $data['package_id'],
                'user_id' => $data['user_id'],
                'package_cost' => $data['total'],
                'start_date' => $data['start_date'],
                'end_date' => SaleController::calculateEndDate($data['start_date'], $data['plan_type']),
                'package_status' => $data['package_status'],
            ]);
        }
        else 
        {
            PackageOrder::create([
                'sale_id' => $sale->id,
                'plan_id' => $data['plan_id'],
                'package_id' => $data['package_id'],
                'user_id' => $data['user_id'],
                'package_cost' => $data['total'],
                'start_date' => $data['start_date'],
                'end_date' => SaleController::calculateEndDate($data['start_date'], $data['plan_type']),
                'package_status' => $data['package_status'],
            ]);
        }

        return redirect()->route('admin.sales.packages.index');
    }

    public function packageEdit($id) {
        $sale = Sale::where('id', $id)->with('user', 'payment', 'packageOrder.plan', 'packageOrder.package.plans')->first();
        return view('admin.sales.packages.edit', compact('sale'));
    }

    public function packageUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'user_id' => '',
            'admin_id' => '',
            'order_id' => '',
            'reference' => '',
            'package_id' => '',
            'name' => '',
            'plan_id' => '',
            'plan_type' => '',
            'plan_price' => '',
            'start_date' => '',
            'package_status' => '',
            'subtotal' => '',
            'tax' => '',
            'total' => '',
            'note' => '',
            'payment_status' => '',
            'payment_method' => '',
            'paid_amount' => '',
            'due' => '',
            'payment_note' => '',
        ]);

        $sale = Sale::find($id);
        
        if($sale)
        {
            $sale->packageOrder()->update([
                'user_id' => $data['user_id'],
                'package_id' => $data['package_id'],
                'plan_id' => $data['plan_id'],
                'package_cost' => $data['total'],
                'start_date' => $data['start_date'],
                'end_date' => SaleController::calculateEndDate($data['start_date'], $data['plan_type']),
                'package_status' => $data['package_status'],
            ]);
            // update payment
            $sale->payment->update([
                'user_id' => $data['user_id'],
                'admin_id' => Auth::user()->id,
                'status' => $data['payment_status'],
                'method' => $data['payment_method'],
                'paid_amount' => $data['paid_amount'],
                'due' => $data['due'],
                'note' => $data['payment_note'],
            ]);

            //update document
            if($request->document)
            {
                $v = Validator::make(
                    [
                        'extension' => strtolower($request->document->getClientOriginalExtension()),
                    ],
                    [
                        'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                    ]
                );
                if ($v->fails())
                    return redirect()->back()->withErrors($v->errors());
    
                $documentName = $request->document->getClientOriginalName();
                $documentPath = $request->document->storeAs('sales/documents', $data['reference'] . '-' . $documentName, 'local');
                 
                //update sale document
                $sale->update(['document' => $data['reference'] . '-' . $documentName]);
            }

            // update sale
            $sale->update([
                'user_id' => $data['user_id'],
                'admin_id' => Auth::user()->id,
                'payment_id' => $sale->payment->id,
                'reference' => $data['reference'],
                'subtotal' => $data['subtotal'],
                'tax' => $data['tax'],
                'total' => $data['total'],
                'note' => $data['note'],
            ]);
        }

        return redirect()->route('admin.sales.packages.index');
    }

    public function packageShow($id)
    {
        $sale = Sale::find($id);
        return view('admin.sales.packages.show', compact('sale'));
    }

    public static function generatePackageReference()
    {
        $latest = Sale::packages()->latest()->first();
        $latest->reference++;
        return $latest->reference;
    }

    public static function generateProductReference()
    {
        $latest = Sale::products()->latest()->first();
        $latest->reference++;
        return $latest->reference;
    }

    public static function calculateEndDate($startDate, $planType)
    {
        //dd(number_format($planType));
        switch (number_format($planType)) {
            case Plan::MONTHLY_PLAN:
                $endDate = Carbon::parse($startDate)->addMonths(1);
                break;
            case Plan::QUARTER_PLAN:
                $endDate = Carbon::parse($startDate)->addMonths(3);
                break;
            case Plan::SEMIANNUAL_PLAN:
                $endDate = Carbon::parse($startDate)->addMonths(6);
                break;
            case Plan::ANNUAL_PLAN:
                $endDate = Carbon::parse($startDate)->addMonths(12);
                break;
            
            default:
                $endDate = Carbon::parse($startDate)->addMonths(1);
                break;
        }

        return $endDate;
    }

    public static function getPackagePlan($sale, $planType)
    {
        $plans = $sale->packageOrder->package->plans;

        $plan = $plans->filter(function ($plan) use($planType) {
            return $plan->type == $planType;
        });

        return $plan->first();
    }
}
