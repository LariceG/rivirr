<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Recruit;
use App\Category;
use Session;
class AdminCategoryController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$datas = Category::orderBy('id', 'desc')->get();
		$active = 'categories';
		return view('admin/categories/manage',['admin'=>$admin,'datas'=>$datas,'active'=>$active]);
    }
	public function add_category()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$active = 'categories';
		return view('admin/categories/add',['admin'=>$admin,'active'=>$active]);
    }
	public function edit_category($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$data = Category::where(['id' => $id])->first();
		$active = 'categories';
		return view('admin/categories/edit',['admin'=>$admin,'data'=>$data,'active'=>$active]);
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
		
			
			$insert = Category::insert(['name' => $request->name,'created'=>date('Y-m-d h:i:s')]);	
		Session::flash('success', 'Category inserted Successfully'); 		
		return redirect('/admin/categories');
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
		$update = Category::where('id', $request->id)->update(['name' => $request->name],'');	
		Session::flash('success', 'Category updated Successfully'); 		
		return redirect('/admin/categories');
	}
	public function delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = Category::where('id', $id)->delete();
		Session::flash('success', 'Category deleted Successfully'); 		
		return redirect('/admin/categories');
    }
}
