//
//  ReportListViewController.swift
//  SecurityApp
//
//  Created by apple on 08/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import SVProgressHUD
import Alamofire
import SDWebImage
import AVFoundation
import AudioToolbox.AudioServices
import Photos


class ReportCell : UITableViewCell
{
    @IBOutlet var cellView : UIView!
    @IBOutlet var lbl_Title : UILabel!
    @IBOutlet var lbl_Date : UILabel!
    @IBOutlet var lbl_Description : UILabel!
    override func awakeFromNib() {
        UtilityClass.shared.addCornerRadiusToView(radius: 5, view: cellView)
    }
}

class ReportListViewController: UIViewController, UITableViewDelegate, UITableViewDataSource {

    //MARK :- IBOUTLETS
    @IBOutlet var headerView : UIView!
    @IBOutlet var reportsTableView : UITableView!
    
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    var reportsArray = NSMutableArray()
    var tableViewHasData : Bool = false
    override func viewDidLoad() {
        super.viewDidLoad()

        reportsTableView.tableFooterView = UIView()
        reportsTableView.separatorColor = UIColor.clear
        reportsTableView.separatorStyle = .none
        
        self.headerView.shadowView()
        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    override func viewWillAppear(_ animated: Bool) {
        self.getReports()
    }
    //MARK :- TABLEVIEW DELEGATE AND DATASOURCE METHODS
    func numberOfSections(in tableView: UITableView) -> Int {
        var numOfSections: Int = 0
        if(tableViewHasData)
        {
            numOfSections = 1
            reportsTableView.backgroundView = nil
        }
        else
        {
            let noDataLabel: UILabel  = UILabel(frame: CGRect(x: 0, y: 0, width: reportsTableView.bounds.size.width, height: reportsTableView.bounds.size.height))
            noDataLabel.text         = "No data to display."
            noDataLabel.textColor    = UIColor.darkGray
            noDataLabel.textAlignment = .center
            reportsTableView.backgroundView  = noDataLabel
            reportsTableView.separatorStyle  = .none
        }
        return numOfSections
    }
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return reportsArray.count
    }
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "reportCell", for: indexPath) as! ReportCell
        cell.lbl_Title.text = (reportsArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "report_title") as? String
        cell.lbl_Description.text = (reportsArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "report_description") as? String
        let date = (reportsArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "datetime") as? String
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
        return cell
    }
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        return 120
    }
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let myController = self.storyboard?.instantiateViewController(withIdentifier: "ReportDetailsViewController") as! ReportDetailsViewController
        let reportid = (reportsArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "id") as! Int
        myController.reportID = "\(reportid)"
        self.navigationController?.pushViewController(myController, animated: true)
    }
    //MARK :- IBACTIONS
    @IBAction func backButton(_ sender : UIButton)
    {
        self.navigationController?.popViewController(animated: true)
    }
    //MARK :- SERVER CALLS
    func getReports()
    {
        //SVProgressHUD.show()
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "ReportsList"
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
                        self.reportsArray = (response.value(forKey: "reports") as! NSArray).mutableCopy() as! NSMutableArray
                        DispatchQueue.main.async {
                            SVProgressHUD.dismiss()
                            self.view.isUserInteractionEnabled = true
                            self.tableViewHasData = true
                            self.reportsTableView.reloadData()
                        }
                    }
                        
                    else
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        self.tableViewHasData = false
                        self.reportsTableView.reloadData()
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
                        self.reportsTableView.reloadData()
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
            self.reportsTableView.reloadData()
            UtilityClass.shared.alertMessage(message: "No Internet Connection", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
    }
    //MARK :- OTHER FUNCTIONS

  

}//CLASS ENDS HERE.....
