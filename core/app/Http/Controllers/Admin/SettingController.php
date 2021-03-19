<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Setting;
use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
   public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function basicinfo(Request $request){
        $lang = Language::where('code', $request->language)->first()->id;
        $basicinfo = Setting::where('language_id', $lang)->first();
        $commoninfo = Setting::where('id', 1)->first();
        return view('admin.settings.basicinfo', compact('basicinfo', 'commoninfo'));
    }

    ///Update Basic Info
    public function updateCommoninfo(Request $request){
       
       
         $request->validate([
            'number' => 'required|max:250',
            'email' => 'required|max:250',
            'contactemail' => 'required|max:250',
            'base_color' => 'required',
            'header_logo' => 'mimes:jpeg,jpg,png',
            'fav_icon' => 'mimes:jpeg,jpg,png',
            'breadcrumb_image' => 'mimes:jpeg,jpg,png'
         ]);

      
         $commoninfo = Setting::where('id', 1)->first();
       
         if($request->hasFile('header_logo')){
            @unlink('assets/front/img/'. $commoninfo->header_logo);
            $file = $request->file('header_logo');
            $extension = $file->getClientOriginalExtension();
            $header_logo = 'header_logo_'.time().rand().'.'.$extension;
            $file->move('assets/front/img/', $header_logo);
            $commoninfo->header_logo = $header_logo;
        }
        
         if($request->hasFile('fav_icon')){
            @unlink('assets/front/img/'. $commoninfo->fav_icon);
            $file = $request->file('fav_icon');
            $extension = $file->getClientOriginalExtension();
            $fav_icon = 'fav_icon_'.time().rand().'.'.$extension;
            $file->move('assets/front/img/', $fav_icon);
            $commoninfo->fav_icon = $fav_icon;
        }

         if($request->hasFile('breadcrumb_image')){
            @unlink('assets/front/img/'. $commoninfo->breadcrumb_image);
            $file = $request->file('breadcrumb_image');
            $extension = $file->getClientOriginalExtension();
            $breadcrumb_image = 'breadcrumb_image_'.'.'.$extension;
            $file->move('assets/front/img/', $breadcrumb_image);
            $commoninfo->breadcrumb_image = $breadcrumb_image;
        }

        $commoninfo->number = $request->number;
        $commoninfo->email = $request->email;
        $commoninfo->contactemail = $request->contactemail;

        $new_base_color = ltrim($request->base_color, '#');
        $commoninfo->base_color = $new_base_color;


        $commoninfo->save();

         $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.basicinfo').'?language='.$this->lang->code)->with('notification', $notification);
    }

    // Update Section Title
    public function sectiontitle(){
       return view('admin.settings.sectiontitle');
    }
    public function updateSectiontitle(Request $request){
      
       $request->validate([
         'education_title' => 'required|max:150',
         'experince_title' => 'required|max:150',
         'service_title' => 'required|max:150',
         'portfolio_title' => 'required|max:150',
         'resume_title' => 'required|max:150',
         'client_title' => 'required|max:150',
         'testimonial_title' => 'required|max:150',
         'blog_title' => 'required|max:150',
         'contact_title' => 'required|max:150',
       ]);

       $basicsettings = Setting::first();

       $basicsettings->education_title = $request->education_title;
       $basicsettings->experince_title = $request->experince_title;
       $basicsettings->service_title = $request->service_title;
       $basicsettings->portfolio_title = $request->portfolio_title;
       $basicsettings->resume_title = $request->resume_title;
       $basicsettings->client_title = $request->client_title;
       $basicsettings->testimonial_title = $request->testimonial_title;
       $basicsettings->blog_title = $request->blog_title;
       $basicsettings->contact_title = $request->contact_title;
       $basicsettings->save();

       Session::flash('success', 'Section title Updated Successfully!');
       return redirect()->route('admin.sectiontitle');

    }

    // Update SEO Information
    public function seoinfo(Request $request){
      $lang = Language::where('code', $request->language)->first()->id;
      $seo = Setting::where('language_id', $lang)->first();
       return view('admin.settings.seo', compact('seo'));
    }
    public function updateSeoinfo(Request $request, $id){
      
      $seo = Setting::where('language_id', $id)->first();

      $seo->meta_keywords = $request->meta_keywords;
      $seo->meta_description = $request->meta_description;
      $seo->save();

      $notification = array(
         'messege' => 'SEO Info Updated Successfully!',
         'alert' => 'success'
     );
     return redirect(route('admin.seoinfo').'?language='.$this->lang->code)->with('notification', $notification);

   }

   // Update General Settings
   public function gsettings(){
      return view('admin.settings.gsettings');
   }

   // Update Scripts
   public function scripts(){
      return view('admin.settings.scripts');
   }

   public function updateScripts(Request $request){

    

      $scriptsettings = Setting::first();


      $scriptsettings->disqus = $request->disqus;
      $scriptsettings->tawk_to = $request->tawk_to;

      
      
      if($request->is_tawk_to == 'on'){
         $scriptsettings->is_tawk_to = 1;
      }else{
         $scriptsettings->is_tawk_to = 0;
      }

      if($request->is_disqus == 'on'){
         $scriptsettings->is_disqus = 1;
      }else{
         $scriptsettings->is_disqus = 0;
      }

      $scriptsettings->save();

      $notification = array(
         'messege' => 'Scripts Updated Successfully!',
         'alert' => 'success'
     );
     return redirect()->back()->with('notification', $notification);
     
   }



   public function updateBasicinfo(Request $request, $id){
      $request->validate([
         'website_title' => 'required|max:250',
         'address' => 'required|max:250',
       ]);
  
      $basicinfo = Setting::where('language_id', $id)->first();

       $basicinfo->website_title = $request->website_title;
       $basicinfo->address = $request->address;
       $basicinfo->save();


      $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.basicinfo').'?language='.$this->lang->code)->with('notification', $notification);
   }

   // Page Visibility 
   public function pagevisibility(){
      return view('admin.settings.page-visibility');
   }

   public function updatepagevisibility(Request $request){

      $pagevisibility = Setting::first();



	   if($request->is_about_section == 'on'){
		   $pagevisibility->is_about_section = 1;
	   }else{
		   $pagevisibility->is_about_section = 0;
      }

      
	   if($request->is_package_section == 'on'){
		   $pagevisibility->is_package_section = 1;
	   }else{
		   $pagevisibility->is_package_section = 0;
      }

	   if($request->is_offer_section == 'on'){
		   $pagevisibility->is_offer_section = 1;
	   }else{
		   $pagevisibility->is_offer_section = 0;
      }

	   if($request->is_counter_section == 'on'){
		   $pagevisibility->is_counter_section = 1;
	   }else{
		   $pagevisibility->is_counter_section = 0;
      }

	   if($request->is_service_section == 'on'){
		   $pagevisibility->is_service_section = 1;
	   }else{
		   $pagevisibility->is_service_section = 0;
      }

	   if($request->is_testimonial_section == 'on'){
		   $pagevisibility->is_testimonial_section = 1;
	   }else{
		   $pagevisibility->is_testimonial_section = 0;
      }

	   if($request->is_blog_section == 'on'){
		   $pagevisibility->is_blog_section = 1;
	   }else{
		   $pagevisibility->is_blog_section = 0;
      }


	   if($request->is_about_page == 'on'){
		   $pagevisibility->is_about_page = 1;
	   }else{
		   $pagevisibility->is_about_page = 0;
      }
	   if($request->is_media_page == 'on'){
		   $pagevisibility->is_media_page = 1;
	   }else{
		   $pagevisibility->is_media_page = 0;
      }

	   if($request->is_shop_page == 'on'){
		   $pagevisibility->is_shop_page = 1;
	   }else{
		   $pagevisibility->is_shop_page = 0;
      }

	   if($request->is_faq_page == 'on'){
		   $pagevisibility->is_faq_page = 1;
	   }else{
		   $pagevisibility->is_faq_page = 0;
      }

	   if($request->is_team_page == 'on'){
		   $pagevisibility->is_team_page = 1;
	   }else{
		   $pagevisibility->is_team_page = 0;
      }

	   if($request->is_branch_page == 'on'){
		   $pagevisibility->is_branch_page = 1;
	   }else{
		   $pagevisibility->is_branch_page = 0;
      }

	   if($request->is_blog_page == 'on'){
		   $pagevisibility->is_blog_page = 1;
	   }else{
		   $pagevisibility->is_blog_page = 0;
      }

	   if($request->is_contact_page == 'on'){
		   $pagevisibility->is_contact_page = 1;
	   }else{
		   $pagevisibility->is_contact_page = 0;
      }

	   if($request->is_speed_test == 'on'){
		   $pagevisibility->is_speed_test = 1;
	   }else{
		   $pagevisibility->is_speed_test = 0;
      }

	   if($request->is_blog_share_links == 'on'){
		   $pagevisibility->is_blog_share_links = 1;
	   }else{
		   $pagevisibility->is_blog_share_links = 0;
      }

	   if($request->is_cooki_alert == 'on'){
		   $pagevisibility->is_cooki_alert = 1;
	   }else{
		   $pagevisibility->is_cooki_alert = 0;
      }

	   if($request->is_testimonial_bg == 'on'){
		   $pagevisibility->is_testimonial_bg = 1;
	   }else{
		   $pagevisibility->is_testimonial_bg = 0;
      }

	   if($request->is_counter_bg == 'on'){
		   $pagevisibility->is_counter_bg = 1;
	   }else{
		   $pagevisibility->is_counter_bg = 0;
      }

	   if($request->is_package_bg == 'on'){
		   $pagevisibility->is_package_bg = 1;
	   }else{
		   $pagevisibility->is_package_bg = 0;
      }

	

      
      $pagevisibility->save();

      $notification = array(
         'messege' => 'Page visibility Updated Successfully!',
         'alert' => 'success'
     );
     return redirect()->back()->with('notification', $notification);
   }


   // Custom CSS
   public function custom_css()
   {
       $custom_css = '/* Write Custom Css Here */';
       if (file_exists('assets/front/css/dynamic-css.css')) {
           $custom_css = file_get_contents('assets/front/css/dynamic-css.css');
       }
       return view('admin.settings.custom-css')->with(['custom_css' => $custom_css]);
   }

   public function custom_css_update(Request $request)
   {
       file_put_contents('assets/front/css/dynamic-css.css', $request->custom_css_area);

       $notification = array(
         'messege' => 'Custom Style Added Success!',
         'alert' => 'success'
     );
     return redirect()->back()->with('notification', $notification);
   }


   public function cookiealert(Request $request)
   {
      $lang = Language::where('code', $request->language)->first()->id;
     
      $data['cookie'] = Setting::where('language_id', $lang)->first();

       return view('admin.settings.cookie', $data);
   }

   public function updatecookie(Request $request, $langid)
   {
       $request->validate([
           'cookie_alert_text' => 'required'
       ]);

       $be = Setting::where('language_id', $langid)->firstOrFail();
       $be->cookie_alert_text = $request->cookie_alert_text;
       $be->save();

       $notification = array(
         'messege' => 'Cookie alert updated successfully!',
         'alert' => 'success'
     );
     return redirect()->back()->with('notification', $notification);
   }

}