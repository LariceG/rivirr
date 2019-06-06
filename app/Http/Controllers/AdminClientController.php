<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Loger;
use App\Http\Requests\Sites;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\User;
use App\UserLocation;
use Session;
class AdminClientController extends Controller
{
	public function __construct()
	{
     $this->middleware('Loger',[
		'only'=>['index','add','edit','insert','update','statusUpdate','delete','getEmployees','profile','add_sites','insert_sites','delete_site','edit_site','validate']]);
		
	}	
	
	public function index()
    {		

		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		if(Session::get('user_type') == 'admin')
		{
			$clients = User::where(['user_type' => 'client'])->orderBy('id', 'desc')->get();
		}
		elseif(Session::get('user_type') == 'supervisor')
		{
			$clients = User::where(['supervisor_id'=>Session::get('admin_id'), 'user_type' => 'client'])->orderBy('id', 'desc')->get();
		 
		
		}
		elseif(Session::get('user_type') == 'employee')
		{
			$clients = User::where(['supervisor_id'=>Session::get('admin_id'), 'user_type' => 'client'])->orderBy('id', 'desc')->get();
		}
		$data['datas'] = [];
		
		foreach($clients as $client)
		{
			$data['datas'][] = 	$client;
		}
		$data['active'] = 'clients';
		$data['title'] = 'Manage Clients';
		return view('admin/clients/manage',$data);
		}
		
	public function add()
    {		
	
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['supervisors'] = User::where(['user_type' => 'supervisor'])->get();
		$data['active'] = 'clients';
		$data['title'] = 'Add Client';
		return view('admin/clients/add',$data);
		}
		
	public function edit($id)
    {		

		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['supervisors'] = User::where(['user_type' => 'supervisor'])->get();
		$client = User::where(['id' => $id])->first();
		$data['employees'] = User::where(['supervisor_id' => $client->supervisor_id,'user_type'=>'employee'])->get();
		$data['data'] = $client;	
		$data['active'] = 'clients';
		$data['title'] = 'Edit Client';
		return view('admin/clients/edit',$data);
		}
		
	public function insert(Request $request)
	{
	
		if($request->file('image'))
		{
			$image = $request->file('image');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/clients';
			$image->move($destinationPath, $imagename);
			$imagename =  url('uploads/clients/').'/'.$imagename;
		}
		else
		{
			$imagename = url('/img/user-icon.png');
		}
	
		$insert = User::insert(['supervisor_id' => $request->supervisor_id,'employee_id' => $request->employee_id,'name' => $request->name,'password' => md5($request->password),'email' => $request->email,'phone' => $request->phone,'address'=>$request->address, 'alternate_phone' => $request->alternate_phone,'user_type' => 'client','active_status' => 'Active','image'=>$imagename, 'created_at'=>date('Y-m-d h:i:s')]);
		$client_id = User::latest()->value('id');
		Session::flash('success', 'Client Added Successfully'); 		
		return redirect('/admin/clients');
	}

