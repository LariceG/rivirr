<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Admin;
use App\Employee;
use Session;
class AdminEmployeeController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$datas = Employee::orderBy('id', 'desc')->get();
		$active = 'employees';
		return view('admin/employees/manage',['admin'=>$admin,'datas'=>$datas,'active'=>$active]);
    }
	public function add_major()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$active = 'majors';
		return view('admin/majors/add',['admin'=>$admin,'active'=>$active]);
    }
	public function edit_major($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$data = Major::where(['id' => $id])->first();
		$active = 'majors';
		return view('admin/majors/edit',['admin'=>$admin,'data'=>$data,'active'=>$active]);
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
		
			
			$insert = Major::insert(['name' => $request->name,'created'=>date('Y-m-d h:i:s')]);	
		Session::flash('success', 'Major inserted Successfully'); 		
		return redirect('/admin/majors');
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
		$update = Major::where('id', $request->id)->update(['name' => $request->name]);	
		Session::flash('success', 'Major updated Successfully'); 		
		return redirect('/admin/majors');
	}
	public function delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = Employee::where('id', $id)->delete();
		Session::flash('success', 'Employee deleted Successfully'); 		
		return redirect('/admin/employees');
    }
}
