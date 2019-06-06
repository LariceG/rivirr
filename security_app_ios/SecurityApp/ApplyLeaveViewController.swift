//
//  ApplyLeaveViewController.swift
//  SecurityApp
//
//  Created by apple on 08/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import SVProgressHUD
import Alamofire
import SDWebImage

class ApplyLeaveViewController: UIViewController, UITextViewDelegate {

    //MARK :- IBOUTLETS
    @IBOutlet var headerView : UIView!
    @IBOutlet var txt_Message : UITextView!
    @IBOutlet var txt_StartDate : UITextField!
    @IBOutlet var txt_EndDate : UITextField!
    @IBOutlet var btn_Apply : UIButton!
    @IBOutlet var startDatePicker : UIDatePicker!
    @IBOutlet var datePickerView : UIView!
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    var textFieldSelection = String()
    override func viewDidLoad() {
        super.viewDidLoad()

        
        let usernameLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15))
        let passwordLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15))
        
        txt_StartDate.leftViewMode = .always
        txt_StartDate.leftView = usernameLeftView
        
        txt_EndDate.leftViewMode = .always
        txt_EndDate.leftView = passwordLeftView
        
        headerView.shadowView()
        
        UtilityClass.shared.addBorderToTextfield(border: 0.5, textfield: txt_StartDate, color: UIColor.lightGray.cgColor)
        UtilityClass.shared.addBorderToTextfield(border: 0.5, textfield: txt_EndDate, color: UIColor.lightGray.cgColor)
        txt_Message.layer.borderColor = UIColor.lightGray.cgColor
        txt_Message.layer.borderWidth = 0.5
        txt_Message.layer.masksToBounds = true
        
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 5, textfield: txt_StartDate)
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 5, textfield: txt_EndDate)
        txt_Message.layer.cornerRadius = 5
        
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_Apply)
        
        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    //MARK :- TEXTFIELD AND TEXTVIEW DELEGATE METHODS
    func textViewDidBeginEditing(_ textView: UITextView) {
        txt_Message.becomeFirstResponder()
        txt_Message.returnKeyType = UIReturnKeyType.done
    }
    func textViewDidEndEditing(_ textView: UITextView) {
        txt_Message.resignFirstResponder()
    }
    //MARK :- IBACTIONS
    @IBAction func previousLeavesButton(_ sender : UIButton)
    {
        let myController = self.storyboard?.instantiateViewController(withIdentifier: "PreviousLeavesViewController") as! PreviousLeavesViewController
        self.navigationController?.pushViewController(myController, animated: true)
    }
    @IBAction func backButton(_ sender : UIButton)
    {
        self.navigationController?.popViewController(animated: true)
    }
    @IBAction func applyButton(_ sender : UIButton)
    {
        if(txt_StartDate.text == "")
        {
            UtilityClass.shared.alertMessage(message: "Please select start date.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
        else if(txt_EndDate.text == "")
        {
            UtilityClass.shared.alertMessage(message: "Please select end date.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
        else if(txt_Message.text == "")
        {
            UtilityClass.shared.alertMessage(message: "Please enter reason for your leave request.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
        else
        {
            self.applyForLeave()
        }
    }
    @IBAction func startDatePickerButton(_ sender : UIButton)
    {
        self.textFieldSelection = "1"
        self.startDatePicker.isHidden = false
        self.datePickerView.isHidden = false
       // let alertController = UIAlertController.init(title: UtilityClass.Constants.APP_NAME, message: "Select date", preferredStyle: .actionSheet)
      
    }
    @IBAction func endDatePickerButton(_ sender : UIButton)
    {
        self.textFieldSelection = "2"
        self.startDatePicker.isHidden = false
        self.datePickerView.isHidden = false
    }
    @IBAction func doneButton(_ sender : UIButton)
    {
        let formatter = DateFormatter()
        formatter.dateFormat = "dd/MM/yyyy"
        if(textFieldSelection == "1")
        {
            txt_StartDate.text = formatter.string(from: startDatePicker.date)
        }
        else
        {
            txt_EndDate.text = formatter.string(from: startDatePicker.date)
        }
        
        startDatePicker.isHidden = true
        self.datePickerView.isHidden = true
    }
    @IBAction func cancelButton(_ sender : UIButton)
    {
        startDatePicker.isHidden = true
        self.datePickerView.isHidden = true
    }
    //MARK :- SERVER CALLS
    func applyForLeave()
    {
        //SVProgressHUD.show() userId,,to,message

        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "leaveRequest"
            let userID = defaults.value(forKey: "userid") as! Int
            let str = String(userID)
            print(str)
            let param : Parameters = [
                "userId" : str,
                "from" : txt_StartDate.text!,
                "to" : txt_EndDate.text!,
                "message" : txt_Message.text!
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
                        //self.reportsArray = (response.value(forKey: "reports") as! NSArray).mutableCopy() as! NSMutableArray
                        DispatchQueue.main.async {
                            SVProgressHUD.dismiss()
                            self.view.isUserInteractionEnabled = true
                            self.txt_Message.text = ""
                            self.txt_EndDate.text = ""
                            self.txt_StartDate.text = ""
                            UtilityClass.shared.alertMessage(message: response.value(forKey: "message") as! String, title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                            
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
    //MARK :- OTHER FUNCTIONS
  
    


    



}// CLASS ENDS HERE.....
