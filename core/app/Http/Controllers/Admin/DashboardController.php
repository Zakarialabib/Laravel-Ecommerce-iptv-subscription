<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Client;
use App\Portfolio;
use App\Service;
use App\About;
use App\Branch;
use App\Package;
use App\Product;
use App\Scategory;
use App\Team;
use App\Testimonial;
use App\User;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $user = User::all();
        $packages = Package::all();
        $latestpackages = Package::orderBy('id', 'DESC')->limit(10)->get();
        $service = Service::all();
        $branch = Branch::all();
        $product = Product::all();
        $blogs = Blog::all();
        $latestblogs = Blog::orderBy('id', 'DESC')->limit(10)->get();
        $testimonial = Testimonial::all();
        $team = Team::all();
        return view('admin.dashboard', compact('user', 'packages', 'service', 'branch', 'blogs', 'testimonial', 'team', 'latestpackages', 'latestblogs', 'product'));
    }

       // Change Language
       public function changeLanguage($lang)
       {
   
           session()->put('lang', $lang);
           app()->setLocale($lang);
   
           return redirect()->route('admin.dashboard');
       }
}
