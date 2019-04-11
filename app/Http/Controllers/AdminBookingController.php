<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use Session;
class AdminBookingController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = DB::table('admin')->where(['id' => Session::get('admin_id')])->first();
		$datas = DB::table('tickets')->leftJoin('valets', 'valets.id', '=', 'tickets.valet_id')->select('tickets.*', 'valets.name')->get();
		return view('admin/bookings/manage',['admin'=>$admin,'datas'=>$datas]);
    }
	public function edit_valet($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = DB::table('admin')->where(['id' => Session::get('admin_id')])->first();
		$categories = DB::table('categories')->get();
		$data = DB::table('valets')->where(['id' => $id])->first();
		return view('admin/valets/edit',['admin'=>$admin,'data'=>$data,'categories'=>$categories]);
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
