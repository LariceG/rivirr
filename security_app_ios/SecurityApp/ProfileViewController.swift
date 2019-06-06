//
//  ProfileViewController.swift
//  SecurityApp
//
//  Created by apple on 07/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import SVProgressHUD
import Alamofire
import SDWebImage
import AVFoundation
import AudioToolbox.AudioServices
import Photos


class ProfileViewController: UIViewController, UIImagePickerControllerDelegate, UINavigationControllerDelegate {

    //MARK :- IBOUTLETS
    @IBOutlet weak var scrollView : UIScrollView!
    @IBOutlet weak var profileImageView : UIImageView!
    @IBOutlet weak var btn_Edit : UIButton!
    @IBOutlet weak var txt_Name : UITextField!
    @IBOutlet weak var txt_Email : UITextField!
    @IBOutlet weak var txt_Phone : UITextField!
    @IBOutlet weak var txt_Address : UITextView!
    @IBOutlet weak var headerView : UIView!
    @IBOutlet weak var contentView : UIView!
    @IBOutlet weak var btn_ChangePicture : UIButton!
    //MARK :- VARIABLES AND CONSTANTS
    var buttonClicked : Bool = false
    var defaults = UserDefaults.standard
    var userDetails = NSDictionary()
    let imagePicker = UIImagePickerController()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        self.imagePicker.delegate = self
        
