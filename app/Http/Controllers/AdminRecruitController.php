<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Recruit;
use Session;
class AdminRecruitController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$datas = Recruit::orderBy('id', 'desc')->get();
		$active = 'recruit';
		return view('admin/recruits/manage',['admin'=>$admin,'datas'=>$datas,'active'=>$active]);
    }
	public function add_recruit()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$active = 'recruit';
		return view('admin/recruits/add',['admin'=>$admin,'active'=>$active]);
    }
	public function edit_recruit($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$data = Recruit::where(['id' => $id])->first();
		$active = 'recruit';
		return view('admin/recruits/edit',['admin'=>$admin,'data'=>$data,'active'=>$active]);
    }
	public function insert(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$this->validate($request,[
         'name'=>'required'
		]);	  
		
			
			$insert = Recruit::insert(['name' => $request->name,'created'=>date('Y-m-d h:i:s')]);	
		Session::flash('success', 'Recruit inserted Successfully'); 		
		return redirect('/admin/recruits');
	}
	public function update(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$this->validate($request,[
         'name'=>'required',
		]);	  		
		$update = Recruit::where('id', $request->id)->update(['name' => $request->name]);	
		Session::flash('success', 'Recruit updated Successfully'); 		
		return redirect('/admin/recruits');
	}
	public function delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = Recruit::where('id', $id)->delete();
		Session::flash('success', 'Recruit deleted Successfully'); 		
		return redirect('/admin/recruits');
    }
}
