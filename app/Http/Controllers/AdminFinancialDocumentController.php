<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use DB;
class AdminFinancialDocumentController extends Controller
{
    public function document()
    {
        $data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
        $data['document'] = DB::table('financial_document')->get();
        $data['active'] = 'Financial Documents';
		$data['title'] = 'Financial Documents';
        return view('admin/Financial_document/manage',$data);
    }
   public function add()
   {
    $data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
    $data['active'] = 'Financial Documents';
    $data['title'] = 'Add Financial Documents';
    return view('admin/Financial_document/add',$data);
   }
   public function insert(Request $request)
   {
        $image = $request->file('img');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'uploads/financial_documents';
        $image->move($destinationPath,$name);
        $data=['document'=>url('uploads/financial_documents').'/'.$name];
        DB::table('financial_document')->insert($data);
        Session::flash('success ','Document add successfully');
        return redirect(url('admin/financial_documents'));
   }
   public function delete($id)
   {
           DB::table('financial_document')->where(['id'=>$id])->delete();
           Session::flash('error','Document delete successfully');
           return redirect(url('admin/financial_documents'));
   }
   public function edit($id)
   {
    $data['admin'] = User::where(['id' => Session::get('admin_id')])->first();
    $data['document'] = DB::table('financial_document')->where(['id'=>$id])->first();
    $data['active'] = 'Financial Documents';
    $data['title'] = 'Edit Financial Documents';
    return view('admin/Financial_document/edit',$data);
   }
   public function update(Request $request)
   {
       $image = $request->file('img');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'uploads/financial_documents';
        $image->move($destinationPath,$name);
        $data=['document'=>url('uploads/financial_documents').'/'.$name];
    DB::table('financial_document')->where(['id'=>$request->document])->update($data);
    Session::flash('success ','Document edit successfully');
    return redirect(url('admin/financial_documents'));
   }
}
