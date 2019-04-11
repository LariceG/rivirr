<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Admin;
use App\Recruit;
use App\Category;
use App\Major;
use App\Perks;
use Session;
class AdminPerksController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$datas = Perks::orderBy('id', 'desc')->get();
		$active = 'perks';
		return view('admin/perks/manage',['admin'=>$admin,'datas'=>$datas,'active'=>$active]);
    }
	public function add_perk()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$active = 'perks';
		return view('admin/perks/add',['admin'=>$admin,'active'=>$active]);
    }
	public function edit_perk($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$data = Perks::where(['id' => $id])->first();
		$active = 'perks';
		return view('admin/perks/edit',['admin'=>$admin,'data'=>$data,'active'=>$active]);
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
		
			
			$insert = Perks::insert(['name' => $request->name,'created'=>date('Y-m-d h:i:s')]);	
		Session::flash('success', 'Perk inserted Successfully'); 		
		return redirect('/admin/perks');
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
		$update = Perks::where('id', $request->id)->update(['name' => $request->name,'created'=>date('Y-m-d h:i:s')]);	
		Session::flash('success', 'Perk updated Successfully'); 		
		return redirect('/admin/perks');
	}
	public function delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = Perks::where('id', $id)->delete();
		Session::flash('success', 'Perk deleted Successfully'); 		
		return redirect('/admin/perks');
    }
}
