<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use Session;
class AdminValetController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = DB::table('admin')->where(['id' => Session::get('admin_id')])->first();
		$datas = DB::table('valets')->orderBy('id', 'desc')->get();
		return view('admin/valets/manage',['admin'=>$admin,'datas'=>$datas]);
    }
	public function add_valet()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = DB::table('admin')->where(['id' => Session::get('admin_id')])->first();
		$points = DB::table('points')->get();
		return view('admin/valets/add',['admin'=>$admin,'points'=>$points]);
    }
	public function edit_valet($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = DB::table('admin')->where(['id' => Session::get('admin_id')])->first();
		$points = DB::table('points')->get();
		$data = DB::table('valets')->where(['id' => $id])->first();
		return view('admin/valets/edit',['admin'=>$admin,'data'=>$data,'points'=>$points]);
    }
	public function insert(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$this->validate($request,[
         'name'=>'required',
         'point'=>'required',
		 'email'=>'required|email|unique:valets',
         'phone'=>'required|unique:valets',
         'password'=>'required',
         'address'=>'required',
		 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
		]);	  
		
			$image = $request->file('image');
			$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/valet';
			$image->move($destinationPath, $input['imagename']);
			
			$insert = DB::table('valets')->insert(['point' => $request->point,'address' => $request->address,'email' => $request->email,'phone' => $request->phone,'password' => md5($request->password),'name' => $request->name,'image'=>$input['imagename'],'created'=>date('Y-m-d h:i:s')]);	
		Session::flash('success', 'Valet inserted Successfully'); 		
		return redirect('/admin/valets');
	}
	public function update(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$this->validate($request,[
         'name'=>'required',
         'point'=>'required',
         'email'=>'required|email',
         'phone'=>'required',
         'address'=>'required',
		 'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
		]);	  
		if($request->file('image'))
		{
			$image = $request->file('image');
			$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/valet';
			$image->move($destinationPath, $input['imagename']);
			
			$update = DB::table('valets')->where('id', $request->id)->update(['point' => $request->point,'address' => $request->address,'email' => $request->email,'phone' => $request->phone,'name' => $request->name,'image'=>$input['imagename']]);	
		}
		else
		{
			$update = DB::table('valets')->where('id', $request->id)->update(['point' => $request->point,'address' => $request->address,'email' => $request->email,'phone' => $request->phone,'password' => md5($request->password),'name' => $request->name]);	
		}
		Session::flash('success', 'Valet updated Successfully'); 		
		return redirect('/admin/valets');
	}
	public function delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = DB::table('valets')->where('id', $id)->delete();
		Session::flash('success', 'Valet deleted Successfully'); 		
		return redirect('/admin/valets');
    }
}
