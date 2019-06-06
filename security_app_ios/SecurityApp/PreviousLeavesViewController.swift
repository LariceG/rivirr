//
//  PreviousLeavesViewController.swift
//  SecurityApp
//
//  Created by apple on 23/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import Alamofire
import SDWebImage
import SVProgressHUD

class LeaveCell : UITableViewCell
{
    @IBOutlet var backGroundView : UIView!
    @IBOutlet var lbl_Date : UILabel!
    @IBOutlet var statusView : UIView!
    @IBOutlet var statusImage : UIImageView!
    @IBOutlet var lbl_Status : UILabel!
    override func awakeFromNib() {
        UtilityClass.shared.addCornerRadiusToView(radius: 5, view: backGroundView)
        UtilityClass.shared.addCornerRadiusToView(radius: 5, view: statusView)
    }
}

class PreviousLeavesViewController: UIViewController, UITableViewDataSource, UITableViewDelegate {

    //MARK :- IBOUTLETS
    @IBOutlet var btn_Pending : UIButton!
    @IBOutlet var btn_Approved : UIButton!
    @IBOutlet var btn_Declined : UIButton!
    @IBOutlet var leavesTableView : UITableView!
    @IBOutlet var headerView : UIView!
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    var selection : String = "1"
    var leavesArray = NSArray()
    var pendingArray = NSMutableArray()
    var approvedArray = NSMutableArray()
    var declinedArray = NSMutableArray()
    var tableViewHasData : Bool = false
    override func viewDidLoad() {
        super.viewDidLoad()

        leavesTableView.tableFooterView = UIView()
        leavesTableView.separatorStyle = .none
        leavesTableView.separatorColor = UIColor.clear
        
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_Pending)
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_Approved)
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_Declined
        )
        headerView.shadowView()
        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    override func viewWillAppear(_ animated: Bool) {
        self.previousLeaves()
    }
    //MARK :- IBACTIONS
    @IBAction func backButton(_ sender : UIButton)
    {
        self.navigationController?.popViewController(animated: true)
    }
    @IBAction func pendingButton(_ sender : UIButton)
    {
        selection = "1"
        btn_Pending.backgroundColor = UIColor(red: 0/255.0, green: 132/255.0, blue: 208/255.0, alpha: 1)
        btn_Approved.backgroundColor = UIColor(red: 239/255.0, green: 239/255.0, blue: 239/255.0, alpha: 1)
        btn_Declined.backgroundColor = UIColor(red: 239/255.0, green: 239/255.0, blue: 239/255.0, alpha: 1)
        
        btn_Pending.setTitleColor(UIColor.white, for: .normal)
        btn_Approved.setTitleColor(UIColor.darkGray, for: .normal)
        btn_Declined.setTitleColor(UIColor.darkGray, for: .normal)
        self.leavesTableView.reloadData()
    }
    @IBAction func approvedButton(_ sender : UIButton)
    {
        selection = "2"
        btn_Pending.backgroundColor = UIColor(red: 239/255.0, green: 239/255.0, blue: 239/255.0, alpha: 1)
        btn_Approved.backgroundColor = UIColor(red: 0/255.0, green: 132/255.0, blue: 208/255.0, alpha: 1)
        btn_Declined.backgroundColor = UIColor(red: 239/255.0, green: 239/255.0, blue: 239/255.0, alpha: 1)
        
        btn_Pending.setTitleColor(UIColor.darkGray, for: .normal)
        btn_Approved.setTitleColor(UIColor.white, for: .normal)
        btn_Declined.setTitleColor(UIColor.darkGray, for: .normal)
        self.leavesTableView.reloadData()
    }
    @IBAction func declinedButton(_ sender : UIButton)
    {
        selection = "3"
        btn_Pending.backgroundColor = UIColor(red: 239/255.0, green: 239/255.0, blue: 239/255.0, alpha: 1)
        btn_Approved.backgroundColor = UIColor(red: 239/255.0, green: 239/255.0, blue: 239/255.0, alpha: 1)
        btn_Declined.backgroundColor = UIColor(red: 0/255.0, green: 132/255.0, blue: 208/255.0, alpha: 1)
        
        btn_Pending.setTitleColor(UIColor.darkGray, for: .normal)
        btn_Approved.setTitleColor(UIColor.darkGray, for: .normal)
        btn_Declined.setTitleColor(UIColor.white, for: .normal)
        self.leavesTableView.reloadData()
    }
    
    //MARK :- TABLEVIEW DATASOURCE AND DELEGATE METHODS
    func numberOfSections(in tableView: UITableView) -> Int {
        var numOfSections: Int = 0
        if(tableViewHasData)
        {
            numOfSections = 1
            leavesTableView.backgroundView = nil
        }
        else
        {
            let noDataLabel: UILabel  = UILabel(frame: CGRect(x: 0, y: 0, width: leavesTableView.bounds.size.width, height: leavesTableView.bounds.size.height))
            noDataLabel.text         = "No data to display."
            noDataLabel.textColor    = UIColor.darkGray
            noDataLabel.textAlignment = .center
            leavesTableView.backgroundView  = noDataLabel
            leavesTableView.separatorStyle  = .none
        }
        return numOfSections
    }
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        
        if(selection == "1")
        {
            return pendingArray.count
        }
        else if(selection == "2")
        {
            return approvedArray.count
        }
        else
        {
            return declinedArray.count
        }
    }
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        if(selection == "1")
        {
            let cell = tableView.dequeueReusableCell(withIdentifier: "leaveCell", for: indexPath) as! LeaveCell
            let date = (self.pendingArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "created_at") as? String
            let dateFormatterGet = DateFormatter()
            dateFormatterGet.dateFormat = "yyyy-MM-dd HH:mm:ss"
            
            let dateFormatterPrint = DateFormatter()
            dateFormatterPrint.dateFormat = "MMM d, yyyy"
            
            if let date = dateFormatterGet.date(from: date!) {
                print(dateFormatterPrint.string(from: date))
                cell.lbl_Date.text = dateFormatterPrint.string(from: date)
            } else {
                print("There was an error decoding the string")
            }
            cell.statusImage.image = UIImage(named: "pending32")
            cell.lbl_Status.text = "Pending"
            cell.lbl_Status.textColor = UIColor(red: 238/255.0, green: 175/255.0, blue: 63/255.0, alpha: 1)
            return cell
        }
        else if(selection == "2")
        {
            let cell = tableView.dequeueReusableCell(withIdentifier: "leaveCell", for: indexPath) as! LeaveCell
            let date = (self.approvedArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "created_at") as? String
            let dateFormatterGet = DateFormatter()
            dateFormatterGet.dateFormat = "yyyy-MM-dd HH:mm:ss"
            
            let dateFormatterPrint = DateFormatter()
            dateFormatterPrint.dateFormat = "MMM d, yyyy"
            
            if let date = dateFormatterGet.date(from: date!) {
                print(dateFormatterPrint.string(from: date))
                cell.lbl_Date.text = dateFormatterPrint.string(from: date)
            } else {
                print("There was an error decoding the string")
            }
            cell.statusImage.image = UIImage(named: "success")
            cell.lbl_Status.text = "Approved"
            cell.lbl_Status.textColor = UIColor(red: 17/255.0, green: 175/255.0, blue: 68/255.0, alpha: 1)
            return cell
        }
        else
        {
            let cell = tableView.dequeueReusableCell(withIdentifier: "leaveCell", for: indexPath) as! LeaveCell
            let date = (self.declinedArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "created_at") as? String
            let dateFormatterGet = DateFormatter()
            dateFormatterGet.dateFormat = "yyyy-MM-dd HH:mm:ss"
            
            let dateFormatterPrint = DateFormatter()
            dateFormatterPrint.dateFormat = "MMM d, yyyy"
            
            if let date = dateFormatterGet.date(from: date!) {
                print(dateFormatterPrint.string(from: date))
                cell.lbl_Date.text = dateFormatterPrint.string(from: date)
            } else {
                print("There was an error decoding the string")
            }
            cell.statusImage.image = UIImage(named: "delete32")
            cell.lbl_Status.text = "Declined"
            cell.lbl_Status.textColor = UIColor(red: 253/255.0, green: 0/255.0, blue: 5/255.0, alpha: 1)
            return cell
        }
        
        //return cell
    }
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        return 100
    }
    //MARK :- OTHER FUNCTIONS
    //MARK :- SERVER CALLS
    func previousLeaves()
    {
        //SVProgressHUD.show() userId,,to,message
        
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "LeavesList"
            let userID = defaults.value(forKey: "userid") as! Int
            let str = String(userID)
            print(str)
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
                        let resultArray = response.value(forKey: "leaves") as! NSArray
                        print(self.leavesArray)
                        self.pendingArray.removeAllObjects()
                        self.approvedArray.removeAllObjects()
                        self.declinedArray.removeAllObjects()
                        let pendingPredicate = NSPredicate(format: "status == %i", 0)
                        self.pendingArray = (resultArray.filtered(using: pendingPredicate) as NSArray).mutableCopy() as! NSMutableArray
                        let approvedPredicate = NSPredicate(format: "status == %i", 1)
                        self.approvedArray = (resultArray.filtered(using: approvedPredicate) as NSArray).mutableCopy() as! NSMutableArray
                        let declinedPredicate = NSPredicate(format: "status == %i", 2)
                        self.declinedArray = (resultArray.filtered(using: declinedPredicate) as NSArray).mutableCopy() as! NSMutableArray
                       
                        DispatchQueue.main.async {
                            SVProgressHUD.dismiss()
                            self.view.isUserInteractionEnabled = true
                            self.tableViewHasData = true
                            self.leavesTableView.reloadData()
                        }
                    }
                        
                    else
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        self.tableViewHasData = false
                        self.leavesTableView.reloadData()
                        UtilityClass.shared.alertMessage(message: response.value(forKey: "message") as! String, title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                    }
                }
                else
                {
                    if(status == 100)
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        self.tableViewHasData = false
                        self.leavesTableView.reloadData()
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
            self.tableViewHasData = false
            self.leavesTableView.reloadData()
            UtilityClass.shared.alertMessage(message: "No Internet Connection", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
    }
    
    

  

}
