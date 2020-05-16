<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index(Request $request)
    {
      echo 'Land : ' . \Config::get('land');
      echo '<br/>';
      echo 'Locale : ' . \Config::get('locale');
      dd(\Auth::user());
    }
}
