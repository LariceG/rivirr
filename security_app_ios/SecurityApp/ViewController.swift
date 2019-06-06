//
//  ViewController.swift
//  SecurityApp
//
//  Created by apple on 07/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD
import SDWebImage



class ViewController: UIViewController, UITextFieldDelegate {

    //MARK :- IBOUTLETS
    @IBOutlet weak var txt_Username : UITextField!
    @IBOutlet weak var txt_Pasword : UITextField!
    @IBOutlet weak var btn_Login : UIButton!
    @IBOutlet weak var headerView : UIView!
    
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        
        let usernameLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15) )
        let passwordLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15) )
        
        txt_Username.leftViewMode = .always
        txt_Username.leftView = usernameLeftView
        
        txt_Pasword.leftViewMode = .always
        txt_Pasword.leftView = passwordLeftView
        
        UtilityClass.shared.addBorderToTextfield(border: 0.5, textfield: txt_Username, color: UIColor.lightGray.cgColor)
        UtilityClass.shared.addBorderToTextfield(border: 0.5, textfield: txt_Pasword, color: UIColor.lightGray.cgColor)
        
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 10, textfield: txt_Username)
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 10, textfield: txt_Pasword)
        UtilityClass.shared.addCornerRadiusToButton(radius: 10, button: btn_Login)
        
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    //MARK :- TEXTFIELD DELEGATE METHODS
    func textFieldDidBeginEditing(_ textField: UITextField) {
        if(textField == txt_Username)
        {
            txt_Username.becomeFirstResponder()
            txt_Username.keyboardType = UIKeyboardType.emailAddress
            txt_Username.returnKeyType = UIReturnKeyType.next
        }
        else
        {
            txt_Pasword.becomeFirstResponder()
            txt_Pasword.returnKeyType = UIReturnKeyType.done
        }
    }
    func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        if(textField == txt_Username)
        {
            txt_Pasword.becomeFirstResponder()
        }
        else
        {
            txt_Pasword.resignFirstResponder()
        }
        return true
    }
    //MARK :- IBACTIONS
    @IBAction func loginButton(_ sender : UIButton)
    {
        if(txt_Username.text == "")
        {
            UtilityClass.shared.alertMessage(message: "Username is required.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
        else if(txt_Pasword.text == "")
        {
            UtilityClass.shared.alertMessage(message: "Password is required.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
        else
        {
            self.loginApi()
        }

    }
    @IBAction func forgotPasswordButton(_ sender : UIButton)
    {
        
    }
    
    //MARK :- SERVER CALLS
    //MARK :- SERVER CALLS
    func loginApi()
    {
        //SVProgressHUD.show()
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "login"
            //let userID = defaults.value(forKey: "userID") as! String
            
            let param : Parameters = [
                "email" : txt_Username.text!,
                "password" : txt_Pasword.text!
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
                            let userID = result.value(forKey: "id") as! Int
                            let userType = result.value(forKey: "user_type") as! String
                            let email = result.value(forKey: "email") as! String
                            let superVisorID = result.value(forKey: "supervisor_id") as! Int
                            self.defaults.set(userType, forKey: "usertype")
                            self.defaults.set(userID, forKey: "userid")
                            self.defaults.set("1", forKey: "islogin")
                            self.defaults.set(email, forKey: "email")
                            self.defaults.set(superVisorID, forKey: "supervisorid")
                            
                            let storyboard = UIStoryboard(name: "Main", bundle: nil)
                            let myController = storyboard.instantiateViewController(withIdentifier: "MainNavigation") as! UINavigationController
                            let appDelegate = UIApplication.shared.delegate as! AppDelegate
                            appDelegate.window?.rootViewController = myController
                            appDelegate.window?.makeKeyAndVisible()
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
            //self.view.isUserInteractionEnabled = true
            UtilityClass.shared.alertMessage(message: "No Internet Connection", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
    }
    
    //MARK :- OTHER FUNCTIONS

}// CLASS ENDS HERE......

