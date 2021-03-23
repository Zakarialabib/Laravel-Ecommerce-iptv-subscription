<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseItem;
use App\Supplier;
use App\Payment;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all()->sortByDesc('created_at');
        return view('admin.purchases.index', compact('purchases'));
    }

    public function show($id)
    {
        $purchase = Purchase::find($id);
        return view('admin.purchases.show', compact('purchase'));
    }

    public function edit($id)
    {
        $purchase = Purchase::where('id', $id)->with('supplier', 'payment', 'purchaseItems')->first();
        return view('admin.purchases.edit', compact('purchase'));
    }

    public function create()
    {
        return view('admin.purchases.create', ['purchase' => new Purchase([
            'id' => null,
            'supplier' => Supplier::first(),
            'admin' => Auth::user(),
            'payment' => new Payment(['status' => 1, 'method' => 1, 'paid_amount' => 0, 'due' => 0, 'note' => '']),
            'reference' => null,
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0,
            'document' => null,
            'note' => null,
            'order' => null,
            'purchaseItems' => [],
        ])]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => '',
            'admin_id' => '',
            'reference' => '',
            'purchase_item_id' => '',
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

        //handle sale payment
        $payment = Auth::user()->payments()->create([
            'supplier_id' => $data['supplier_id'],
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
            $documentPath = $document->storeAs('purchases/documents', $data['reference'] . '-' . $documentName, 'local');
            $data['document'] = $data['reference'] . '-' . $documentName;
        }

        $purchase = Auth::user()->purchases()->create([
            'supplier_id' => $data['supplier_id'],
            'payment_id' => $payment->id,
            'reference' => $data['reference'],
            'subtotal' => $data['subtotal'],
            'tax' => $data['tax'],
            'total' => $data['total'],
            'note' => $data['note'],
            'document' => $data['document'] ?? null,
        ]);

        // update and create orderItems
        foreach ($data['purchase_item_id'] as $key => $purchase_item_id) {
            # code...
            $purchaseItem = PurchaseItem::find($purchase_item_id);
            if($purchaseItem)
            {
                $purchaseItem->update([
                    'supplier_id' => $data['supplier_id'],
                    'title' => $data['title'][$key],
                    'qty' => $data['qty'][$key],
                    'price' => $data['price'][$key],
                ]);
            }
            else
            {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'supplier_id' => $data['supplier_id'],
                    'title' => $data['title'][$key],
                    'qty' => $data['qty'][$key],
                    'price' => $data['price'][$key],
                ]);
            }
        }

        return redirect()->route('admin.purchases.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'supplier_id' => '',
            'admin_id' => '',
            'reference' => '',
            'purchase_item_id' => '',
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

        $purchase = Purchase::find($id);
        
        // handle purchase items

        if($purchase)
        {
            $purchaseItems = $purchase->purchaseItems;
    
            // delete deleted purchaseItems from DB
            foreach ($purchaseItems as $key => $purchaseItem) {
                # code...
                $filtered = array_filter($data['purchase_item_id'], function($purchase_item_id) use ($purchaseItem) {
                    return $purchase_item_id == $purchaseItem->id;
                });
    
                if(count($filtered) === 0)
                    $purchaseItem->delete();
            }
            // update and create purchaseItems
            foreach ($data['purchase_item_id'] as $key => $purchase_item_id) {
                # code...
                $purchaseItem = PurchaseItem::find($purchase_item_id);
                if($purchaseItem)
                {
                    $purchaseItem->update([
                        'supplier_id' => $data['supplier_id'],
                        'title' => $data['title'][$key],
                        'qty' => $data['qty'][$key],
                        'price' => $data['price'][$key],
                    ]);
                }
                else
                {
                    PurchaseItem::create([
                        'purchase_id' => $purchase->id,
                        'supplier_id' => $data['supplier_id'],
                        'title' => $data['title'][$key],
                        'qty' => $data['qty'][$key],
                        'price' => $data['price'][$key],
                    ]);
                }
            }

            // update payment
            $purchase->payment->update([
                'supplier_id' => $data['supplier_id'],
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
                $documentPath = $request->document->storeAs('purchases/documents', $data['reference'] . '-' . $documentName, 'local');
                 
                //update sale document
                $purchase->update(['document' => $data['reference'] . '-' . $documentName]);
            }

            // update sale
            $purchase->update([
                'supplier_id' => $data['supplier_id'],
                'admin_id' => Auth::user()->id,
                'payment_id' => $purchase->payment->id,
                'reference' => $data['reference'],
                'subtotal' => $data['subtotal'],
                'tax' => $data['tax'],
                'total' => $data['total'],
                'note' => $data['note'],
            ]);
        }

        return redirect()->route('admin.purchases.index');
    }
}