	public function update(Request $request)
	{
		
		$inputs['name'] = $request->name;
		$inputs['email'] = $request->email;
		$inputs['phone'] = $request->phone;
		$inputs['alternate_phone'] = $request->alternate_phone;
		$inputs['email'] = $request->email;
		$inputs['supervisor_id'] = $request->supervisor_id;
		$inputs['employee_id'] = $request->employee_id;
		$inputs['address'] = $request->address;

		if($request->file('image'))
		{
			$image = $request->file('image');
			$inputs['image'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/clients';
			$image->move($destinationPath, $inputs['image']);
			$inputs['image'] =  url('uploads/clients/').'/'.$inputs['image'];
		}
			
		$update = User::where('id', $request->id)->update($inputs);

		Session::flash('success', 'Client updated Successfully'); 		
		return redirect('/admin/clients');
	}

	public function statusUpdate($id)
	{
	
		$checkStatus = User::where(['id' => $id])->first();
		if($checkStatus->active_status == 'Active')
		{
			$inputs['active_status'] = 'Inctivate';
			$message = 'Client Deactivated Successfully';
		}
		else
		{
			$inputs['active_status'] = 'Active';
			$message = 'Client Activated Successfully';
		}
		$update = User::where('id', $id)->update($inputs);	
		Session::flash('success', $message); 		
		return redirect('/admin/clients');
	}

	public function delete($id)
  {		
	
		$delete = User::where('id', $id)->delete();
		Session::flash('success', 'Client deleted Successfully'); 		
		return redirect('/admin/clients');
	}

	public function getEmployees($id)
	{
		
		$employees = User::where(['supervisor_id' => $id,'user_type'=>'employee'])->get();
		foreach($employees as $employee)
		{
			echo '<option value="'.$employee->id.'">'.$employee->name.'</option>';
		}
	}

  public function valiDation()
   {
				$employee_id = $_GET['employeeId'];
				$shift =$_GET['shift'];
		$validation=DB::table('sites')->where(['employee_id'=>$employee_id,'shift'=>$shift])->first();

		if(!empty($validation))
		{
			Session::flash('error','This employee is already booked');
			 return Session::get('error');		 
			exit;

		}
 
   }


	public function insert_sites(Request $requset,$id)
	{	
	

		$data=['client_id'=>$id,'supervisor_id'=>$requset->supervisor_id,'employee_id'=>$requset->employee_id,'site_name'=>$requset->site_name,'site_location'=>$requset->site_location,'shift'=>$requset->shift,'created_at'=>date('Y-m-d')];
		
		DB::table('sites')->insert($data);
		$supervisor=['supervisor_id'=>$requset->supervisor_id];
		User::where(['id'=>$id,'user_type'=>'client'])->update($supervisor);
		return redirect()->back();

	}

public function profile($id)
{
  error_reporting(0);
	$sites= DB::table('sites')->where(['client_id'=>$id])->get();
	
	$data['user_deatil']= User::where(['id'=>$id,'user_type'=>'client'])->first();
  $data['detail']=DB::table('sites')->where(['client_id'=>$id])->first();
	$data['employees'] = User::where(['supervisor_id' => $data['detail']->supervisor_id,'user_type'=>'employee'])->get();
	$data['sites'] = [];
	foreach($sites as $site):
		$site->supervisor_name = User::where(['id' => $site->supervisor_id])->value('name');
	  $site->employee_name= User::where(['id' => $site->employee_id])->value('name');
    $data['sites'][] = $site;
	endforeach;

	$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
	$data['supervisors'] = User::where(['user_type' => 'supervisor'])->get();
	$data['active'] = 'clients';
	$data['title'] = 'Add Client';
  return view('admin/clients/profile',$data);

}
public function delete_site($id)
{
  DB::table('sites')->where(['id'=>$id])->delete();
  return redirect()->back();
}
public function edit_site()
 {
		$id=$_GET['id'];
		
	$sites= DB::table('sites')->where(['id'=>$id])->first();
   
	 $data['supervisors']= User::where(['user_type'=>'supervisor'])->get();
	 $data['employees']= DB::table('sites')->distinct('users.name')->join('users','users.supervisor_id','=','sites.supervisor_id')->where(['sites.supervisor_id'=>$sites->supervisor_id])->get(); 
    //echo '<pre>';
	//print_r($data['employees']);
		 /*$site->supervisor_name = User::where(['id' => $sites->supervisor_id])->value('name');
		 $site->employee_name= User::where(['id' => $sites->employee_id])->value('name');*/

		 $data['site']= $sites;
	

 return view('admin/clients/modal',$data);
 }
 public function update_site(Request $request)
 {
   $data=['supervisor_id'=>$request->supervisor_id,'employee_id'=>$request->employee_id,'client_id'=>$request->client_id,'site_name'=>$request->site_name,'site_location'=>$request->site_location,'shift'=>$request->Shift];
			DB::table('sites')->where(['id'=>$request->site_id])->update($data);
			return redirect()->action('AdminClientController@profile',['id'=>4]);
 }

}
