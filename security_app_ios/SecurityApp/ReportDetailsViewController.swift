//
//  ReportDetailsViewController.swift
//  SecurityApp
//
//  Created by apple on 14/05/19.
//  Copyright © 2019 apple. All rights reserved.
//

import UIKit
import SVProgressHUD
import Alamofire
import SDWebImage
import AVFoundation
import AudioToolbox.AudioServices
import Photos

class ReportDetail : UICollectionViewCell
{
    @IBOutlet var myImageView : UIImageView!
    override func awakeFromNib() {
        myImageView.layer.cornerRadius = 5
        myImageView.layer.masksToBounds = true
    }
}

class ReportDetailsViewController: UIViewController, UICollectionViewDelegate, UICollectionViewDataSource, UICollectionViewDelegateFlowLayout {

    //MARK :- IBOUTLETS
    @IBOutlet var customView : UIView!
    @IBOutlet var lbl_title : UILabel!
    @IBOutlet var lbl_Description : UILabel!
    @IBOutlet var lbl_Date : UILabel!
    @IBOutlet var headerView : UIView!
    @IBOutlet var imageCollectionView : UICollectionView!
    @IBOutlet var viewTitle : UILabel!
    @IBOutlet weak var viewHeight: NSLayoutConstraint!
    
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    var reportDetails = NSDictionary()
    var tableViewHasData : Bool = false
    var reportID = String()
    var imagesArray = NSMutableArray()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        headerView.shadowView()
        UtilityClass.shared.addCornerRadiusToView(radius: 5, view: customView)
        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    override func viewWillAppear(_ animated: Bool) {
        self.getReportDetails()
    }
    //MARK :- IBOUTLETS
    @IBAction func backButton(_ sender : UIButton)
    {
        self.navigationController?.popViewController(animated: true)
    }
    //MARK :- COLLECTIONVIEW DELEGATE AND DATASOURCE METHDODS
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize
    {
        let cellWidth = imageCollectionView.frame.width / 3
        return CGSize(width: cellWidth, height: cellWidth)
    }
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, minimumLineSpacingForSectionAt section: Int) -> CGFloat
    {
        return 20
    }

    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, insetForSectionAt section: Int) -> UIEdgeInsets
    {
        let sectionInset = UIEdgeInsets(top: 10, left: 10, bottom: 10, right: 10)
        return sectionInset
    }
    func numberOfSections(in collectionView: UICollectionView) -> Int {
        var numOfSections: Int = 0
        if(tableViewHasData)
        {
            numOfSections = 1
            imageCollectionView.backgroundView = nil
        }
        else
        {
            let noDataLabel: UILabel  = UILabel(frame: CGRect(x: 0, y: 0, width: imageCollectionView.bounds.size.width, height: imageCollectionView.bounds.size.height))
            noDataLabel.text         = "No data to display."
            noDataLabel.textColor    = UIColor.darkGray
            noDataLabel.textAlignment = .center
            imageCollectionView.backgroundView  = noDataLabel
            
        }
        return numOfSections
    }
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return imagesArray.count
    }
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "imageCell", for: indexPath) as! ReportDetail
        let image = (imagesArray.object(at: indexPath.row) as! NSDictionary).value(forKey: "image") as? String
        if(image == nil) || ((image?.isEmpty)!)
        {
            
        }
        else
        {
            cell.myImageView.sd_setImage(with: URL(string: image!), placeholderImage: UIImage(named: "asdas"), options: [], completed: nil)
        }
        return cell
        
    }
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
      
    }
    
    //MARK :- OTHER FUNCTIONS
    func setUpView()
    {
        self.viewTitle.text = reportDetails.value(forKey: "report_title") as? String
        self.lbl_title.text = reportDetails.value(forKey: "report_title") as? String
        self.lbl_Description.text = reportDetails.value(forKey: "report_description") as? String
        let date = reportDetails.value(forKey: "datetime") as? String
        let dateFormatterGet = DateFormatter()
        dateFormatterGet.dateFormat = "yyyy-MM-dd HH:mm:ss"
        
        let dateFormatterPrint = DateFormatter()
        dateFormatterPrint.dateFormat = "MMM d, yyyy"
        
        if let date = dateFormatterGet.date(from: date!) {
            print(dateFormatterPrint.string(from: date))
            self.lbl_Date.text = dateFormatterPrint.string(from: date)
        } else {
            print("There was an error decoding the string")
        }
        
        let font = UIFont(name: "NunitoSans-Light", size: 12.0)
        let height = UtilityClass.shared.heightForView(text: lbl_Description.text!, font: font!, width: 335)
        
        print(height)
        if(height > self.viewHeight.constant)
        {
            self.viewHeight.constant = height + customView.frame.height
        }
        else
        {
            
        }
        

    }
    //MARK :- SERVER CALLS
    func getReportDetails()
    {
        //SVProgressHUD.show()
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            let URL = UtilityClass.Constants.BASE_URL + "singleReportDetails"
            //let userID = defaults.value(forKey: "userid") as! Int
            
            let param : Parameters = [
            "reportId" : reportID
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
                        self.reportDetails = response.value(forKey: "report_details")  as! NSDictionary
                        self.imagesArray = (self.reportDetails.value(forKey: "images") as! NSArray).mutableCopy() as! NSMutableArray
                        print(self.imagesArray)
                        DispatchQueue.main.async {
                            self.setUpView()
                            self.view.isUserInteractionEnabled = true
                            self.tableViewHasData = true
                            SVProgressHUD.dismiss()
                            self.imageCollectionView.reloadData()
                            
                        }
                    }
                        
                    else
                    {
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        self.tableViewHasData = false
                        self.imageCollectionView.reloadData()
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
                        self.imageCollectionView.reloadData()
                        UtilityClass.shared.alertMessage(message: response.value(forKey: "message") as! String, title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                    }
                    else
                    {
                        SVProgressHUD.dismiss()
                        self.tableViewHasData = false
                        self.imageCollectionView.reloadData()
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
            self.imageCollectionView.reloadData()
            UtilityClass.shared.alertMessage(message: "No Internet Connection", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
    }
    

 
}// CLASS ENDS HERE......
