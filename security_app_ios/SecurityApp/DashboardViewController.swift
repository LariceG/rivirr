//
//  DashboardViewController.swift
//  SecurityApp
//
//  Created by apple on 07/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD
import SDWebImage




class DashboardViewController: UIViewController {

    //MARK :- IBOUTLETS
    @IBOutlet weak var profileImage : UIImageView!
    @IBOutlet weak var statusImage : UIImageView!
    @IBOutlet weak var lbl_Status : UILabel!
    @IBOutlet weak var lbl_WorkingHours : UILabel!
    @IBOutlet weak var btn_Logout : UIButton!
    @IBOutlet weak var btn_MarkAttendence : UIButton!
    @IBOutlet weak var shadowView : UIView!
    @IBOutlet var popUpView : UIView!
    @IBOutlet var customView : UIView!
    @IBOutlet var btn_CheckIn : UIButton!
    @IBOutlet var lbl_PopWorkingHours : UILabel!
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    var checkInstatus = String()
    
    override func viewDidLoad() {
        super.viewDidLoad()

        UtilityClass.shared.addCornerRadiusToView(radius: 5, view: customView)
        customView.layer.borderColor = UIColor.lightGray.cgColor
        customView.layer.borderWidth = 0.5
        
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_CheckIn)
        
        lbl_PopWorkingHours.layer.cornerRadius = 5
        lbl_PopWorkingHours.layer.borderColor = UIColor.lightGray.cgColor
        lbl_PopWorkingHours.layer.borderWidth = 0.5
        lbl_PopWorkingHours.layer.masksToBounds = true
        
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_Logout)
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_MarkAttendence)
        let image = UIImage(named: "Userdummy")
        self.profileImage.maskCircle(anyImage: image!)
        lbl_WorkingHours.layer.cornerRadius = 5
        lbl_WorkingHours.layer.masksToBounds = true
        
        shadowView.layer.shadowColor = UIColor.lightGray.cgColor
        shadowView.layer.masksToBounds = false
        shadowView.layer.shadowOffset = CGSize(width: 0.0 , height: 3.0)
        shadowView.layer.shadowOpacity = 0.5
        shadowView.layer.shadowRadius = 1.0
        
        
        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    override func viewWillAppear(_ animated: Bool) {
        self.getProfile()
        self.dashboard()
    }
    //MARK :- IBACTIONS
    @IBAction func messageButton(_ sender : UIButton)
    {
        let myController = self.storyboard?.instantiateViewController(withIdentifier: "ChatViewController") as! ChatViewController
        self.navigationController?.pushViewController(myController, animated: true)
    }
    @IBAction func reportButton(_ sender : UIButton)
    {
        let myController = self.storyboard?.instantiateViewController(withIdentifier: "ReportViewController") as! ReportViewController
        self.navigationController?.pushViewController(myController, animated: true)
    }
    @IBAction func leaveButton(_ sender : UIButton)
    {
        let myController = self.storyboard?.instantiateViewController(withIdentifier: "ApplyLeaveViewController") as! ApplyLeaveViewController
        self.navigationController?.pushViewController(myController, animated: true)
    }
    @IBAction func attendenceButton(_ sender : UIButton)
    {
        self.popUpView.isHidden = false
    }
    @IBAction func profileButton(_ sender : UIButton)
    {
        let myController = self.storyboard?.instantiateViewController(withIdentifier: "ProfileViewController") as! ProfileViewController
        self.navigationController?.pushViewController(myController, animated: true)
    }
    @IBAction func logoutButton(_ sender : UIButton)
    {
        self.checkLogin()
        //self.navigationController?.popToRootViewController(animated: true)
    }
    @IBAction func checkInOutButton(_ sender : UIButton)
    {
        self.popUpView.isHidden = true
    }
    //MARK :- OTHER FUNCTIONS
    func checkLogin()
    {
        let islogin = defaults.value(forKey: "islogin") as? String
        //print(defaults.value(forKey: "userID") as? String)
        if(islogin == "1")
        {
            //let userType = defaults.value(forKey: "usertype") as? String
            defaults.set("0", forKey: "islogin")
            let storyboard = UIStoryboard(name: "Main", bundle: nil)
            let myController = storyboard.instantiateViewController(withIdentifier: "ViewController") as! ViewController
            let appDelegate = UIApplication.shared.delegate as! AppDelegate
            appDelegate.window?.rootViewController = myController
            appDelegate.window?.makeKeyAndVisible()
        }
    }
    func setUpImage(image : String)
    {
        self.profileImage.sd_setImage(with: URL(string: image), placeholderImage: UIImage(named: "Userdummy"), options: [], completed: nil)
    }
    //MARK :- SERVER CALLS
    func getProfile()
    {
        //SVProgressHUD.show()  userDashboard
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
                            SVProgressHUD.dismiss()
                            self.view.isUserInteractionEnabled = true
                            let result = response.value(forKey: "details") as! NSDictionary
                            let image = result.value(forKey: "image") as? String
                            if(image == nil) || ((image?.isEmpty)!)
                            {
                                self.profileImage.image = UIImage(named: "Userdummy")
                            }
                            else
                            {
                                self.setUpImage(image : image!)
                            }
                            
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
    func dashboard()
    {
        //SVProgressHUD.show()
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "userDashboard"
            let userID = defaults.value(forKey: "userid") as! Int
            let str = String(userID)
            let param : Parameters = [
                "userId" : str
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
                            SVProgressHUD.dismiss()
                            self.view.isUserInteractionEnabled = true
                            let result = response.value(forKey: "details") as! NSDictionary
                            let workingHours = result.value(forKey: "totalWorkingHours") as? String
                            if(workingHours == "0")
                            {
                                self.lbl_WorkingHours.text = "0 hours 0 mins"
                                self.lbl_PopWorkingHours.text = "0 hours 0 mins"
                            }
                            else
                            {
                                self.lbl_WorkingHours.text = result.value(forKey: "totalWorkingHours") as? String
                                self.lbl_PopWorkingHours.text = result.value(forKey: "totalWorkingHours") as? String
                            }
                            
                            self.checkInstatus = result.value(forKey: "checkin_status") as! String
                            if(self.checkInstatus == "")
                            {
                                self.lbl_Status.text = "You have not checked-in today"
                                self.statusImage.isHidden = false
                                
                            }
                            else if(self.checkInstatus == "checkin")
                            {
                                self.lbl_Status.text = "You have checked-in"
                                self.statusImage.isHidden = true
                            }
                            else
                            {
                                self.lbl_Status.text = "You have checked-out"
                                self.statusImage.isHidden = true
                            }
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
    func markAttendence(status : String)
    {
        //SVProgressHUD.show() userId,,,,(1,0 (1 for checkin and 0 for checkout)
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "markAttendance"
            let userID = defaults.value(forKey: "userid") as! Int
            let str = String(userID)
            let param : Parameters = [
                "userId" : str,
                "latitude" : "12",
                "longitude" : "12",
                "location" : "asdasd",
                "checkinStatus" : status
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
                            SVProgressHUD.dismiss()
                            self.view.isUserInteractionEnabled = true
                            let result = response.value(forKey: "details") as! NSDictionary
//                            let workingHours = result.value(forKey: "totalWorkingHours") as? String
//                            if(workingHours == "0")
//                            {
//                                self.lbl_WorkingHours.text = "0 hours 0 mins"
//                                self.lbl_PopWorkingHours.text = "0 hours 0 mins"
//                            }
//                            else
//                            {
//                                self.lbl_WorkingHours.text = result.value(forKey: "totalWorkingHours") as? String
//                                self.lbl_PopWorkingHours.text = result.value(forKey: "totalWorkingHours") as? String
//                            }
//
//                            self.checkInstatus = result.value(forKey: "checkin_status") as! String
//                            if(self.checkInstatus == "")
//                            {
//                                self.lbl_Status.text = "You have not checked-in today"
//                                self.statusImage.isHidden = false
//
//                            }
//                            else if(self.checkInstatus == "checkin")
//                            {
//                                self.lbl_Status.text = "You have checked-in"
//                                self.statusImage.isHidden = true
//                            }
//                            else
//                            {
//                                self.lbl_Status.text = "You have checked-out"
//                                self.statusImage.isHidden = true
//                            }
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
    
}// CLASS ENDS HERE.....
