 //
 //  CommonClass.swift
 //
 //
 //  Created by Pollysys on 14/06/16.
 //  Copyright © 2016 Pollysys. All rights reserved.
 //
 
 import Foundation
 import UIKit
 
 
 class SSBadgeButton: UIButton {
    
    var badgeLabel = UILabel()
    
    var badge: String? {
        didSet {
            addBadgeToButon(badge: badge)
        }
    }
    
    public var badgeBackgroundColor = UIColor.red {
        didSet {
            badgeLabel.backgroundColor = badgeBackgroundColor
        }
    }
    
    public var badgeTextColor = UIColor.white {
        didSet {
            badgeLabel.textColor = badgeTextColor
        }
    }
    
    public var badgeFont = UIFont.systemFont(ofSize: 12.0) {
        didSet {
            badgeLabel.font = badgeFont
        }
    }
    
    public var badgeEdgeInsets: UIEdgeInsets? {
        didSet {
            addBadgeToButon(badge: badge)
        }
    }
    
    override init(frame: CGRect) {
        super.init(frame: frame)
        addBadgeToButon(badge: nil)
    }
    
    func addBadgeToButon(badge: String?) {
        badgeLabel.text = badge
        badgeLabel.textColor = badgeTextColor
        badgeLabel.backgroundColor = badgeBackgroundColor
        badgeLabel.font = badgeFont
        badgeLabel.sizeToFit()
        badgeLabel.textAlignment = .center
        let badgeSize = badgeLabel.frame.size
        
        let height = max(18, Double(badgeSize.height) + 5.0)
        let width = max(height, Double(badgeSize.width) + 10.0)
        
        var vertical: Double?, horizontal: Double?
        if let badgeInset = self.badgeEdgeInsets {
            vertical = Double(badgeInset.top) - Double(badgeInset.bottom)
            horizontal = Double(badgeInset.left) - Double(badgeInset.right)
            
            let x = (Double(bounds.size.width) - 10 + horizontal!)
            let y = -(Double(badgeSize.height) / 2) - 10 + vertical!
            badgeLabel.frame = CGRect(x: x, y: y, width: width, height: height)
        } else {
            let x = self.frame.width - CGFloat((width / 2.0))
            let y = CGFloat(-(height / 2.0))
            badgeLabel.frame = CGRect(x: x, y: y, width: CGFloat(width), height: CGFloat(height))
        }
        
        badgeLabel.layer.cornerRadius = badgeLabel.frame.height/2
        badgeLabel.layer.masksToBounds = true
        addSubview(badgeLabel)
        badgeLabel.isHidden = badge != nil ? false : true
    }
    
    required init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
        self.addBadgeToButon(badge: nil)
        fatalError("init(coder:) has not been implemented")
    }
 }
 
 class appDelegate
 {
    struct common
    {
        static var Obj =  UIApplication.shared.delegate as! AppDelegate
    }
 }
 
 public class BaseUrl
 {
    enum main: String
    {
        case Url = "http://barusahib.net/"
    }
 }
 
 class userID
 {
    struct user
    {
        
        static var isLogin : Bool! = UserDefaults.standard.bool(forKey: "isLogin")
        static var isContactSend : Bool! = UserDefaults.standard.bool(forKey: "isContactSend")
        static var ID : String! = UserDefaults.standard.string(forKey: "ID")
        static var aryStoreNotif : NSMutableArray! = UserDefaults.standard.mutableArrayValue(forKey: "aryStoreNotif")
        
    }
 }
 
 
 public class showAlert
 {
    class  func myController(message:String,view:UIViewController,title:String)
    {
        let alert = UIAlertController(title: title, message:message, preferredStyle: UIAlertController.Style.alert)
        let defaultAction = UIAlertAction(title: "OK", style: .default, handler: nil)
        alert.addAction(defaultAction)
        view.present(alert, animated: true, completion: nil)
    }
    
 }
 
 public class CornerRadius
 {
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
    
 }
 public class Border
 {
    func addBorderToTextfield(border : CGFloat, textfield : UITextField , color : CGColor)
    {
        textfield.layer.borderWidth = border
        textfield.layer.borderColor = color
    }
 }
 
// class SideBar
// {
//    struct slide
//    {
//        static var controller = MMDrawerController()
//    }
// }
 
 class CheckMailValidity : UIControl
 {
    func isValidEmail(testStr:String) -> Bool
    {
        print("validate emilId: \(testStr)")
        let emailRegEx = "[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}"
        let emailTest = NSPredicate(format:"SELF MATCHES %@", emailRegEx)
        let result = emailTest.evaluate(with: testStr)
        return result
        
    }
 }

 
 import SystemConfiguration
 public class Reachability {
    
    class func isConnectedToNetwork() -> Bool {
        
        var zeroAddress = sockaddr_in()
        zeroAddress.sin_len = UInt8(MemoryLayout.size(ofValue: zeroAddress))
        zeroAddress.sin_family = sa_family_t(AF_INET)
        let defaultRouteReachability = withUnsafePointer(to: &zeroAddress) {
            $0.withMemoryRebound(to: sockaddr.self, capacity: 1) {zeroSockAddress in
                SCNetworkReachabilityCreateWithAddress(nil, zeroSockAddress)
            }
        }
        var flags = SCNetworkReachabilityFlags()
        if !SCNetworkReachabilityGetFlags(defaultRouteReachability!, &flags) {
            return false
        }
        let isReachable = (flags.rawValue & UInt32(kSCNetworkFlagsReachable)) != 0
        let needsConnection = (flags.rawValue & UInt32(kSCNetworkFlagsConnectionRequired)) != 0
        return (isReachable && !needsConnection)
        
        
    }
 }


 
 
