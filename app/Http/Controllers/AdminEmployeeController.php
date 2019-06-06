<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\User;
use App\UserLeaves;
use App\Site;
use App\UserReports;
use Session;
class AdminEmployeeController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		if(Session::get('user_type') == 'admin')
		{
			$employees = User::where(['user_type' => 'employee'])->orderBy('id', 'desc')->get();
		}
		elseif(Session::get('user_type') == 'supervisor')
		{
			$employees = User::where(['supervisor_id'=>Session::get('admin_id'),'user_type' => 'employee'])->orderBy('id', 'desc')->get();
		}
		elseif(Session::get('user_type') == 'client')
		{

			$employees = User::where(['supervisor_id'=>$data['admin']->supervisor_id,'user_type' => 'employee'])->orderBy('id', 'desc')->get();
		}
		$data['datas'] = [];
		foreach($employees as $employee)
		{
			$employee['supervisor_name'] = User::where(['id' => $employee->supervisor_id])->value('name');
			$data['datas'][] = 	$employee;
		}
		$data['active'] = 'employees';
		$data['title'] = 'Manage Employees';
		return view('admin/employees/manage',$data);
    }
	public function add()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['supervisors'] = User::where(['user_type' => 'supervisor'])->get();
		$data['positions'] =DB::table('positions')->get();	
		$data['active'] = 'employees';
		$data['title'] = 'Add Employee';
		return view('admin/employees/add',$data);
    }
	public function edit($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['data'] = User::where(['id' => $id])->first();
		$data['positions'] =DB::table('positions')->get();
		$data['licence_images']= DB::table('licence_images')->where(['user_id'=>$id])->get();
		$data['id_images']= DB::table('id_images')->where(['user_id'=>$id])->get();
		$data['certification_images']= DB::table('certification_images')->where(['user_id'=>$id])->get();
		$data['supervisors'] = User::where(['user_type' => 'supervisor'])->get();
		$data['active'] = 'employees';
		$data['title'] = 'Edit Employee';
		return view('admin/employees/edit',$data);
    }
	public function insert(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$licence_name = array();
		$adhar_name 	= array();
		$digree_name 	= array();

		if($request->file('image'))
		{
			$image = $request->file('image');
			$imagename = time().'image.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/employees';
			$image->move($destinationPath, $imagename);
			$imagename =  url('uploads/employees/').'/'.$imagename;
		}
				if($request->hasFile('licence'))
		{
			 $i=1;
			foreach ($request->file('licence') as $licence) 
			{
				 

				$licencename = time().$i.'licence.'.$licence->getClientOriginalExtension();
				$destinationPath = 'uploads/supervisors';
				$licence->move($destinationPath, $licencename);
				$licence_name[] = url('uploads/supervisors/').'/'.$licencename;
			   $i++; 
			}
			    
			}
		if($request->file('adhar'))
		{
			$i=1;
			foreach ($request->file('adhar') as $adhar) 
			{
				$adharname = time().$i.'adhar.'.$adhar->getClientOriginalExtension();
				$destinationPath = 'uploads/supervisors';
				$adhar->move($destinationPath, $adharname);
				$adhar_name[] = url('uploads/supervisors/').'/'.$adharname;
			  $i++;
			}
			 }


	  if($request->file('digree'))
		{
			$i=1;
			foreach ($request->file('digree') as $digree) 
			{
				$digreename = time().$i.'digree.'.$digree->getClientOriginalExtension();
				$destinationPath = 'uploads/supervisors';
				$digree->move($destinationPath, $digreename);
				$digree_name[] = url('uploads/supervisors/').'/'.$digreename;
				$i++;
			}
			
			
		}
		else
		{
			$imagename = url('/img/user-icon.png');
		}
		$insert = User::insert(['supervisor_id' => $request->supervisor_id,'name' => $request->name,'address'=>$request->address,'email' => $request->email,'phone' => $request->phone,'alternate_phone' => $request->alternate_phone,'password' => md5($request->password),'user_type' => 'employee','position'=>$request->position,'active_status' => 'Active','image'=>$imagename,'date_of_birth'=>$request->date_of_birth,'created_at'=>date('Y-m-d h:i:s')]);	
		$last_insertID = DB::table('users')->latest()->value('id');
		foreach($licence_name as $licence_names):
			$data=['user_id'=>$last_insertID,'images'=>$licence_names];
			DB::table('licence_images')->insert($data); 
		endforeach;	
	
		foreach($adhar_name as $adhar_names):
			$data=['user_id'=>$last_insertID,'images'=>$adhar_names];
			DB::table('id_images')->insert($data); 
		endforeach;	
		
		foreach($digree_name as $digree_names):
			$data=['user_id'=>$last_insertID,'images'=>$digree_names];
			DB::table('certification_images')->insert($data); 
		endforeach;
		Session::flash('success', 'Employee Added Successfully'); 		
		return redirect('/admin/employees');
	}
	public function update(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$inputs['name'] = $request->name;
		$inputs['email'] = $request->email;
		$inputs['phone'] = $request->phone;
		$inputs['alternate_phone'] = $request->alternate_phone;
		$inputs['email'] = $request->email;
		$inputs['supervisor_id'] = $request->supervisor_id;
		$inputs['address'] = $request->address;
		$inputs['position'] = $request->position;
		$inputs['date_of_birth'] = $request->date_of_birth;
		if($request->file('image'))
		{
			//echo 'asd';die;
			$image = $request->file('image');
			$inputs['image'] = time().'image.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/employees/';
			$move = $image->move($destinationPath, $inputs['image']);
		
			$inputs['image'] =  url('uploads/employees/').'/'.$inputs['image'];
		}
		if($request->hasFile('licence'))
		{
			 $i=1;
			foreach ($request->file('licence') as $licence) 
			{
				 

				$licencename = time().$i.'licence.'.$licence->getClientOriginalExtension();
				$destinationPath = 'uploads/supervisors';
				$licence->move($destinationPath, $licencename);
				$licence_name[] = url('uploads/supervisors/').'/'.$licencename;
			   $i++; 
			}
			    
			}
		if($request->file('adhar'))
		{
			$i=1;
			foreach ($request->file('adhar') as $adhar) 
			{
				$adharname = time().$i.'adhar.'.$adhar->getClientOriginalExtension();
				$destinationPath = 'uploads/supervisors';
				$adhar->move($destinationPath, $adharname);
				$adhar_name[] = url('uploads/supervisors/').'/'.$adharname;
			  $i++;
			}
			 }


	  if($request->file('digree'))
		{
			$i=1;
			foreach ($request->file('digree') as $digree) 
			{
				$digreename = time().$i.'digree.'.$digree->getClientOriginalExtension();
				$destinationPath = 'uploads/supervisors';
				$digree->move($destinationPath, $digreename);
				$digree_name[] = url('uploads/supervisors/').'/'.$digreename;
				$i++;
			}
			
			
		}
		$update = User::where('id', $request->id)->update($inputs);	
		if($request->hasFile('licence'))
		{
		foreach($licence_name as $licence_names):
			$licence_data=['user_id'=>$request->id,'images'=>$licence_names];
			DB::table('licence_images')->insert($licence_data); 
		endforeach;	
	}
		if($request->file('adhar'))
		{
		foreach($adhar_name as $adhar_names):
			$adhar_data=['user_id'=>$request->id,'images'=>$adhar_names];
			DB::table('id_images')->insert($adhar_data); 
		endforeach;	
	}
	if($request->file('digree'))
		{
	foreach($digree_name as $digree_names):
			$digree_data=['user_id'=>$request->id,'images'=>$digree_names];
			DB::table('certification_images')->insert($digree_data); 
		endforeach; 
	}
		Session::flash('success', 'Employee updated Successfully'); 		
		return redirect('/admin/employees');
	}
	public function statusUpdate($id)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$checkStatus = User::where(['id' => $id])->first();
		if($checkStatus->active_status == 'Active')
		{
			$inputs['active_status'] = 'Inctivate';
			$message = 'Employee Deactivated Successfully';
		}
		else
		{
			$inputs['active_status'] = 'Active';
			$message = 'Employee Activated Successfully';
		}
		$update = User::where('id', $id)->update($inputs);	
		Session::flash('success', $message); 		
		return redirect('/admin/employees');
	}
	public function delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = User::where('id', $id)->delete();
		Session::flash('success', 'Employee deleted Successfully'); 		
		return redirect('/admin/employees');
		}
		/************************************************   Affter login  ***********************************************************/
		public function manage_sites()
		{   
			          	
			 $data['datas']=DB::table('sites')->where(['employee_id'=>Session::get('admin_id')])->get();
			 $data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
			 $data['active'] = 'employees';
			 $data['title'] = 'Sites';
		  return view('admin/sites/manage',$data);
		    
			}
	 public function manage_reports()
	 {
		$data['datas']=DB::table('user_reports')->where(['user_id'=>Session::get('admin_id')])->get();
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['active'] = 'reports';
		$data['title'] = 'Reports';
	 return view('admin/reports/manage',$data);
	 }
	 
	 public function add_report()
	 {

		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();

		$data['active'] = 'reports';
		$data['title'] = 'Genrate Report';
	 return view('admin/reports/add',$data);
	 }
	 public function genrateReport(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
    
      
            if(isset($_FILES['image']))
            {
                foreach($_FILES['image']['name'] as $key => $image_name)
                {
                    if(!empty($image_name)){
                    $imagename = time().'_'.$image_name;
                    $path = 'uploads/employees/reports/'.$imagename;
                    move_uploaded_file($_FILES['image']['tmp_name'][$key],$path);
                    $image_urls[] = url('uploads/employees/reports').'/'.$imagename;
                    }
                }
                $images = implode(',',$image_urls);
            }
            else
            {
                $images = '';
            }
            $siteDet = Site::where('employee_id',$inputs['userId'])->first();
            $insert = UserReports::insert(['supervisor_id'=>$siteDet->supervisor_id,'client_id'=>$siteDet->client_id,'site_id'=>$siteDet->id,'user_id'=>$inputs['userId'],'report_title'=>$inputs['reportTitle'],'report_description'=>$inputs['reportDescription'],'images'=>$images,'datetime'=>date('Y-m-d H:i:s')]);
					  Session::flash('success','Report genrate successfully');
						return redirect( url('/employee/reports'));
        }
    
		
		public function leave_add()
		{
			$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
     $data['active'] = 'Leaves';
			$data['title'] = 'Add leave';
		 return view('admin/leaves/add',$data);
		}
		public function leaveRequest(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
   
     
            $siteDet = Site::where('employee_id',$inputs['userId'])->first();
						$insert = UserLeaves::insert(['supervisor_id'=>$siteDet->supervisor_id,'client_id'=>$siteDet->client_id,'site_id'=>$siteDet->id,'user_id'=>$inputs['userId'],'date_from'=>$inputs['from'],'date_to'=>$inputs['to'],'message'=>$inputs['message'],'status'=>0,'created_at'=>date('Y-m-d H:i:s')]);
						Session::flash('success','Leave submit successfully');
						return redirect(url('employee/leaves'));
    }          

}
