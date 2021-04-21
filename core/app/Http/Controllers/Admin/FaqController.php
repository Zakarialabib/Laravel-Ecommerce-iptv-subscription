<?php

namespace App\Http\Controllers;

use App\Faq;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{


    public function faq(Request $request){     
        $faqs = Faq::where('status', $status)->orderBy('id', 'DESC')->get();
        
        return view('pages.backend.faq.index', compact('faqs'));
    }

    // Add Faq
    public function add(){
        return view('pages.backend.faq.add');
    }

    // Store Faq
    public function store(Request $request){

        $request->validate([
            'title' => 'required|max:150',
            'content' => 'required',
        ]);

        $faq = new Faq();
        $faq->status = $request->status;
        $faq->title = $request->title;
        $faq->content = $request->content;
        $faq->save();
       
        $notification = array(
            'messege' => 'Faq Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Faq Delete
    public function delete($id){

        $faq = Faq::find($id);
        $faq->delete();

        return back();
    }

    // Faq Edit
    public function edit($id){

        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq'));

    }

    // Update Faq
    public function update(Request $request, $id){

        $id = $request->id;
         $request->validate([
            'title' => 'required|max:150',
            'content' => 'required',
        ]);

        $faq = Faq::find($id);
        $faq->status = $request->status;
        $faq->title = $request->title;
        $faq->content = $request->content;
        $faq->save();

      
        return redirect(route('admin.faq'));
    }



}