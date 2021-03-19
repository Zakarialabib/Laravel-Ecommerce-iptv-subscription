<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\Daynamicpage;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;

class DynamicpageController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }
    
    public function dynamic_page(Request $request){
        $lang = Language::where('code', $request->language)->first()->id;
     
        $dynamicpages = Daynamicpage::where('language_id', $lang)->orderBy('id', 'DESC')->get();

     
        
        return view('admin.dynamicpage.index', compact('dynamicpages'));
    }

    public function add(){
        return view('admin.dynamicpage.add');
    }

    public function store(Request $request){

        $slug = Helper::make_slug($request->title);
        $dynamicpages = Daynamicpage::select('slug')->get();
        
        $request->validate([
            'title' => [
                'required',
                'unique:daynamicpages,title',
                'max:255',
                function($attribute, $value, $fail) use ($slug, $dynamicpages){
                    foreach($dynamicpages as $dynamicpage){
                        if($dynamicpage->slug == $slug){
                            return $fail('Title already taken!');
                        }
                    }
                }
            ],
            'content' => 'required',
        ]);

        $dynamicpage = new Daynamicpage();
        $dynamicpage->language_id = $request->language_id;
        $dynamicpage->title = $request->title;
        $dynamicpage->slug = $slug;
        $dynamicpage->content = Purifier::clean($request->content);
        $dynamicpage->status = $request->status;
        $dynamicpage->save();

        $notification = array(
            'messege' => 'Daynamic Page Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function edit($id){

        $dynamicpage = Daynamicpage::find($id);
        return view('admin.dynamicpage.edit', compact('dynamicpage'));

    }

    public function update(Request $request, $id){

        $slug = Helper::make_slug($request->title);
        $dynamicpages = Daynamicpage::select('slug')->get();
        $dynamicpage = Daynamicpage::findOrFail($id);

         $request->validate([
            'title' => [
                'required',
                'max:255',
                function($attribute, $value, $fail) use ($slug, $dynamicpages, $dynamicpage){
                    foreach($dynamicpages as $blg){
                        if($dynamicpage->slug != $slug){
                            if($blg->slug == $slug){
                                return $fail('Title already taken!');
                            }
                        }
                    }
                },
                'unique:daynamicpages,title,'.$id
            ],
            'content' => 'required',
        ]);

        $dynamicpage->language_id = $request->language_id;
        $dynamicpage->title = $request->title;
        $dynamicpage->slug = $slug;
        $dynamicpage->content = Purifier::clean($request->content);
        $dynamicpage->status = $request->status;
        
        $dynamicpage->save();

        $notification = array(
            'messege' => 'Daynamic Page Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.dynamic_page').'?language='.$this->lang->code)->with('notification', $notification);
    }

    public function delete($id){

        $dynamicpage = Daynamicpage::find($id);
        $dynamicpage->delete();

        return back();
    }


}
