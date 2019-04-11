<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;use Illuminate\Support\Facades\DB;
use App\Admin;
use Session;
class AdminController extends Controller
{
    public function index()
    {
		return View::make('admin/admin_pages/login');
    }
	public function login(Request $request)
	{
		$this->validate($request,[
         'email'=>'required|email',
         'password'=>'required'
		]);
	  
		$user = Admin::where(['email' => $request->email,'password' => md5($request->password)])->first();
		if(!empty($user))
		{		
			Session::put('admin_id', $user->id);
			return redirect('/admin/dashboard');
		}
		else
		{
			Session::flash('error', 'Please enter valid credentials!'); 
			return redirect('/admin');
		}
	}
	public function dashboard()
    {
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$majors = DB::table('majors')->get();
	    $employees = DB::table('employees')->get();
		$employers = DB::table('employers')->get();
		$recruits = DB::table('recruits')->get();
		$active = 'dashboard';
		return view('admin/admin_pages/dashboard',['admin'=>$admin,'active'=>$active,'majors'=>$majors,'employees'=>$employees,'employers'=>$employers,'recruits'=>$recruits]);
    }
	public function profile()
    {
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$active = '';
		return view('admin/admin_pages/profile',['admin'=>$admin,'active'=>$active]);
    }
	public function change_password()
    {
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$active = '';
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		return view('admin/admin_pages/change_password',['admin'=>$admin,'active'=>$active]);
    }
	public function update_profile(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$this->validate($request,[
         'email'=>'required|email',
         'username'=>'required',
		 'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
		]);	  
		if($request->file('image'))
		{
			$image = $request->file('image');
			$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/admin';
			$image->move($destinationPath, $input['imagename']);
			
			$update = Admin::where('id', Session::get('admin_id'))->update(['username' => $request->username,'email' => $request->email,'image'=>$input['imagename']]);	
		}
		else
		{
			$update = Admin::where('id', Session::get('admin_id'))->update(['username' => $request->username,'email' => $request->email]);
		}
		Session::flash('success', 'Profile Updated Successfully'); 		
		return redirect('/admin/profile');
	}
	public function update_password(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$this->validate($request,[
         'old_password'=>'required',
         'new_password'=>'required'
		]);
        $checkPassword = Admin::where(['id' => Session::get('admin_id'),'password' => md5($request->old_password)])->first();		
		if(!$checkPassword)
		{
				Session::flash('error', "Old password doesn't matched"); 		
				return redirect('/admin/change_password');
		}
		else
		{
			$update = Admin::where('id', Session::get('admin_id'))->update(['password' => md5($request->new_password)]);
		}
		Session::flash('success', 'Password Updated Successfully'); 		
		return redirect('/admin/change_password');
	}
	public function logout()
    {
		Session::flush();
		return redirect('/admin'); exit;		
    }
}
