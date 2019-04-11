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
		return View::make('valet/login');
    }
	public function login(Request $request)
	{
		$this->validate($request,[
         'email'=>'required',
         'password'=>'required'
		]);	  
		$user = DB::select(DB::raw("select * from valets where ( email = '".$request->email."' OR phone = '".$request->email."') and password='".md5($request->password)."'"));
		//print_r($user);die;
		if(!empty($user))
		{		
			Session::put('valet_id', $user[0]->id);
			
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
		Session::flash('success', 'Message send successfully Link: http://localhost/valet_parking/public/client/request_detail/'.$ticket);		
		return redirect('/valet/type');
    }
	public function go_to_available($ticket)
    {
		$update = DB::table('tickets')->where('ticketno', $ticket)->update(['status' => '5']);
		//http://localhost/valet_parking/public/client/request_detail/'.$ticket);		
		return redirect('/valet/type');
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
		return view('valet/request_response',['ticket_details'=>$ticket_details]);
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
		$check_availbilty = DB::table('tickets')->where(['valet_id' => Session::get('valet_id'),'ticketno' => $request->ticketno])->first();
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
			$insert = DB::table('tickets')->insert(['valet_id' => Session::get('valet_id'),'ticketno' => $request->ticketno,'phone' => $request->phone,'created' => date('Y-m-d H:i:s')]);	
			Session::flash('success', 'Ticket genrated Successfully Link: http://localhost/valet_parking/public/client/car_details/'.$request->ticketno);
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
}
