//
//  ChatViewController.swift
//  SecurityApp
//
//  Created by apple on 23/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import Alamofire
import SDWebImage
import SVProgressHUD
import IQKeyboardManagerSwift

class RecieverCell : UITableViewCell
{
    @IBOutlet var lbl_Message : UILabel!
    @IBOutlet var lbl_Date : UILabel!
    @IBOutlet var messageView : UIView!
    @IBOutlet var recieverImage : UIImageView!
    @IBOutlet weak var recieverWidth: NSLayoutConstraint!
    override func awakeFromNib() {
        UtilityClass.shared.addCornerRadiusToView(radius: 5, view: messageView)
        self.recieverImage.layer.cornerRadius = self.recieverImage.frame.size.width / 2;
        self.recieverImage.clipsToBounds = true;
    }
}
class SenderCell : UITableViewCell
{
    @IBOutlet weak var senderWidth: NSLayoutConstraint!
    @IBOutlet var lbl_Message : UILabel!
    @IBOutlet var lbl_Date : UILabel!
    @IBOutlet var messageView : UIView!
    @IBOutlet var senderImage : UIImageView!
    override func awakeFromNib() {
        UtilityClass.shared.addCornerRadiusToView(radius: 5, view: messageView)
        self.senderImage.layer.cornerRadius = self.senderImage.frame.size.width / 2;
        self.senderImage.clipsToBounds = true;
    }
}

class ChatViewController: UIViewController, UITableViewDelegate, UITableViewDataSource, UITextFieldDelegate {

