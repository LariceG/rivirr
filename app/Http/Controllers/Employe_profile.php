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

class Employe_profile extends Controller
{
   
    /*  public function __construct()
    {
        $this->middleware('login',[
           'only'=>'rating',
        ]);
        
    }*/
    
    
    
    
    public function profile($id)
    {
     
        $active='';
        $data= DB::table('employers')->where('id',$id)->first();
       
        if(empty($data))
        {
          return redirect('/');
            
        }
        else
        {
        $gallary= DB::table('employer_gallery')->where('employer_id',$id)->get();
       // $gallary= DB::table('employer_gallery')->where('employer_id',$id)->get();
        return view('frontend/employer/employe_profile',['active'=>$active,'data'=>$data,'gallary'=>$gallary]);
        }
    }

    
}