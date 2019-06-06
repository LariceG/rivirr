//
//  ForgotPasswordViewController.swift
//  SecurityApp
//
//  Created by apple on 15/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import SVProgressHUD
import Alamofire
import SDWebImage
import AVFoundation
import AudioToolbox.AudioServices
import Photos

class ForgotPasswordViewController: UIViewController, UITextFieldDelegate {

    //MARK :- IBOUTLETS
    @IBOutlet var headerView : UIView!
    @IBOutlet var txt_Email : UITextField!
    @IBOutlet var btn_Submit : UIButton!
    
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    
    override func viewDidLoad() {
        super.viewDidLoad()
        headerView.shadowView()
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_Submit)
        UtilityClass.shared.addBorderToTextfield(border: 0.5, textfield: txt_Email, color: UIColor.lightGray.cgColor)
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 5, textfield: txt_Email)
        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    //MARK :- TEXTFIELD DELEGATE AND DATASOURCE METHODS
    func textFieldDidBeginEditing(_ textField: UITextField) {
        if(textField == txt_Email)
        {
            txt_Email.becomeFirstResponder()
            txt_Email.returnKeyType = UIReturnKeyType.done
            txt_Email.keyboardType = UIKeyboardType.emailAddress
        }
    }
    func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        if(textField == txt_Email)
        {
            txt_Email.resignFirstResponder()
        }
        return true
    }
    //MARK :- IBACTIONS
    @IBAction func submitButton(_ sender : UIButton)
    {
        
    }
    //MARK :- SERVER CALLS


}// CLASS ENDS HERE.......
