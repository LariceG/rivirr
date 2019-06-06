<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\UserAttendance;
use App\UserReports;
use App\UserLeaves;
use App\Site;
use App\Inbox;
use App\Conversation;
class ApiController extends Controller
{
    public function login(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'email'=> 'required|email',  
            'password'  => 'required', 
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
           $userDetails = User::where(['email'=>$inputs['email'],'password'=>md5($inputs['password'])])->first();
           if(!empty($userDetails))
           {
                if($userDetails->active_status == 'Active')
                {
                    $message['success'] = 1;
                    $message['message'] = 'You are login successfully';
                    $message['details'] = $userDetails;
                }
                else
                {
                    $message['success'] = 0;
                    $message['message'] = 'Sorry, you are blocked by admin'; 
                }
           }
           else
           {
                $message['success'] = 0;
                $message['message'] = 'Invalid login credentials!'; 
           }
        }
        return response()->json($message);
    }
    public function getProfile(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
           $userDetails = User::where(['id'=>$inputs['userId'],'user_type'=>'employee'])->first();
           if(!empty($userDetails))
           {
                $checkinStatus = UserAttendance::where(['user_id'=>$inputs['userId'],'date'=>date('Y-m-d')])->orderBy('id','DESC')->value('checkin_status');
                if($checkinStatus == '')
                {
                    $userDetails['checkin_status'] = '';
                }
                elseif($checkinStatus == '1')
                {
                    $userDetails['checkin_status'] = 'checkin';
                }
                elseif($checkinStatus == '1')
                {
                    $userDetails['checkin_status'] = 'checkout';
                }
                $message['success'] = 1;
                $message['message'] = 'user details found successfully';
                $message['details'] = $userDetails;
           }
           else
           {
                $message['success'] = 0;
                $message['message'] = 'user details not found'; 
           }
        }
        return response()->json($message);
    }
    public function userDashboard(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
           $userDetails = User::where(['id'=>$inputs['userId'],'user_type'=>'employee'])->first();
           if(!empty($userDetails))
           {
                $checkinStatus = UserAttendance::where(['user_id'=>$inputs['userId'],'date'=>date('Y-m-d')])->orderBy('id','DESC')->value('checkin_status');
                $attendences = UserAttendance::where(['user_id'=>$inputs['userId'],'date'=>date('Y-m-d'),'checkin_status'=>'1'])->get();
                $time = '';
                $minutes = '';
                foreach($attendences as $attendence)
                {
                    $attendence['time'] = date('H:i',strtotime($attendence->time));
               
                    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
                // loop throught all the times
                
                    list($hour, $minute) = explode(':', $attendence['time']);
                    $minutes += $hour * 60;
                    $minutes += $minute;
                }

                    $hours = floor($minutes / 60);
                    $minutes -= $hours * 60;
                    $att_time = $hours.':'.$minutes;
                    $time = strtotime("-60 minutes",strtotime(date('Y-m-d').' '.$att_time));
                
                
                if(count($attendences) == 0)
                {
                    $userDetails['totalWorkingHours'] = '0';
                }
                else
                {
                    $userDetails['totalWorkingHours'] = $this->humanTiming($time);
                }
                if($checkinStatus == '')
                {
                    $userDetails['checkin_status'] = '';
                }
                elseif($checkinStatus == '1')
                {
                    $userDetails['checkin_status'] = 'checkin';
                }
                elseif($checkinStatus == '1')
                {
                    $userDetails['checkin_status'] = 'checkout';
                }
                $message['success'] = 1;
                $message['message'] = 'user details found successfully';
                $message['details'] = $userDetails;
           }
           else
           {
                $message['success'] = 0;
                $message['message'] = 'user details not found'; 
           }
        }
        return response()->json($message);
    }
    function humanTiming ($time)
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
    }
    public function updateProfile(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required',
            'name'=> 'required',
            'email'=> 'required|email',
            'phone'=> 'required',
            'alternate_phone'=> 'required',
            'address'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $user = User::where(['id'=>$inputs['userId'],'user_type'=>'employee'])->first();
            if($request->file('image'))
            {
                $image = $request->file('image');
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = 'uploads/employees';
                $image->move($destinationPath, $imagename);
                $imagename =  url('uploads/employees/').'/'.$imagename;
            }
            else
            {
                $imagename = $user->image;
            }
           $update = User::where(['id'=>$inputs['userId'],'user_type'=>'employee'])->update(['name'=>$inputs['name'],'email'=>$inputs['email'],'name'=>$inputs['name'],'phone'=>$inputs['phone'],'phone'=>$inputs['phone'],'name'=>$inputs['phone'],'image'=>$imagename]);
           if(!empty($update))
           {
                $userDetails = User::where(['id'=>$inputs['userId'],'user_type'=>'employee'])->first();
                $message['success'] = 1;
                $message['message'] = 'Your profile updated successfully';
                $message['details'] = $userDetails;
           }
           else
           {
                $message['success'] = 0;
                $message['message'] = 'Something went wrong!'; 
           }
        }
        return response()->json($message);
    }
    public function changePassword(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required',
            'oldPassword'=> 'required',
            'newPassword'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $checkOldPassword = User::where(['id'=>$inputs['userId'],'user_type'=>'employee','password'=>md5($inputs['oldPassword'])])->first();
            if(!empty($checkOldPassword))
            {
                $update = User::where(['id'=>$inputs['userId'],'user_type'=>'employee'])->update(['password'=>md5($inputs['newPassword'])]);
                if(!empty($update))
                {
                    $message['success'] = 1;
                    $message['message'] = 'Your password updated successfully';
                }
                else
                {
                    $message['success'] = 0;
                    $message['message'] = 'Something went wrong!'; 
                }
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'Sorry, your old password does not matched!'; 
            }
        }
        return response()->json($message);
    }
    public function updateLocation(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required',
            'latitude'=> 'required',
            'longitude'=> 'required',
            'address'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $update = User::where(['id'=>$inputs['userId'],'user_type'=>'employee'])->update(['latitude'=>$inputs['latitude'],'longitude'=>$inputs['longitude'],'address'=>$inputs['address']]);
            if(!empty($update))
            {
                $message['success'] = 1;
                $message['message'] = 'location updated successfully';
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'Something went wrong!'; 
            }
        }
        return response()->json($message);
    }
    public function markAttendance(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required',
            'latitude'=> 'required',
            'longitude'=> 'required',
            'location'=> 'required',
            'checkinStatus'=> 'required',
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $insert = UserAttendance::insert(['user_id'=>$inputs['userId'],'location'=>$inputs['location'],'latitude'=>$inputs['latitude'],'longitude'=>$inputs['longitude'],'date'=>date('Y-m-d'),'time'=>date('H:i:s'),'checkin_status'=>$inputs['checkinStatus']]);
            if(!empty($insert))
            {
                $message['success'] = 1;
                $message['message'] = 'Attendance Marked successfully';
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'Something went wrong!'; 
            }
        }
        return response()->json($message);
    }
    public function ReportsList(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $reports = UserReports::where(['user_id'=>$inputs['userId']])->get();
            if(!empty($reports))
            {
                $message['success'] = 1;
                $message['message'] = 'Details get successfully';
                $message['reports'] = $reports;
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'No reports found';
                $message['reports'] = []; 
            }
        }
        return response()->json($message);
    }
    public function LeavesList(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required',
           // 'status'=> 'required',
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
           // $approved_counts = UserLeaves::where(['user_id'=>$inputs['userId'],'status'=>'1','user_read_status'=>'0'])->count();
           // $declined_counts = UserLeaves::where(['user_id'=>$inputs['userId'],'status'=>'2','user_read_status'=>'0'])->count();
            $leaves = UserLeaves::where(['user_id'=>$inputs['userId']])->get();
           // UserLeaves::where(['user_id'=>$inputs['userId'],'status'=>$inputs['status']])->update(['user_read_status'=>'1']);
            if(!empty($leaves))
            {
                $message['success'] = 1;
                $message['message'] = 'Details get successfully';
               // $message['approved_counts'] = "$approved_counts";
                //$message['declined_counts'] = "$declined_counts";
                $message['leaves'] = $leaves;
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'No reports found';
                $message['leaves'] = []; 
            }
        }
        return response()->json($message);
    }
    public function ConversationList(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required',
            'supervisorId'=> 'required',
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $user_id = $inputs['userId'];
            $supervisor_id = $inputs['supervisorId'];
            $conversations = Conversation::where(['sender_id' => $user_id,'receiver_id' => $supervisor_id])->orWhere(function($q)use ($user_id,$supervisor_id) {
                $q->where(['receiver_id' => $user_id,'sender_id' => $supervisor_id]);
            })->get();
            if(!empty($conversations))
            {
                foreach($conversations as $conversation)
                {
                    if($user_id == $conversation->sender_id)
                    {
                        $userDet = User::where('id',$conversation->sender_id)->first();
                    }
                    else
                    {
                        $userDet = User::where('id',$conversation->sender_id)->first();
                    }
                    $conversation->user_name =  $userDet->name;
                    $conversation->user_image =  $userDet->image;
                    $conversation->time =  date('h:i a',strtotime($conversation->created_at));
                    $conversationss[] = $conversation;
                }
                $message['success'] = 1;
                $message['message'] = 'Details get successfully';
                $message['conversation'] = $conversationss;
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'No conversation found yet';
                $message['leaves'] = []; 
            }
        }
        return response()->json($message);
    }
    public function singleReportDetails(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'reportId'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $reportDetails = UserReports::where(['id'=>$inputs['reportId']])->first();
            if(!empty($reportDetails))
            {
                $images = explode(',', $reportDetails['images']);
                foreach($images as $image)
                {
                    $imagess[] = array('image'=>$image);
                }
                $reportDetails['images'] = $imagess;
                $message['success'] = 1;
                $message['message'] = 'Details get successfully';
                $message['report_details'] = $reportDetails;
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'No reports found';
                $message['report_details'] = ""; 
            }
        }
        return response()->json($message);
    }
    public function genrateReport(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required',
            'reportTitle'=> 'required',
            'reportDescription'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
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
            if(!empty($insert))
            {
                $message['success'] = 1;
                $message['message'] = 'Report created successfully';
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'Something went wrong!'; 
            }
        }
        return response()->json($message);
    }
    public function sendMessage(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'senderId'=> 'required',
            'receiverId'=> 'required',
            'message'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $employee_id = $inputs['senderId'];
            $supervisorID =  $inputs['receiverId'];
            
            $checkInbox = Inbox::where(['sender_id' => $inputs['receiverId'],'receiver_id' => $employee_id])->orWhere(function($q)use ($employee_id,$supervisorID){ $q->where(['sender_id' => $employee_id,'receiver_id' => $supervisorID]);
            })->first();
            if(!$checkInbox)
            {
                $insert = Inbox::insert(['sender_id' => $employee_id,'receiver_id' => $inputs['receiverId'],'message' => $inputs['message'],'read_status'=>'0', 'created_at'=>date('Y-m-d H:i:s')]);
            }
            else
            {
                $insert = Inbox::where('id',$checkInbox->id)->update(['sender_id' => $employee_id,'receiver_id' => $inputs['receiverId'],'message' => $inputs['message'],'read_status'=>'0', 'created_at'=>date('Y-m-d H:i:s')]);
            }
            Conversation::insert(['sender_id' => $employee_id,'receiver_id' =>$inputs['receiverId'],'message' => $inputs['message'],'read_status'=>'0', 'created_at'=>date('Y-m-d H:i:s')]);
            if(!empty($insert))
            {
                $message['success'] = 1;
                $message['message'] = 'Message send successfully';
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'Something went wrong!'; 
            }
        }
        return response()->json($message);
    }
    public function leaveRequest(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $inputs = $request->all();
        $validator = Validator::make( $inputs  , [
            'userId'=> 'required',
            'from'=> 'required',
            'to'=> 'required',
            'message'=> 'required'
        ]);
        if ($validator->fails()) 
        {
            $message['success'] = 0;
            $message['message'] = $validator->errors()->first(); 
        }
        else
        {
            $siteDet = Site::where('employee_id',$inputs['userId'])->first();
            $insert = UserLeaves::insert(['supervisor_id'=>$siteDet->supervisor_id,'client_id'=>$siteDet->client_id,'site_id'=>$siteDet->id,'user_id'=>$inputs['userId'],'date_from'=>$inputs['from'],'date_to'=>$inputs['to'],'message'=>$inputs['message'],'status'=>0,'created_at'=>date('Y-m-d H:i:s')]);
            if(!empty($insert))
            {
                $message['success'] = 1;
                $message['message'] = 'Leave applied successfully';
            }
            else
            {
                $message['success'] = 0;
                $message['message'] = 'Something went wrong!'; 
            }
        }
        return response()->json($message);
    }          
}
