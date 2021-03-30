<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function clear() {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
  
        $notification = array(
            'messege' => 'Cache et configuration effacés avec succès !',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
      }
}
