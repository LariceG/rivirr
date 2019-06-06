<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\User;
use App\Inbox;
use App\Conversation;
use App\UserAttendance;
use Session;
class AdminSupervisorController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['datas'] = User::where(['user_type' => 'supervisor'])->orderBy('id', 'desc')->get();
		$data['active'] = 'supervisors';
		$data['title'] = 'Manage Supervisors';
		return view('admin/supervisors/manage',$data);
		}
		public function getChat($employee_id)
    {		
				if(!Session::get('admin_id'))
				{
					return redirect('/admin');exit;
				}
				$data['employeeDet'] = User::where(['id' => $employee_id])->first();
				$data['datas'] = Conversation::where(['sender_id' => Session::get('admin_id'),'receiver_id' => $employee_id])->orWhere(function($q)use ($employee_id) {
					$q->where(['receiver_id' => Session::get('admin_id'),'sender_id' => $employee_id]);
				})->get();

				  //Inbox::where(['receiver_id' => Session::get('admin_id')])])->update(['read_status'=>'1']);
				
					return view('admin/supervisors/getChat',$data);
		}
		public function updateChatNotification()
    {		
				if(!Session::get('admin_id'))
				{
					return redirect('/admin');exit;
				}			
				Inbox::where(['receiver_id' => Session::get('admin_id')])->update(['read_status'=>'1']);
		}
		
	public function sendMessage(Request $request)
	{
		date_default_timezone_set("Asia/Calcutta");
		$employee_id = $request->receiver_id;
		$checkInbox = Inbox::where(['sender_id' => Session::get('admin_id'),'receiver_id' => $employee_id])->orWhere(function($q)use ($employee_id) {
			$q->where(['receiver_id' => Session::get('admin_id'),'sender_id' => $employee_id]);
		})->first();
		if(!$checkInbox)
		{
			$insert = Inbox::insert(['sender_id' => Session::get('admin_id'),'receiver_id' => $request->receiver_id,'message' => $request->message,'read_status'=>'0', 'created_at'=>date('Y-m-d H:i:s')]);
		}
		else
		{
			$insert = Inbox::where('id',$checkInbox->id)->update(['sender_id' => Session::get('admin_id'),'receiver_id' => $request->receiver_id,'message' => $request->message,'read_status'=>'0', 'created_at'=>date('Y-m-d H:i:s')]);
		}
		Conversation::insert(['sender_id' => Session::get('admin_id'),'receiver_id' => $request->receiver_id,'message' => $request->message, 'created_at'=>date('Y-m-d H:i:s')]);
	}
	public function add()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['positions'] =DB::table('positions')->get();
		$data['active'] = 'supervisors';
		$data['title'] = 'Add Supervisor';
		return view('admin/supervisors/add',$data);
    }
	public function edit($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$data['positions'] =DB::table('positions')->get();
		$data['licence_images']= DB::table('licence_images')->where(['user_id'=>$id])->get();
		$data['id_images']= DB::table('id_images')->where(['user_id'=>$id])->get();
		$data['certification_images']= DB::table('certification_images')->where(['user_id'=>$id])->get();
		$data['data'] = User::where(['id' => $id])->first();
		$data['active'] = 'supervisors';
		$data['title'] = 'Edit Supervisor';
		return view('admin/supervisors/edit',$data);
    }
	public function insert(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		//$licences = $request->file('licence');
		$licence_name = array();
		$adhar_name 	= array();
		$digree_name 	= array();
		  
		if($request->file('image'))
		{
			$image = $request->file('image');
			$imagename = time().'image.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/supervisors';
			$image->move($destinationPath, $imagename);
			$imagename =  url('uploads/supervisors/').'/'.$imagename;
		}
	;
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
		
		$insert = User::insert(['name' => $request->name,'email' => $request->email,'address' => $request->address,'password' => md5($request->password),'phone' => $request->phone,'alternate_phone' => $request->alternate_phone,'user_type' => 'supervisor','position'=>$request->position,'active_status' => 'Active','image'=>$imagename,'created_at'=>date('Y-m-d h:i:s')]);
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
			
		Session::flash('success', 'Supervisor Added Successfully'); 		
		return redirect('/admin/supervisors');
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
		$inputs['address'] = $request->address;
		$inputs['position'] = $request->position;
		if($request->file('image'))
		{
			$image = $request->file('image');
			$inputs['image'] = time().'image.'.$image->getClientOriginalExtension();
			$destinationPath = 'uploads/supervisors';
			$image->move($destinationPath, $inputs['image']);
			$inputs['image'] =  url('uploads/supervisors/').'/'.$inputs['image'];
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
		
		//print_r($inputs);
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
		Session::flash('success', 'Supervisor updated Successfully'); 		
		return redirect('/admin/supervisors');
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
			$message = 'Supervisor Deactivated Successfully';
		}
		else
		{
			$inputs['active_status'] = 'Active';
			$message = 'Supervisor Activated Successfully';
		}
		$update = User::where('id', $id)->update($inputs);	
		Session::flash('success', $message); 		
		return redirect('/admin/supervisors');
	}
	public function delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = User::where('id', $id)->delete();
		Session::flash('success', 'Supervisor deleted Successfully'); 		
		return redirect('/admin/supervisors');
		}
		public function delete_img()
		{
				DB::table($_GET['table'])->where(['id'=>$_GET['id']])->delete();
				return redirect()->back();
		}

		public function employee_attendance($id)
		{
			date_default_timezone_set("Asia/Calcutta");
		        	$checkinStatus = UserAttendance::where(['user_id'=>$id,'date'=>date('Y-m-d')])->orderBy('id','DESC')->value('checkin_status');
                $attendences = UserAttendance::where(['user_id'=>$id,'date'=>date('Y-m-d'),'checkin_status'=>'1'])->get();
                $time = '';
								$minutes = '';
							//	print_r($attendences);die;
                foreach($attendences as $attendence)
                {
                    $attendence['time'] = date('H:i',strtotime($attendence->time));
               
                    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
                // loop throught all the times
                
										list($hour, $minute) = explode(':', $attendence['time']);
										//print_r($hour.':'.$minute).'<br>';
                    $minutes += $hour * 60;
                    $minutes += $minute;
                }
								//die;
                    $hours = floor($minutes / 60);
                    $minutes -= $hours * 60;
										$att_time = $hours.':'.$minutes;
								  //	print_r($att_time);die;
									$time = strtotime("-60 minutes",strtotime(date('Y-m-d').' '.$att_time));
                
									//print_r($minutes);die;
                   
										if(count($attendences) == 0)
										{
											$data['totalHours'] = '0';
										}
										else
										{
											
											$data['totalHours'] = $this->humanTiming($time);
										}
			        
					 
			//$leaves = DB::table('user_leaves')->where(['supervisor_id'=>Session::get('admin_id'),'user_id'=>$id,'status'=>'1'])->get();						
                  
		 	$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
      $data['attendance'] = DB::table('user_attendance')->where(['user_id'=>$id,'date'=>date('y-m-d')])->get();
			 $data['active'] = 'supervisors';
	   	$data['title'] = 'Edit Supervisor';
			return view('admin/employees/attendance',$data);
		}

		function humanTiming($time)
    {
			define("SECONDS_PER_HOUR", 60*60);
			$startdatetime = $time;
			$enddatetime = strtotime(date('Y-m-d') . " " . date('H:i'));
			$difference = $enddatetime - $startdatetime;
			$hoursDiff = $difference / SECONDS_PER_HOUR;
			$minutesDiffRemainder = $difference % SECONDS_PER_HOUR;
			$hoursDiff = explode('.',$hoursDiff);
			$minutesDiffRemainder = $minutesDiffRemainder/60;
			$minutesDiffRemainder = explode('.',$minutesDiffRemainder);       
			return round($hoursDiff[0]) . " hour " . $minutesDiffRemainder[0] . " minutes";
				//return date('H:i', mktime(0, $minutesDiffRemainder[0]));
    }
	
	}