        let firstLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15))
        let secondLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15))
        let thridLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15))
        
        txt_Name.leftViewMode = .always
        txt_Name.leftView = firstLeftView
        
        txt_Email.leftViewMode = .always
        txt_Email.leftView = secondLeftView
        
        txt_Phone.leftViewMode = .always
        txt_Phone.leftView = thridLeftView
        
        
        scrollView.contentSize = CGSize(width: contentView.frame.width, height: contentView.frame.height)
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 10, textfield: txt_Name)
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 10, textfield: txt_Email)
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 10, textfield: txt_Phone)
        txt_Address.layer.cornerRadius = 10
        txt_Address.layer.masksToBounds = true
        
        UtilityClass.shared.addCornerRadiusToButton(radius: 10, button: btn_Edit)

        //let image = UIImage(named: "Userdummy")
        //profileImageView.maskCircle(anyImage: image!)
        self.profileImageView.layer.cornerRadius = self.profileImageView.frame.size.width / 2;
        self.profileImageView.clipsToBounds = true;
        self.btn_ChangePicture.isUserInteractionEnabled = false
        
         self.getProfile()
        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    override func viewWillAppear(_ animated: Bool) {
       
    }
    //MARK :- IBACTIONS
    @IBAction func changeImage(_ sender : UIButton)
    {
        let status = PHPhotoLibrary.authorizationStatus()
        switch status {
            
        case .authorized:
            self.openCamera()
        case .denied, .restricted:
            UtilityClass.shared.alertMessage(message: "Photo library usage denied!", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
            
        default:
            // ask for permissions
            PHPhotoLibrary.requestAuthorization { status in
                switch status {
                case .authorized:
                    // as above
                    self.openCamera()
                case .denied, .restricted:
                    // as above
                    UtilityClass.shared.alertMessage(message: "Photo library usage denied!", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                case .notDetermined: break
                    // won't happen but still
                }
            }
        }
    }
    @IBAction func backButton(_ sender : UIButton)
    {
        self.navigationController?.popViewController(animated: true)
    }
    @IBAction func editButton(_ sender : UIButton)
    {
        if(buttonClicked)
        {
            self.buttonClicked = false
            self.btn_ChangePicture.isUserInteractionEnabled = false
            txt_Name.backgroundColor = UIColor.white
            txt_Email.backgroundColor = UIColor.white
            txt_Phone.backgroundColor = UIColor.white
            txt_Address.backgroundColor = UIColor.white
            
            txt_Name.isUserInteractionEnabled = false
            txt_Phone.isUserInteractionEnabled = false
            txt_Email.isUserInteractionEnabled = false
            txt_Address.isUserInteractionEnabled = false
            
            btn_Edit.backgroundColor = UIColor(red: 239/255.0, green: 239/255.0, blue: 239/255.0, alpha: 1)
            btn_Edit.setTitle("Edit", for: .normal)
            self.updateProfile()
        }
        else
        {
            self.buttonClicked = true
            self.btn_ChangePicture.isUserInteractionEnabled = true
            txt_Name.backgroundColor = UIColor(red: 236/255.0, green: 235/255.0, blue: 235/255.0, alpha: 1)
            txt_Email.backgroundColor = UIColor(red: 236/255.0, green: 235/255.0, blue: 235/255.0, alpha: 1)
            txt_Phone.backgroundColor = UIColor(red: 236/255.0, green: 235/255.0, blue: 235/255.0, alpha: 1)
            txt_Address.backgroundColor = UIColor(red: 236/255.0, green: 235/255.0, blue: 235/255.0, alpha: 1)
            
            txt_Name.isUserInteractionEnabled = true
            txt_Phone.isUserInteractionEnabled = true
            txt_Email.isUserInteractionEnabled = true
            txt_Address.isUserInteractionEnabled = true
            
            btn_Edit.backgroundColor = UIColor(red: 17/255.0, green: 175/255.0, blue: 68/255.0, alpha: 1)
            btn_Edit.setTitle("Update", for: .normal)
            
            
            
        }
    }
    //MARK :- IMAGEPICKER DELEGATE METHOD
    func imagePickerController(_ picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [UIImagePickerController.InfoKey : Any]) {
        if let pickedImage = info[UIImagePickerController.InfoKey.originalImage] as? UIImage {
            // imageViewPic.contentMode = .scaleToFill
            
            profileImageView.image = pickedImage
            profileImageView.contentMode = .scaleAspectFill
//            self.profileImageView.layer.cornerRadius = self.profileImageView.frame.size.width / 2;
//            self.profileImageView.clipsToBounds = true;
            
        }
        picker.dismiss(animated: true, completion: nil)
    }
  
    //MARK :- OTHER FUNCTIONS
    func openCamera()
    {
        imagePicker.sourceType = UIImagePickerController.SourceType.photoLibrary
        imagePicker.allowsEditing = true
        self.present(imagePicker, animated: true, completion: nil)
    }
    func setUpView()
    {
        let image = userDetails.value(forKey: "image") as? String
        if(image == nil) || ((image?.isEmpty)!)
        {
            
        }
        else
        {
            self.profileImageView.sd_setImage(with: URL(string: image!), placeholderImage: UIImage(named: "userDummy"), options: [], completed: nil)
        }
        self.txt_Name.text = userDetails.value(forKey: "name") as? String
        self.txt_Email.text = userDetails.value(forKey: "email") as? String
        self.txt_Phone.text = userDetails.value(forKey: "phone") as? String
        self.txt_Address.text = userDetails.value(forKey: "address") as? String
    }
    
    //MARK :- SERVER CALLS
    func getProfile()
    {
        //SVProgressHUD.show()
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "getProfile"
            let userID = defaults.value(forKey: "userid") as! Int
            
            let param : Parameters = [
                "userId" : userID
            ]
            print(param)
            CallWebService.shared.postRequest(strURL: URL, params: param, completion: { (success, responseObject) in
                let response = responseObject as! NSDictionary
                print(response)
                let status = response.value(forKey: "success") as! Int
                if success == true
                {
                    if(status == 1)
                    {
                        DispatchQueue.main.async {
                            
                            self.view.isUserInteractionEnabled = true
                            self.userDetails = response.value(forKey: "details") as! NSDictionary
                            self.setUpView()
                            SVProgressHUD.dismiss()
                        }
                    }
                        
                    else
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        UtilityClass.shared.alertMessage(message: response.value(forKey: "message") as! String, title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                    }
                }
                else
                {
                    if(status == 100)
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        UtilityClass.shared.alertMessage(message: response.value(forKey: "message") as! String, title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                    }
                    else
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                    }
                }
            })
        }
        else
        {
            SVProgressHUD.dismiss()
            self.view.isUserInteractionEnabled = true
            UtilityClass.shared.alertMessage(message: "No Internet Connection", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
    }
    
    func updateProfile()
    {
        //SVProgressHUD.show()
        //,,,,,,image(multipart)
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            //Parameter HERE
            let userID = defaults.value(forKey: "userid") as! Int
            let str = String(userID)
            let param = [
                "userId" : str,
                "name" : txt_Name.text!,
                "email" : txt_Email.text!,
                "phone" : txt_Phone.text!,
                "alternate_phone" : txt_Phone.text!,
                "address" : txt_Address.text!
                
            ]
            //Header HERE
            let headers : HTTPHeaders = [
                "Content-type": "multipart/form-data"
                
            ]
            
            let frontImage = profileImageView.image
            let imgData = frontImage?.jpegData(compressionQuality: 0.7)
            
            
            Alamofire.upload(multipartFormData: { multipartFormData in
                //Parameter for Upload files
                multipartFormData.append(imgData!, withName: "image",fileName: "swift.png" , mimeType: "image/png")
             
                
                for (key, value) in param
                {
                    multipartFormData.append(value.data(using: String.Encoding.utf8)!, withName: key)
                }
                
            }, usingThreshold:UInt64.init(),
               to: "http://3.17.239.65/security_app/public/api/updateProfile", //URL Here
                method: .post,
                headers: headers, //pass header dictionary here
                encodingCompletion: { (result) in
                    
                    switch result {
                    case .success(let upload, _, _):
                        print("the status code is :")
                        
                        upload.uploadProgress(closure: { (progress) in
                            print("Upload Progress: \(progress.fractionCompleted)")
                            
                            
                            DispatchQueue.main.async() {
                                let percentage = Float(progress.fractionCompleted) / Float(1.0)
                                let x = Int(percentage*100)
                                
                                if(x == 100){
                                    
                                }else{
                                    SVProgressHUD.showProgress(percentage, status: "Uploading (\(x)%)")
                                    
                                }
                                
                                
                                
                            }
                            
                        })
                        
                        upload.responseJSON { response in
                            SVProgressHUD.dismiss()
                            self.view.isUserInteractionEnabled = true
                            print("the resopnse code is : \(response.response?.statusCode)")
                            print("the response is : \(response)")
                            if(response.response?.statusCode == 200)
                            {
                                UtilityClass.shared.alertMessage(message: "Profile updated successfully.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                            }
                            else
                            {
                                UtilityClass.shared.alertMessage(message: "Something went wrong please try again!", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                            }
                            
                        }
                        break
                    case .failure(let encodingError):
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        print("the error is  : \(encodingError.localizedDescription)")
                        break
                    }
            })
        }
        else
        {
            SVProgressHUD.dismiss()
            self.view.isUserInteractionEnabled = true
            UtilityClass.shared.alertMessage(message: "No Internet Connection", title: "PPS", viewcontrolller: self)
        }
    }
    

}// CLASS ENDS HERE.......
