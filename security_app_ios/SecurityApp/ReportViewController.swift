//
//  ReportViewController.swift
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

class AddCell : UICollectionViewCell
{
    @IBOutlet var addImageView : UIImageView!
    override func awakeFromNib() {
        
    }
}


class ImageCell : UICollectionViewCell
{
    @IBOutlet var myImageView : UIImageView!
    override func awakeFromNib() {
        
    }
}

class ReportViewController: UIViewController, UITextFieldDelegate, UITextViewDelegate, UIImagePickerControllerDelegate, UINavigationControllerDelegate, UICollectionViewDataSource, UICollectionViewDelegate, UICollectionViewDelegateFlowLayout {

    //MARK :- IBOUTLETS
    @IBOutlet var imageCollectionView : UICollectionView!
    @IBOutlet var headerView : UIView!
    @IBOutlet var btn_Submit : UIButton!
    @IBOutlet var txt_Title : UITextField!
    @IBOutlet var txt_Desc : UITextView!
    //@IBOutlet var myImageView : UIImageView!
    @IBOutlet var btn_Add : UIButton!
    @IBOutlet var uploadView : UIView!
    //MARK :- VARIABLES AND CONSTANTS
    var defaults = UserDefaults.standard
    var status = String()
    let imagePicker = UIImagePickerController()
    var myImageView = UIImageView()
    var imgArr: [UIImage?] = []
    var tableViewHasData : Bool = false
    override func viewDidLoad() {
        super.viewDidLoad()

        let usernameLeftView = UIView(frame: CGRect(x: 0, y: 0, width: 15, height: 15) )
        
        txt_Title.leftViewMode = .always
        txt_Title.leftView = usernameLeftView
        
        UtilityClass.shared.addBorderToTextfield(border: 0.5, textfield: txt_Title, color: UIColor.lightGray.cgColor)
        UtilityClass.shared.addCornerRadiusToTextfield(radius: 5, textfield: txt_Title)
        
        txt_Desc.layer.cornerRadius = 5
        txt_Desc.layer.borderWidth = 0.5
        txt_Desc.layer.masksToBounds = true
        txt_Desc.layer.borderColor = UIColor.lightGray.cgColor
        
        
        
//        UtilityClass.shared.addCornerRadiusToView(radius: 5, view: uploadView)
//        uploadView.layer.borderWidth = 0.5
//        uploadView.layer.borderColor = UIColor.lightGray.cgColor
//        uploadView.layer.masksToBounds = true
        
        UtilityClass.shared.addCornerRadiusToButton(radius: 5, button: btn_Submit)
        
        self.headerView.shadowView()
        imagePicker.delegate = self
        // Do any additional setup after loading the view.
    }
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent // .default
    }
    //MARK :- TEXTFILED DELEGATE AND TEXTVIEW DELEGATE METHODS
    func textFieldDidBeginEditing(_ textField: UITextField) {
        if(textField == txt_Title)
        {
            txt_Title.becomeFirstResponder()
            txt_Title.returnKeyType = UIReturnKeyType.next
        }
        else
        {
            
        }
    }
    func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        if(textField == txt_Title)
        {
            txt_Desc.becomeFirstResponder()
        }
        return true
    }
    func textViewDidBeginEditing(_ textView: UITextView) {
        txt_Desc.becomeFirstResponder()
        txt_Desc.returnKeyType = UIReturnKeyType.done
    }
    func textViewDidEndEditing(_ textView: UITextView) {
        txt_Desc.resignFirstResponder()
    }
    //MARK :- COLLECTIONVIEW DELEGATE AND DATASOURCE METHDODS
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize
    {
       // let cellWidth = imageCollectionView.frame.width / 3
        return CGSize(width: 70, height: 70)
    }
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, minimumLineSpacingForSectionAt section: Int) -> CGFloat
    {
        return 10
    }
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, insetForSectionAt section: Int) -> UIEdgeInsets
    {
        let sectionInset = UIEdgeInsets(top: 10, left: 10, bottom: 10, right: 10)
        return sectionInset
    }
    func numberOfSections(in collectionView: UICollectionView) -> Int {
        return 1
    }
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return imgArr.count + 1
    }
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        
        if indexPath.row == 0
        {
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "addCell", for: indexPath) as! AddCell
            return cell
        }
        else
        {
            let index = indexPath.row - 1
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "imageCell", for: indexPath) as! ImageCell
            let image = imgArr[index]
            cell.myImageView.image = image!
            return cell
        }
        
    }
   
 

    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        if(indexPath.row == 0)
        {
            let status = PHPhotoLibrary.authorizationStatus()
            switch status {
                
            case .authorized:
                self.openCamera()
            case .denied, .restricted:
                UtilityClass.shared.alertMessage(message: "Photo library usage denied!", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                
            default:
                // ask for permissions
                PHPhotoLibrary.requestAuthorization { status in
                    switch status {
                    case .authorized:
                        // as above
                        self.openCamera()
                    case .denied, .restricted:
                        // as above
                        UtilityClass.shared.alertMessage(message: "Photo library usage denied!", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                    case .notDetermined: break
                        // won't happen but still
                    }
                }
            }
        }
        else
        {
            
        }
    }
    //MARK :- IBACTIONS
    @IBAction func backButton(_ sender : UIButton)
    {
        self.navigationController?.popViewController(animated: true)
    }
    @IBAction func submitButton(_ sender : UIButton)
    {
        if(txt_Title.text == "")
        {
            UtilityClass.shared.alertMessage(message: "Report title is required.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
        else if(txt_Desc.text == "")
        {
            UtilityClass.shared.alertMessage(message: "Report description is required.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
        else if(imgArr.count <= 1)
        {
            UtilityClass.shared.alertMessage(message: "Please select atleast 1 image.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
        }
        else
        {
            self.createReport()
        }
        
    }
    @IBAction func previousReportsButton(_ sender : UIButton)
    {
        let myController = self.storyboard?.instantiateViewController(withIdentifier: "ReportListViewController") as! ReportListViewController
        self.navigationController?.pushViewController(myController, animated: true)
    }
    @IBAction func uploadButton(_ sender : UIButton)
    {
        let status = PHPhotoLibrary.authorizationStatus()
        switch status {
            
        case .authorized:
            self.openCamera()
        case .denied, .restricted:
            UtilityClass.shared.alertMessage(message: "Photo library usage denied!", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
            
        default:
            // ask for permissions
            PHPhotoLibrary.requestAuthorization { status in
                switch status {
                case .authorized:
                // as above
                    self.openCamera()
                case .denied, .restricted:
                // as above
                    UtilityClass.shared.alertMessage(message: "Photo library usage denied!", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                case .notDetermined: break
                    // won't happen but still
                }
            }
        }
    }
    //MARK :- IMAGEPICKER DELEGATE METHOD
    func imagePickerController(_ picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [UIImagePickerController.InfoKey : Any]) {
        if let pickedImage = info[UIImagePickerController.InfoKey.originalImage] as? UIImage {
            // imageViewPic.contentMode = .scaleToFill
          
                myImageView.image = pickedImage
                myImageView.contentMode = .scaleAspectFit
                imgArr.append(myImageView.image)
                imageCollectionView.reloadData()
            
        }
        picker.dismiss(animated: true, completion: nil)
    }
    //MARK :- OTHER FUNCTIONS
    func openCamera()
    {
        imagePicker.sourceType = UIImagePickerController.SourceType.photoLibrary
        imagePicker.allowsEditing = true
        self.present(imagePicker, animated: true, completion: nil)
    }
    private func setupView()
    {
       
    }
    //MARK :- SERVER CALLS
    func createReport()
    {
        //SVProgressHUD.show()
        //userId,reportTitle,reportDescription,image[] (multipart with array)
        SVProgressHUD.show(withStatus: "Loading...")
        self.view.isUserInteractionEnabled = false
        let checkInternet =  UtilityClass.shared.isConnectedToInternet()
        if(checkInternet)
        {
            //Parameter HERE
            let userID = defaults.value(forKey: "userid") as! Int
            let str = String(userID)
            let param = [
                "userId" : str,
                "reportTitle" : txt_Title.text!,
                "reportDescription" : txt_Desc.text!
              
                ]
            //Header HERE
            let headers : HTTPHeaders = [
                "Content-type": "multipart/form-data"
                
            ]
            
           // let frontImage = myImageView.image
            //let imgData = frontImage?.jpegData(compressionQuality: 0.7)
            
            //            let upcImage = upcImageView.image
            //            let imgData1 = UIImageJPEGRepresentation(upcImage!, 0.7)!
            
            Alamofire.upload(multipartFormData: { multipartFormData in
                //Parameter for Upload files
                //multipartFormData.append(imgData!, withName: "image",fileName: "swift.png" , mimeType: "image/png")
                //                multipartFormData.append(imgData1, withName: "back_image",fileName: "swift.png" , mimeType: "image/png")
                
                for (key, value) in param
                {
                    multipartFormData.append(value.data(using: String.Encoding.utf8)!, withName: key)
                }
                
                for image in self.imgArr
                {
                    if  let imageData = image?.jpegData(compressionQuality: 0.7) {
                        multipartFormData.append(imageData, withName: "image[]", fileName: "image.jpeg", mimeType: "image/jpeg")
                    }
                }
                
            }, usingThreshold:UInt64.init(),
               to: "http://3.17.239.65/security_app/public/api/genrateReport", //URL Here
                method: .post,
                headers: headers, //pass header dictionary here
                encodingCompletion: { (result) in
                    
                    switch result {
                    case .success(let upload, _, _):
                        print("the status code is :")
                        
                        upload.uploadProgress(closure: { (progress) in
                            print("Upload Progress: \(progress.fractionCompleted)")
                            
                            
                            DispatchQueue.main.async() {
                                let percentage = Float(progress.fractionCompleted) / Float(1.0)
                                let x = Int(percentage*100)
                                
                                if(x == 100){
                                    
                                }else{
                                    SVProgressHUD.showProgress(percentage, status: "Uploading (\(x)%)")
                                    
                                }
                                
                                
                                
                            }
                            
                        })
                        
                        upload.responseJSON { response in
                            SVProgressHUD.dismiss()
                            self.view.isUserInteractionEnabled = true
                            print("the resopnse code is : \(response.response?.statusCode)")
                            print("the response is : \(response)")
                            if(response.response?.statusCode == 200)
                            {
                                self.txt_Title.text = ""
                                self.txt_Desc.text = ""
                                self.imgArr.removeAll()
                                self.imageCollectionView.reloadData()
                                UtilityClass.shared.alertMessage(message: "Report created successfully.", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                            }
                            else
                            {
                                UtilityClass.shared.alertMessage(message: "Something went wrong please try again!", title: UtilityClass.Constants.APP_NAME, viewcontrolller: self)
                            }
                            
                        }
                        break
                    case .failure(let encodingError):
                        SVProgressHUD.dismiss()
                        self.view.isUserInteractionEnabled = true
                        print("the error is  : \(encodingError.localizedDescription)")
                        break
                    }
            })
        }
        else
        {
            SVProgressHUD.dismiss()
            self.view.isUserInteractionEnabled = true
            UtilityClass.shared.alertMessage(message: "No Internet Connection", title: "PPS", viewcontrolller: self)
        }
    }
   


}// CLASS ENDS HERE......
