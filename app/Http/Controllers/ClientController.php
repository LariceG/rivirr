<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use Session;
class ClientController extends Controller
{
    public function car_details($ticket)
    {
		return view('client/car_details',['ticket'=>$ticket]);
    }
	public function ticket_response($ticket)
    {
		return view('client/ticket_response',['ticket'=>$ticket]);
    }
	public function request_detail($ticket)
    {
		$ticket_details = DB::table('tickets')->where(['ticketno' => $ticket])->leftJoin('valets', 'valets.id', '=', 'tickets.valet_id')->select('tickets.*', 'valets.name', 'valets.image')->first();
		return view('client/request_detail',['ticket_details'=>$ticket_details]);
    }
	public function send_request($ticket)
    {
		$update = DB::table('tickets')->where('ticketno', $ticket)->update(['status' => '2']);
		Session::flash('success', 'Request Send successfully Link: http://localhost/valet_parking/public/valet/request_response/'.$ticket);		
		return redirect('/client/request_detail/'.$ticket);
    }
	public function update_car_details(Request $request)
	{
		$this->validate($request,[
         'first_name'=>'required',
         'brand'=>'required',
         'color'=>'required'
		]);
		$update = DB::table('tickets')->where('ticketno', $request->ticketno)->update(['first_name' => $request->first_name,'brand' => $request->brand,'color' => $request->color,'year' => $request->year,'model' => $request->model]);		
		return redirect('/client/ticket_response/'.$request->ticketno);		 		
	}
}
