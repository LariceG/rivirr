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

class SearchController extends Controller
{
   
    /*  public function __construct()
    {
        $this->middleware('login',[
           'only'=>'rating',
        ]);
        
    }*/
 public function index(Request $request)
 { 
    $data['search_value'] = '';
    $data['location'] = '';
    $data['latitude'] = '';
    $data['longitude'] = '';
      if(!empty($request->input('employee')))
      {
        $data['search_value']=$request->input('employee');
        $data['employees']= DB::table('employers')->Where('name', 'like', '%' .$data['search_value']. '%')->get();
      }
      else
      {
        $circle_radius = 5000;
        $max_distance = 40;   
        $data['location']=$request->input('location');
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');
        $data['employees']= DB::select(
            'SELECT * FROM
                 (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                 cos(radians(longitude) - radians(' . $lng . ')) +
                 sin(radians(' . $lat . ')) * sin(radians(latitude))))
                 AS distance
                 FROM employers) AS distance
             WHERE distance < ' . $max_distance . '
             ORDER BY distance
         ');
      }
     
       return view('frontend/employer/search_page',$data);
 }

}

?>