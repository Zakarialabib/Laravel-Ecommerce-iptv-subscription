<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Sectiontitle;
use App\Language;
use Session;

class PackagController extends Controller
{
   public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function listPackages(Request $request) {
        try {
            //code...
            $packages = Package::all();
            return response(['packages' => $packages], 200);
        } catch (\Throwable $th) {
            return response(['packages' => null], 500);
        }
    }

    public function package(Request $request){
        $lang = Language::where('code', $request->language)->first()->id;
     
        $packages = Package::where('language_id', $lang)->orderBy('id', 'DESC')->get();
        
        $saectiontitle = Sectiontitle::where('language_id', $lang)->first();
        return view('admin.package.index', compact('packages', 'saectiontitle'));
    }

    // Add slider Category
    public function add(){
        return view('admin.package.add');
    }

    // Store slider Category
    public function store(Request $request){
        
        $data = $request->validate([
            'name' => 'required|max:150',
            'language_id' => 'required',
            'plan' => 'required|max:150',
            'feature' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|max:150',
        ]);


        Package::create($data);

        $notification = array(
            'messege' => 'Abonnement ajoutée avec succès !',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Delete
    public function delete($id){

        $Package = Package::find($id);
        $Package->delete();

        return back();
    }

    // slider Category Edit
    public function edit($id){

        $package = Package::find($id);
        return view('admin.package.edit', compact('package'));

    }

    // Update slider Category
    public function update(Request $request, $id){

        $id = $request->id;
        $request->validate([
            'name' => 'required|max:150',
            'language_id' => 'required',
            'speed' => 'required|numeric',
            'time' => 'required|max:150',
            'feature' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|max:150',
        ]);

        $package = Package::find($id);
        $package->update($request->all());

        $notification = array(
            'messege' => 'Abonnement  actualisé avec succès!',
            'alert' => 'success'
        );
        return redirect(route('admin.package').'?language='.$this->lang->code)->with('notification', $notification);;
    }

        public function plancontent(Request $request, $id){
        
        $request->validate([
            'plan_title' => 'required',
            'plan_subtitle' => 'required',
            'pricing_bg' => 'mimes:jpeg,jpg,png',
        ]);
      
        $plan_title = Sectiontitle::where('language_id', $id)->first();

        if($request->hasFile('pricing_bg')){
            @unlink('assets/front/img/'. $plan_title->pricing_bg);
            $file = $request->file('pricing_bg');
            $extension = $file->getClientOriginalExtension();
            $pricing_bg = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $pricing_bg);

            $plan_title->pricing_bg = $pricing_bg;

        }
    
        $plan_title->plan_title = $request->plan_title;
        $plan_title->plan_subtitle = $request->plan_subtitle;
        $plan_title->save();
        

        $notification = array(
            'messege' => 'Contenue du Plan des prix  actualisé avec succès!',
            'alert' => 'success'
        );
        return redirect(route('admin.package').'?language='.$this->lang->code)->with('notification', $notification);
    }

}
