<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index()
    {            
        $profils = Admin::all();
        return view('admin.profile.index',compact('profils'));
    }

    public function createProfile(){
        return view('admin.profile.createprofile');
    }
    public function registerProfil(Request $request){

        $request->validate([
            'username' => 'required|max:100',
            'email' => 'required|email',
            'name' => 'required|max:100',
            'image' => 'mimes:jpeg,jpg,png',
            'password' => 'required|min:8|confirmed',
        ]);

      $adminprofile = new Admin();

        if($request->hasFile('image')){
            @unlink('assets/front/img/'. $adminprofile->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'adminProfile_'.time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);
            $adminprofile->image = $image;
        }

       $adminprofile->username = $request->username;
       $adminprofile->email = $request->email;
       $adminprofile->name = $request->name;
       $adminprofile->password = bcrypt($request->password);
       $adminprofile['is_active'] = true;
       $adminprofile->save();

       $notification = array(
        'messege' => 'Admin Profile Created successfully!',
        'alert' => 'success'
    );
    return redirect()->back()->with('notification', $notification);
    }


    public function editProfile(){
        return view('admin.profile.editprofile');
    }

    // Update Admin Profile
    public function updateProfile(Request $request){
        
        $request->validate([
            'username' => 'required|max:100',
            'email' => 'required|email',
            'name' => 'required|max:100',
            'image' => 'mimes:jpeg,jpg,png',
            'password' => 'required|min:8|confirmed',
        ]);

        $adminprofile = Admin::first();
            
        if($request->hasFile('image')){
           @unlink('assets/front/img/'. $adminprofile->image);
           $file = $request->file('image');
           $extension = $file->getClientOriginalExtension();
           $image = 'adminProfile_'.time().rand().'.'.$extension;
           $file->move('assets/front/img/', $image);
           $adminprofile->image = $image;
       }

       $adminprofile->username = $request->username;
       $adminprofile->email = $request->email;
       $adminprofile->name = $request->name;
       $user->password = bcrypt($request->password);
       $adminprofile->save();

       $notification = array(
        'messege' => 'Admin Profile Updated successfully!',
        'alert' => 'success'
    );
    return redirect()->back()->with('notification', $notification);
    }

    // Edit Admin Password
    public function editPassword(){
        return view('admin.profile.changepass');
    }

    public function updatePassword(Request $request) {
        $messages = [
            'password.required' => 'The new password field is required',
            'password.confirmed' => "Password does'nt match"
        ];
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ], $messages);
        // if given old password matches with the password of this authenticated user...
        if(Hash::check($request->old_password, Auth::guard('admin')->user()->password)) {
            $oldPassMatch = 'matched';
        } else {
            $oldPassMatch = 'not_matched';
        }
        if ($validator->fails() || $oldPassMatch=='not_matched') {
            if($oldPassMatch == 'not_matched') {
              $validator->errors()->add('oldPassMatch', true);
            }
            return redirect()->route('admin.editPassword')
                        ->withErrors($validator);
        }
  
        // updating password in database...
        $user = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
  
        $notification = array(
            'messege' => 'Password changed successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
      }

      public function active(Request $request, $id) {
        Admin::where('is_active', 1)->update(['is_active' => 0]);
        $profil = Admin::find($id);
        $profil->is_active = 1;
        $profil->save();
  
        $notification = array(
          'messege' => 'profil is deactivated.',
          'alert' => 'success'
        );
  
        return redirect()->route('admin.profil.index')->with('notification', $notification);
  
      }
}
