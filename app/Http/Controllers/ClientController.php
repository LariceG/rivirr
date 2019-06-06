<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Site;
use App\User;
use Session;
class ClientController extends Controller
{
	public function __construct()
	{
     $this->middleware('Loger',[
		'only'=>['sites']]);
		
	}	 
	
	public function sites()
	 {
			$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
			 $sites = Site::where(['client_id' => Session::get('admin_id')])->get();
			 foreach($sites as $site)
			 {
					 $site['supervisor_name'] = User::where(['id' => $site['supervisor_id']])->value('name');
					 $site['employee_name'] = User::where(['id' => $site['employee_id']])->value('name');
					 $data['sites'][] = $site;
			 }
		  $data['active'] = 'clients';
		  $data['title'] = 'Sites';
			return view('admin/client_admin/manage',$data);

	 }	
	
	
	/*public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['datas'] = Site::orderBy('id', 'desc')->get();	
		$data['active'] = 'sites';
		$data['title'] = 'Manage Sites';
		return view('admin/sites/manage',$data);
    }
	public function add()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['active'] = 'sites';
		$data['title'] = 'Add Site';
		return view('admin/sites/add',$data);
    }
	public function edit($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['data'] = Site::where(['id' => $id])->first();
		$data['active'] = 'sites';
		$data['title'] = 'Edit Site';
		return view('admin/sites/edit',$data);
    }
	public function insert(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$insert = Site::insert(['site_name' => $request->site_name,'site_location' => $request->site_location, 'created_at'=>date('Y-m-d h:i:s')]);	
		Session::flash('success', 'Site Added Successfully'); 		
		return redirect('/admin/sites');
	}
	public function update(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$inputs['site_name'] = $request->site_name;
		$inputs['site_location'] = $request->site_location;
		$update = Site::where('id', $request->id)->update($inputs);	
		Session::flash('success', 'Site updated Successfully'); 		
		return redirect('/admin/sites');
	}
	public function delete($id)
  {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = Site::where('id', $id)->delete();
		Session::flash('success', 'Site deleted Successfully'); 		
		return redirect('/admin/sites');
	}*/
}
