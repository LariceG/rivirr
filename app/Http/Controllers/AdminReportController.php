<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\User;
use App\Site;
use App\UserReports;
use Session;
class AdminReportController extends Controller
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
				$reports = UserReports::orderBy('id', 'desc')->get();
			}
			elseif(Session::get('user_type') == 'supervisor')
			{
				$reports = UserReports::where('supervisor_id',Session::get('admin_id'))->orderBy('id', 'desc')->get();
			}
			elseif(Session::get('user_type') == 'client')
			{
				$reports = UserReports::where('client_id',Session::get('admin_id'))->orderBy('id', 'desc')->get();
			}
			elseif(Session::get('user_type') == 'employee')
			{
				$reports = UserReports::where('user_id',Session::get('admin_id'))->orderBy('id', 'desc')->get();
			}
			
			$data['datas'] = [];
			foreach($reports as $report)
			{
				$report['supervisor_name'] = User::where(['id' => $report->supervisor_id])->value('name');
				$report['employee_name'] = User::where(['id' => $report->user_id])->value('name');
				$report['site'] = Site::where(['id' => $report->site_id])->value('site_name');
				$images = explode(',',$report->images);
				$report['image'] = $images[0];
				$data['datas'][] = 	$report;
			}
			$data['active'] = 'reports';
			$data['title'] = 'Manage Reports';
			return view('admin/reports/manage',$data);
    }
	public function view($id)
	{		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
		$reportDet = UserReports::where('id', $id)->first();
		$reportDet['supervisor_name'] = User::where(['id' => $reportDet->supervisor_id])->value('name');
		$reportDet['employee_name'] = User::where(['id' => $reportDet->user_id])->value('name');
		$reportDet['site'] = Site::where(['id' => $reportDet->site_id])->value('site_name');
		$data['data'] = $reportDet;
		$data['active'] = 'reports';
		$data['title'] = 'View Report Details';
		return view('admin/reports/view',$data);
  }
		public function delete($id)
    {		
			if(!Session::get('admin_id'))
			{
				return redirect('/admin');exit;
			}
			$delete = UserReports::where('id', $id)->delete();
			Session::flash('success', 'Report deleted Successfully'); 		
			return redirect('/admin/reports');
    }
}
