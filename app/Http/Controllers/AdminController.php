<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;use Illuminate\Support\Facades\DB;
use App\User;
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
	  
		$user = User::where(['email' => $request->email,'password' => md5($request->password)])->first();
		
		if(!empty($user) && $user->active_status == 'Active')
		{		
			Session::put('admin_id', $user->id);
			Session::put('user_type', $user->user_type);
			return redirect('/admin/dashboard');
		}
		elseif(!empty($user) && $user->active_status == 'Inctivate')
		{ 
			Session::flash('error', 'Your account is deactivated please concern  with your admin !'); 
			return redirect('/admin');
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
		$admin = User::where(['id' => Session::get('admin_id')])->first();
		$leaves=DB::table('user_leaves')->where(['supervisor_id'=>Session::get('admin_id')])->get();
		$reports=DB::table('user_reports')->where(['supervisor_id'=>Session::get('admin_id')])->get();
		$employee=DB::table('users')->where(['supervisor_id'=>Session::get('admin_id')])->get();
		$admin_supervisor=DB::table('users')->where(['user_type'=>'supervisor'])->get();
		$admin_employee=DB::table('users')->where(['user_type'=>'employee'])->get();
		$admin_client=DB::table('users')->where(['user_type'=>'client'])->get();
		$active = 'dashboard';
		return view('admin/admin_pages/dashboard',['admin'=>$admin,'active'=>$active,'leaves'=>$leaves,'reports'=>$reports,'employee'=>$employee,'admin_supervisor'=>$admin_supervisor,'admin_employee'=>$admin_employee,'admin_client'=>$admin_client]);
    }
	public function profile()
    {
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = User::where(['id' => Session::get('admin_id')])->first();
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
		$admin = User::where(['id' => Session::get('admin_id')])->first();
		return view('admin/admin_pages/change_password',['admin'=>$admin,'active'=>$active]);
    }
	public function update_profile(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = User::where(['id' => Session::get('admin_id')])->first();
		$this->validate($request,[
         'email'=>'required|email',
         'username'=>'required',
		 'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
		]);	  
		if($request->file('image'))
		{
			$image = $request->file('image');
			$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/'.$admin->user_type;
			$image->move($destinationPath, $input['imagename']);
			$input['imagename'] =  url('uploads/'.$admin->user_type.'/').'/'.$input['imagename'];
		
		$update = User::where('id', Session::get('admin_id'))->update(['name' => $request->username,'email' => $request->email,'image'=>$input['imagename']]);	
		}
		else
		{
			$update = User::where('id', Session::get('admin_id'))->update(['name' => $request->username,'email' => $request->email]);
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
		$admin = User::where(['id' => Session::get('admin_id')])->first();
		$admin = User::where(['id' => Session::get('admin_id')])->first();
		$checkPassword = Admin::where(['id' => Session::get('admin_id'),'password' => md5($request->old_password)])->first();		
		if(!$checkPassword)
		{
				Session::flash('error', "Old password doesn't matched"); 		
				return redirect('/admin/change_password');
		}
		else
		{
		$admin = User::where(['id' => Session::get('admin_id')])->first();
		$update = User::where('id', Session::get('admin_id'))->update(['password' => md5($request->new_password)]);
		}
		Session::flash('success', 'Password Updated Successfully'); 		
		return redirect('/admin/change_password');
	}
	public function logout()
    {
		Session::flush();
		return redirect('/admin'); exit;		
		}
		public function position()
		{ 
			$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		  
			$data['positions'] = DB::table('positions')->get();
	   	$data['active'] = 'Position';
		  $data['title'] = 'View Report Details';
       return view('admin/positions/position',$data);
		}
		public function delete_position($id)
		{
			 DB::table('positions')->where(['id'=>$id])->delete();
			 Session::flash('danger','position delete successfully');
			 return redirect(url('/admin/positions'));
		}
		public function add_position()
		{
			$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
			$data['active'] = 'Position';
		  $data['title'] = 'Add Position'; 
			return view('admin/positions/add',$data);
		}
		public function add_insert(Request $request)
		{
			$this->validate($request,[
         'position'=>'required'

				]);
				 
				$data =['name'=>$request->position];
				DB::table('positions')->insert($data);
				Session::flash('success','Position add successfully');
				return redirect(url('/admin/positions'));
   

		}
		public function position_edit($id)
		{
			$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
			$data['position']= DB::table('positions')->where(['id'=>$id])->first();
			$data['active'] = 'Position';
		  $data['title'] = 'Add Position'; 
			return view('admin/positions/edit',$data);
		}
		public function add_update(Request $request)
		{
				 $data=['name'=>$request->name]; 
			  DB::table('positions')->where(['id'=>$request->id])->update($data);
				 Session::flash('success','Position edit	 successfully');
				 return redirect(url('/admin/positions'));
				 
		}
	}

