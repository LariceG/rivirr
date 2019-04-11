<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Admin;
use APP\Industry;
use Session;
use DB;
class AdminIndustriesController extends Controller
{

public function index()
{
    if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
    $admin = Admin::where(['id' => Session::get('admin_id')])->first();
    $active = 'industries';
    $data=DB::table('industries')->get();
 
    return view('admin/industries/industries',['active'=>$active,'admin'=>$admin,'data'=>$data]);
   
}
public function delete($id)
{
   
    
     if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}

    
     DB::table('industries')->where('id',$id)->delete();
    return redirect('/admin/industries');
    
}
public function add()
{
    
     if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
    
    
     $admin = Admin::where(['id' => Session::get('admin_id')])->first();
    $active = 'industries';

    return view('admin/industries/add',['active'=>$active,'admin'=>$admin]);
    
    
}
 
public function insert(Request $request)
{
    if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
    	$this->validate($request,[
         'name'=>'required',
		]);	 
      
    DB::table('industries')->insert(['name'=>$request->name]); 
    Session::flash('success', 'Industry inserted Successfully'); 
    return redirect('/admin/industries');
}
  
    public function edit_industries($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$data = DB::table('industries')->where('id',$id)->first();
		$active = 'industries';
		return view('admin/industries/edit',['admin'=>$admin,'data'=>$data,'active'=>$active]);
    }
    
    
    public function update(Request $request,$id)
	{
		
        
        if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$this->validate($request,[
         'name'=>'required',
		]);	  		
		$update =DB::table('industries')->where(['id'=>$request->id])->update(['name'=>$request->name]);	
		
        
        Session::flash('success', 'Industries updated Successfully'); 		
		 return redirect('/admin/industries');
	} 
    
    



}
    


?>