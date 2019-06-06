//
//  UtilityClass.swift
//  PPS
//
//  Created by MAC on 03/12/18.
//  Copyright © 2018 MAC. All rights reserved.
//

import Foundation
import UIKit
import Alamofire

class UtilityClass
{
    static let shared = UtilityClass()
    
    
    struct Constants {
        
        static let APP_NAME = "SecurityApp"
        static let BASE_URL = "http://3.17.239.65/security_app/public/api/"
        static let APP_UI_COlOR = UIColor(red: 197/255.0, green: 197/255.0, blue: 197/255.0, alpha: 1)
    }
    
    
    func open(scheme: String) {
        if let url = URL(string: scheme) {
            if #available(iOS 10, *) {
                UIApplication.shared.open(url, options: [:],
                                          completionHandler: {
                                            (success) in
                                            print("Open \(scheme): \(success)")
                })
            } else {
                let success = UIApplication.shared.openURL(url)
                print("Open \(scheme): \(success)")
            }
        }
    }
    func heightForView(text:String, font:UIFont, width:CGFloat) -> CGFloat{
        let label : UILabel = UILabel(frame: CGRect(x: 0, y: 0, width: width, height: CGFloat.greatestFiniteMagnitude)) //CGRectMake(0, 0, width, CGFloat.greatestFiniteMagnitude))
        label.numberOfLines = 0
        label.lineBreakMode = NSLineBreakMode.byWordWrapping
        label.font = font
        label.text = text
        
        label.sizeToFit()
        return label.frame.height
    }
    func addCornerRadiusToTextfield(radius : CGFloat, textfield : UITextField)
    {
        textfield.layer.cornerRadius = radius
        textfield.layer.masksToBounds = true
    }
    func addCornerRadiusToView(radius : CGFloat, view : UIView)
    {
        view.layer.cornerRadius = radius
        view.layer.masksToBounds = true
    }
    func addCornerRadiusToButton(radius : CGFloat, button : UIButton)
    {
        button.layer.cornerRadius = radius
        button.layer.masksToBounds = true
    }
    func addBorderToTextfield(border : CGFloat, textfield : UITextField , color : CGColor)
    {
        textfield.layer.borderWidth = border
        textfield.layer.borderColor = color
    }
    func alertMessage(message : String , title : String, viewcontrolller : UIViewController)
    {
        let alertController = UIAlertController.init(title: title, message: message, preferredStyle: .alert)
        let alertAction = UIAlertAction.init(title: "OK", style: .default, handler: nil)
        alertController.addAction(alertAction)
        viewcontrolller.present(alertController, animated: true, completion: nil)
    }
    func isValidEmail(testStr:String) -> Bool
    {
        print("validate emilId: \(testStr)")
        let emailRegEx = "[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}"
        let emailTest = NSPredicate(format:"SELF MATCHES %@", emailRegEx)
        let result = emailTest.evaluate(with: testStr)
        return result
        
    }
    func isConnectedToInternet() -> Bool
    {
        return NetworkReachabilityManager()!.isReachable
    }
   
}