    //MARK :- IBOUTLETS
    //@IBOutlet weak var tableViewBottom: NSLayoutConstraint!
    @IBOutlet weak var messageViewBottom: NSLayoutConstraint!
    @IBOutlet var headerView : UIView!
    @IBOutlet var chatTableView : UITableView!
    @IBOutlet var superVisorImage : UIImageView!
    @IBOutlet var superVisorName : UILabel!
    @IBOutlet var superVisorLabel : UILabel!
    @IBOutlet var sendMessageView : UIView!
    @IBOutlet var txt_Message : UITextField!
    @IBOutlet weak var tableViewBottom: NSLayoutConstraint!
//    @IBOutlet weak var recieverWidth: NSLayoutConstraint!
//    @IBOutlet weak var senderwidth: NSLayoutConstraint!
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    var chatArray = NSMutableArray()
    override func viewDidLoad() {
        super.viewDidLoad()

        IQKeyboardManager.shared.enableAutoToolbar = false
        IQKeyboardManager.shared.enable = false
        let passwordLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15) )
        
        txt_Message.leftViewMode = .always
        txt_Message.leftView = passwordLeftView
        
        superVisorLabel.layer.cornerRadius = 5
        superVisorLabel.layer.masksToBounds = true
        
        self.superVisorImage.layer.cornerRadius = self.superVisorImage.frame.size.width / 2;
        self.superVisorImage.clipsToBounds = true;
        
        chatTableView.tableFooterView = UIView()
        chatTableView.separatorColor = UIColor.clear
        chatTableView.separatorStyle = .none
        chatTableView.estimatedRowHeight = 60.0
        chatTableView.rowHeight = UITableView.automaticDimension
        sendMessageView.shadowView()
        NotificationCenter.default.addObserver(self, selector: #selector(self.keyboardWillShow), name: UIResponder.keyboardWillShowNotification, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(self.keyboardWillHide), name: UIResponder.keyboardWillHideNotification, object: nil)

        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    override func viewWillAppear(_ animated: Bool) {
        self.getChat()
//        let indexPath = NSIndexPath(item: self.chatArray.count - 1, section: 0)
//        chatTableView.scrollToRow(at: indexPath as IndexPath, at: UITableView.ScrollPosition.bottom, animated: true)
    }
    override func viewWillDisappear(_ animated: Bool) {
        IQKeyboardManager.shared.enableAutoToolbar = true
        IQKeyboardManager.shared.enable = true
    }
    //MARK :- TEXTFIELD DELEGATE METHODS
    func textFieldDidBeginEditing(_ textField: UITextField) {
        if(textField == txt_Message)
        {
            txt_Message.becomeFirstResponder()
        }
    }
    func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        if(textField == txt_Message)
        {
            txt_Message.resignFirstResponder()
        }
        return true
    }
    //MARK :- IBACTIONS
    @IBAction func backButton(_ sender : UIButton)
    {
        self.navigationController?.popViewController(animated: true)
    }
    @IBAction func attachmentButton(_ sender : UIButton)
    {
        
    }
    @IBAction func sendButton(_ sender : UIButton)
    {
        if(txt_Message.text == "")
        {
            
        }
        else
        {
            self.sendMessage(msg: txt_Message.text!)
        }
    }
    //MARK :- TABLEVIEW DELEGATE AND DATASOURCE METHODS
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return self.chatArray.count
    }
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell
    {
        let recieverID = (self.chatArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "receiver_id") as! Int
        let userID = defaults.value(forKey: "userid") as! Int
        if(recieverID == userID)
        {
            let cell = tableView.dequeueReusableCell(withIdentifier: "recieverCell", for: indexPath) as! RecieverCell
            cell.lbl_Message.text = (self.chatArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "message") as? String
            cell.lbl_Date.text = (self.chatArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "time") as? String
            cell.lbl_Message.sizeToFit()
            cell.lbl_Message.numberOfLines = 0
            cell.lbl_Message.lineBreakMode = .byWordWrapping
            let font = UIFont(name: "NunitoSans-Regular", size: 12.0)
            let sizeOfText = cell.lbl_Message.text?.sizeOfString(usingFont: font!)
            print(sizeOfText?.width as Any)
            let width = Int((sizeOfText?.width)!)
            
            if(width > 100)
            {
                let screenwidth = Int(self.view.frame.width)
                if(width > (screenwidth - 60))
                {
                    cell.recieverWidth.constant = CGFloat(screenwidth - 60)
                }
                else
                {
                    cell.recieverWidth.constant = CGFloat(width)
                }
                
            }
            else
            {
                cell.recieverWidth.constant = 100
            }
            let image = (self.chatArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "user_image") as? String
            if(image == nil) || ((image?.isEmpty)!)
            {
                
            }
            else
            {
                cell.recieverImage.sd_setImage(with: URL(string: image!), placeholderImage: UIImage(named: "userDummy"), options: [], completed: nil)
            }
            return cell
        }
        else
        {
            let cell = tableView.dequeueReusableCell(withIdentifier: "senderCell", for: indexPath) as! SenderCell
            cell.lbl_Message.text = (self.chatArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "message") as? String
            cell.lbl_Message.sizeToFit()
            cell.lbl_Message.numberOfLines = 0
            cell.lbl_Message.lineBreakMode = .byWordWrapping
            let font = UIFont(name: "NunitoSans-Regular", size: 12.0)
            let sizeOfText = cell.lbl_Message.text?.sizeOfString(usingFont: font!)
            print(sizeOfText?.width as Any)
            let width = Int((sizeOfText?.width)!)
            
            if(width > 100)
            {
                let screenwidth = Int(self.view.frame.width)
                if(width > (screenwidth - 60))
                {
                    cell.senderWidth.constant = CGFloat(screenwidth - 60)
                }
                else
                {
                    cell.senderWidth.constant = CGFloat(width)
                }
                
            }
            else
            {
                cell.senderWidth.constant = 100
            }
            cell.lbl_Date.text = (self.chatArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "time") as? String
            let image = (self.chatArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "user_image") as? String
            if(image == nil) || ((image?.isEmpty)!)
            {
                
            }
            else
            {
                cell.senderImage.sd_setImage(with: URL(string: image!), placeholderImage: UIImage(named: "userDummy"), options: [], completed: nil)
            }
            return cell
        }
    }
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat
    {
        return UITableView.automaticDimension
    }
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        tableView.deselectRow(at: indexPath, animated: false)
        //txt_Message.resignFirstResponder()
    }
    
    //MARK :- OTHER FUNCTIONS
    
    func scrollToBottomOfChat(){
        let indexPath = IndexPath(row: chatArray.count - 1, section: 0)
        chatTableView.scrollToRow(at: indexPath, at: .none, animated: false)
    }
    @objc func keyboardWillShow(notification: Notification) {
            print("notification: Keyboard will show")
            if #available(iOS 11.0, *) {
                if let keyboardSize = (notification.userInfo?[UIResponder.keyboardFrameBeginUserInfoKey] as? NSValue)?.cgRectValue {
                    
                    if(self.messageViewBottom.constant == 0)
                    {
                        self.messageViewBottom.constant = keyboardSize.height - view.safeAreaInsets.bottom
                        self.tableViewBottom.constant = keyboardSize.height - view.safeAreaInsets.bottom + 50
                        self.scrollToBottomOfChat()
//                        let height = self.chatTableView.frame.height - keyboardSize.height - view.safeAreaInsets.bottom + 50
//                        self.chatTableView.frame = CGRect(x: chatTableView.frame.origin.x, y: chatTableView.frame.origin.y, width: self.view.frame.width, height: height)
                        
                    }
                   
                }
                
            } else {
                if let keyboardSize = (notification.userInfo?[UIResponder.keyboardFrameBeginUserInfoKey] as? NSValue)?.cgRectValue {
                    if(self.messageViewBottom.constant == 0)
                    {
                        self.messageViewBottom.constant = keyboardSize.height
                        self.tableViewBottom.constant = keyboardSize.height + 50
//                        let height = self.chatTableView.frame.height - keyboardSize.height + 50
//                        self.chatTableView.frame = CGRect(x: chatTableView.frame.origin.x, y: chatTableView.frame.origin.y, width: self.view.frame.width, height: height)
                        self.scrollToBottomOfChat()
                    }
                    
                }
               
            }
            
            
           
        
        
    }
    
    @objc func keyboardWillHide(notification: Notification) {
            if #available(iOS 11.0, *)
            {
                if let keyboardSize = (notification.userInfo?[UIResponder.keyboardFrameBeginUserInfoKey] as? NSValue)?.cgRectValue
                {
                    if(self.messageViewBottom.constant != 0)
                    {
                        self.messageViewBottom.constant = 0
                        self.tableViewBottom.constant = 50
//                        let height = self.chatTableView.frame.height + keyboardSize.height + view.safeAreaInsets.bottom - 50
//                        self.chatTableView.frame = CGRect(x: chatTableView.frame.origin.x, y: chatTableView.frame.origin.y, width: self.view.frame.width, height: height)
                        self.scrollToBottomOfChat()
                    }
                    
                }
            }
            else
            {
                if let keyboardSize = (notification.userInfo?[UIResponder.keyboardFrameBeginUserInfoKey] as? NSValue)?.cgRectValue
                {
                    if(self.messageViewBottom.constant != 0)
                    {
                        self.messageViewBottom.constant = 0
                        self.tableViewBottom.constant = 50
//                        let height = self.chatTableView.frame.height + keyboardSize.height - 50
//                        self.chatTableView.frame = CGRect(x: chatTableView.frame.origin.x, y: chatTableView.frame.origin.y, width: self.view.frame.width, height: height)
                        self.scrollToBottomOfChat()
                    }
                    
                }
               
            }
        
    }
    //MARK :- SERVER CALLS
    func getChat()
    {
        //SVProgressHUD.show() userId,,to,message
        
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "ConversationList"
            let userID = defaults.value(forKey: "userid") as! Int
            let superVisorID = defaults.value(forKey: "supervisorid") as! Int
            let str1 = String(superVisorID)
            let str = String(userID)
            print(str)
            let param : Parameters = [
                "userId" : str,
                "supervisorId" : str1
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
                        self.chatArray.removeAllObjects()
                        self.chatArray = (response.value(forKey: "conversation") as! NSArray).mutableCopy() as! NSMutableArray
                        DispatchQueue.main.async {
                            SVProgressHUD.dismiss()
                            
                            self.view.isUserInteractionEnabled = true
                            self.chatTableView.reloadData()
                            self.scrollToBottomOfChat()
                        }
                    }
                        
                    else
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        //self.leavesTableView.reloadData()
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
    
    func sendMessage(msg : String)
    {
        //SVProgressHUD.show() senderId,receiverId,message
        
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "sendMessage"
            let userID = defaults.value(forKey: "userid") as! Int
            let superVisorID = defaults.value(forKey: "supervisorid") as! Int
            let str1 = String(superVisorID)
            let str = String(userID)
            print(str)
            let param : Parameters = [
                "senderId" : str,
                "receiverId" : str1,
                "message" : msg
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
                        //self.chatArray.removeAllObjects()
                        //self.chatArray = (response.value(forKey: "conversation") as! NSArray).mutableCopy() as! NSMutableArray
                        DispatchQueue.main.async {
                            SVProgressHUD.dismiss()
                            self.txt_Message.text = ""
                            self.view.isUserInteractionEnabled = true
                            self.getChat()
                        }
                    }
                        
                    else
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        //self.leavesTableView.reloadData()
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
    

}
