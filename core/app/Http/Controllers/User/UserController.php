<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Package;
use App\Billpaid;
use App\Packageorder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductOrder;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
        public function index()
    {
        $packagedetail = Package::where('id', Auth::user()->activepackage)->first();
        return view('user.dashboard',compact('packagedetail'));
    }

    public function editprofile(){
        return view('user.editprofile');
    }

    public function updateprofile(Request $request, $id){
     
        $data = $request->except('document');

        $user = User::where('id', $id)->first();
        $request->validate([
            'photo' => 'mimes:jpeg,jpg,png',
            'name' => 'required:string|max:60',
            'phone'=> 'required|numeric',
            'address'=> 'required|max:150',
            'country'=> 'required|max:50',
            'city'=> 'required|max:50',
            'email'=> 'required|max:50',
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
            $document->move('public/documents/users', $documentName);
            $data['document'] = $documentName;
        }
        if($request->hasFile('photo')){
            @unlink('assets/front/img/'. $user->photo);
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $photo = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $photo);

            $user->photo = $photo;
        }

        $user->name = $data['name'];
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->country = $data['country'];
        $user->city = $data['city'];
        $user->email = $data['email'];
        $user->save();

        $notification = array(
            'messege' => 'Profile updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function packageorder(){
        $order = Packageorder::where('user_id', Auth::user()->id)->first();
        return view('user.packageorder', compact('order'));
    }

    public function bill_pay(){
        
        $bills = Billpaid::with('user', 'package')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        
        return view('user.billpay', compact('bills'));
    }

    public function billpay_view($id){
       
        $data['bill'] = Billpaid::with('user', 'package')->where('id', $id)->first();
        return response()->json($data);
    }

    public function change_password(){
        return view('user.change-password');
    }

    public function update_password(Request $request, $id){

        $user = User::where('id', $id)->first();

     

        $messages = [
            'password.required' => 'The new password field is required',
            'password.confirmed' => "Password does'nt match"
        ];
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ], $messages);

        if(Hash::check($request->old_password, $user->password)) {
            $oldPassMatch = 'matched';
        } else {
            $oldPassMatch = 'not_matched';
        }
        if ($validator->fails() || $oldPassMatch=='not_matched') {
            if($oldPassMatch == 'not_matched') {
              $validator->errors()->add('oldPassMatch', true);
            }
            return redirect()->route('user.change_password')
                        ->withErrors($validator);
        }


        $user->password = bcrypt($request->password);
        $user->save();


        $notification = array(
            'messege' => 'User password updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }

    public function product_order(){
        $setting = Setting::first();
        if($setting->is_shop_page == 0){
            return back();
        }

        $orders = ProductOrder::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('user.product-order', compact('orders'));
    }

    public function product_order_details($id){

      
        $setting = Setting::first();
        if($setting->is_shop_page == 0){
            return back();
        }

        $data = ProductOrder::findOrFail($id);

        return view('user.product-order-details', compact('data') );
    }
}
