<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Package;
use App\Billpaid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helpers\MailSend;
use App\Emailsetting;


class RegisterUserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.register_user.index',compact('users'));
    }

    public function view($id)
    {
       
        $user = User::findOrFail($id);
        $package = Package::find($user->activepackage);
        $bills = Billpaid::with('user', 'package')->where('user_id', $id)->orderBy('id', 'DESC')->paginate(10);

    
        return view('admin.register_user.details',compact('user','package', 'bills'));

    }

    public function createProfile(Request $request){

        $user = User::all();
        return view('admin.register_user.create', compact('user'));
    }

    
    public function storeProfile(Request $request){


        $emailsetting = Emailsetting::first();

        $data = $request->validate([
            'photo' => 'mimes:jpeg,jpg,png',
            'name' => 'required:string|max:60',
            'phone'=> 'required|numeric',
            'address'=> 'required|max:150',
            'country'=> 'required|max:50',
            'city'=> 'required|max:50',
            'email'=> 'required|max:50',

        ]);

        if($request->hasFile('photo')){
            @unlink('assets/front/img/'. $user->photo);
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $photo = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $photo);

            $user->photo = $photo;
        }
    
        $password = Str::random(10);

        $token = md5(time().$data['name'].$data['email']);

        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'country' => $data['country'],
            'city' => $data['city'],
            'email' => $data['email'],
            'document' => null,
            'token' => $token,
            'password' => bcrypt( $password ),
            'email_verify_token' => $token,
        ]);

        if($emailsetting->is_verification_email == 1)
        {
        $to = $request->email;
        $subject = 'Your Account is created successfully.';
        $msg = "Dear Customer,  <br> Your Password is ".$password." <br> We noticed that you need to verify your email address. <a href=".route('user.register.token',$token).">Simply click here to verify. </a>";


        if($emailsetting->is_smtp == 1){
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new MailSend();
            $mailer->sendCustomMail($data);
            $notification = array(
                'messege' => 'Email Sent  successfully!',
                'alert' => 'success'
            );
            return redirect()->back()->with('notification', $notification);
        }else{
        $notification = array(
            'messege' => 'Profile created successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }
    }
    }


    public function editProfile(Request $request){

        $user = User::find($request->id);
        
        return view('admin.register_user.edit', compact('user'));
    }

    public function updateProfile(Request $request, $id){
     

        $user = User::where('id', $id)->first();

        $data = $request->except('document');

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

        foreach ($document as $key => $file) {
            if ($file) {
                $v = Validator::make(
                    [
                        'extension' => strtolower($file->getClientOriginalExtension()),
                    ],
                    [
                        'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                    ]
                );
                if ($v->fails())
                    return redirect()->back()->withErrors($v->errors());
                
                $documentName = $file->getClientOriginalName();
                $file->move('assets/admin/users/documents/', $documentName);
                // store in database
                $data['document'] = $documentName;
            }
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
        $user->document = $data['document'];
        $user->save();

        $notification = array(
            'messege' => 'Profile updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function package_buy(){
        $activeusers = User::whereNotNull('activepackage')->get();
        return view('admin.register_user.package-buy', compact('activeusers'));
    }

    public function package_not_buy(){
        $dactiveusers = User::where('activepackage', NULL)->get();

        return view('admin.register_user.package-not-buy', compact('dactiveusers'));
    }


    public function userban(Request $request)
    {

        $user = User::findOrFail($request->user_id);
        $user->update([
            'status' => $request->status,
        ]);

        Session::flash('success', $user->username.' status update successfully!');
        return back();



    }
}
