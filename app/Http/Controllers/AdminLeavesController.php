<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\User;
class AdminLeavesController extends Controller
{
    
    public function leaves()
    {
        if(!Session::get('admin_id'))
        {
            return redirect('/admin');exit;
        }

       $data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
       if( Session::get('user_type') == 'supervisor')
      {
        $leaves=DB::table('user_leaves')->where(['supervisor_id'=>Session::get('admin_id')])->get();
        foreach($leaves as $leave)
        {
            $leave->client_name=DB::table('users')->where(['id'=>$leave->client_id])->value('name');
            $leave->user_name=DB::table('users')->where(['id'=>$leave->user_id])->value('name');
            $leave->site_name=DB::table('sites')->where(['id'=>$leave->site_id])->value('site_name');
            $data['leaves'][] = $leave;
        }
        DB::table('user_leaves')->where(['supervisor_id' => Session::get('admin_id')])->update(['read_status'=>'1']);
      }
      if( Session::get('user_type') == 'admin')
      {
        $leaves=DB::table('user_leaves')->get();
        foreach($leaves as $leave)
        {
            $leave->client_name=DB::table('users')->where(['id'=>$leave->client_id])->value('name');
            $leave->user_name=DB::table('users')->where(['id'=>$leave->user_id])->value('name');
            $leave->site_name=DB::table('sites')->where(['id'=>$leave->site_id])->value('site_name');
            $leave->supervisor_name=DB::table('users')->where(['id'=>$leave->supervisor_id])->value('name');
            $data['leaves'][] = $leave;
        }
      }

      if( Session::get('user_type') == 'employee')
      {
        $leaves=DB::table('user_leaves')->where(['user_id'=>Session::get('admin_id')])->get();
        foreach($leaves as $leave)
        {
            $leave->client_name=DB::table('users')->where(['id'=>$leave->client_id])->value('name');
            $leave->user_name=DB::table('users')->where(['id'=>$leave->user_id])->value('name');
            $leave->site_name=DB::table('sites')->where(['id'=>$leave->site_id])->value('site_name');
            $data['leaves'][] = $leave;
        }
        //DB::table('user_leaves')->where(['supervisor_id' => Session::get('admin_id')])->update(['read_status'=>'1']);
      }
        $data['active'] = 'leaves';
         $data['title'] = 'Manage Leaves';
        return view('admin/leaves/manage',$data);
    }

   public function change_status($id,$status)
   {
       
    DB::table('user_leaves')->where(['id'=>$id])->update(['status'=>$status]);
    if($status == '1')
    {
        Session::flash('success','Leave  approved successfully');
    }
    if($status == '2')
    {
        Session::flash('success','Leave declined successfully');
    }
    return redirect('/admin/leaves');
   }
}
