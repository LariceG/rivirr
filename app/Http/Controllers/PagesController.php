<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Recruit;
use App\Employer;
use Session;
use Rating_model;

class PagesController extends Controller
{
   
    /*  public function __construct()
    {
        $this->middleware('login',[
           'only'=>'rating',
        ]);
        
    }*/

public function about()
{
    return view('frontend/employer/about');
    
    
}

}