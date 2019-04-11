<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Admin;
use App\Recruit;
use App\Category;
use App\Employee;
use Session;
use DB;
use validate; 
class EmployerController extends Controller
{
    public  function index() 
    {	
        $active = 'login';
		return view('frontend/employer/login',['active' => $active]);
  
    }
    
    public function signup()
    {
        $active = 'signup';
        return view('frontend/employer/signup',['active' => $active]);
        
    }
    
    public function sign_up(Request $request)
    {
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'useremail'=>'required|email',
            'university'=>'required',
            'major'=>'required',
            'pass'=>'required',
        ]);
           
        DB::table('employees')->insert(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'university'=>$request->university,'major'=>$request->major,'email'=>$request->useremail,'password'=>md5($request->pass)]);
        
        
        return redirect('/employer');
    }
    
    
    
	public function login(Request $request)
    {
       $this->validate($request,[
            'username'=>'required|email',
            'password'=>'required',
            
        ],['username.required'=>'The Email field is required.','username.email'=>'The Email must be valid email address.',]);
   
        $login_data=DB::table('employees')->where(['email'=>$request->username,'password'=>md5($request->password)])->first();
        
        
        if(!empty($login_data))
        {
            Session::put(['user_id'=>$login_data->id,'user_name'=>$login_data->first_name]); 
            return redirect('/');
            
        }
        else
        {
            Session::flash('error','Please enter valid credentials!');
            return redirect('/employer');
            
        }

    }
       	
    public function home()
        {
            $active = 'home';
            
           $data['new_grad_support']=DB::table('employers')->where(['category'=>'Best Employers for New Graduate Support'])->get();
           $data['women_in_leadership']=DB::table('employers')->where(['category'=>'Best Employers for Women in Leadership'])->get();
           $data['giving_back']=DB::table('employers')->where(['category'=>'Best Employers for Giving Back'])->get();
           $data['diversity_in_leadership']=DB::table('employers')->where(['category'=>'Best Employers for Diversity in Leadership'])->get();
           $data['conscious_employers']=DB::table('employers')->where(['category'=>'Top Environmentally Conscious Employers'])->get();
           $data['featured_employers']=DB::table('employers')->where(['category'=>'Featured Employer'])->get();
           //$data['top_employers']=DB::table('employers')->where(['category'=>'Top Employers'])->get();
           $data['home_video']=DB::table('employers')->where(['home_page_video'=>'home_vedio'])->first(); 
           $data['all']=DB::table('employers')->get();
        
        return view('frontend/employer/home',['active' => $active],$data);
   
        }
    public function logout()
    {
        session()->flush('id');
        return redirect('/');
        
    }
        
    public function edit_profile($id)
    {
        if(empty(Session::get('user_id')))
        {
            return redirect('/employer');
        }
        
         $active = '';
        $data=DB::table('employees')->where('id',$id)->first();
       
        return view('frontend/employer/edit_profile',['active'=>$active,'data'=>$data]);
    }
    public function editprofile(Request $request,$id)
    {
        $data=DB::table('employees')->where('id',$id)->first();
        $old_password=md5($request->old_pass);
        $file=$request->file('image');
         
        $this->validate($request,['old_pass'=>'required'],['old_pass.required'=>'Please enter your old password']);
        
        if($data->password == $old_password )
        {
           
            if(!empty($file))
            {
            
            DB::table('employees')->where('id',$id)->update(['username'=>$request->username,'email'=>$request->useremail,'password'=>md5($request->new_pass),'image'=>$file->getClientOriginalName(),'phone'=>$request->phone,'created'=>date('Y-m-d h:i:s'),'updated'=>date('Y-m-d h:i:s')]);
            
           $file->move('uploads', $file->getClientOriginalName()); 
        
            return redirect('/');
            }
            
            else
            {
                
                DB::table('employees')->where('id',$id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'university'=>$request->university,'major'=>$request->major,'email'=>$request->useremail,'password'=>md5($request->new_pass)]);
                
                 return redirect('/');
            }
            
            
            
            
        }
       else
       {
           
           \Session::flash('worng_pass','Old password dose not match');
         return redirect()->action(
    'EmployerController@edit_profile', ['id' => $id]);
           
       }
        
    }
}
