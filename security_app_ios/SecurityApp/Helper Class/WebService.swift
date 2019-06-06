//
//  WebService.swift


//  Created by Pollysys on 18/10/16.
//  Copyright © 2016 Pollysys. All rights reserved.
//


import Foundation
import Alamofire


public class CallWebService {
    
    var dict = NSMutableDictionary()
    
    static let shared = CallWebService()
    
    func postRequestHeader(strURL: String, params: [String : Any], headers: [String : String], completion: @escaping (_ success: Bool, _ responseObject: Any) -> Void)
    {
        Alamofire.request(strURL, method: .post, parameters: params, encoding: JSONEncoding.default,  headers: headers).responseJSON { (response) in
            switch response.result
            {
                case .success:
                    if let json = response.result.value
                    {
                        completion(true, json)
                    }
                    break
                case .failure(let error):
                    print(error.localizedDescription)
                    self.dict.setValue(error.localizedDescription, forKey: "message")
                    self.dict.setValue(100, forKey: "status")
                    completion(false , self.dict)
            }
        }
    }
    func getRequestHeader(strURL: String, params: [String : Any], headers: [String : String], completion: @escaping (_ success: Bool, _ responseObject: Any) -> Void)
    {
        //encoding: JSONEncoding.default,
        Alamofire.request(strURL, method: .get, parameters: params, headers: headers).responseJSON { (response) in
            switch response.result
            {
            case .success:
                if let json = response.result.value
                {
                    completion(true, json)
                }
                break
            case .failure(let error):
                print(error.localizedDescription)
                print(error.localizedDescription)
                
                self.dict.setValue(error.localizedDescription, forKey: "message")
                self.dict.setValue(100, forKey: "status")
                completion(false , self.dict )
            }
        }
    }
    func getRequest(strURL: String, params: [String : Any], completion: @escaping (_ success: Bool, _ responseObject: Any) -> Void)
    {
        Alamofire.request(strURL, method: .get, parameters: [:], encoding: JSONEncoding.default, headers: nil).responseJSON { (response) in
            switch response.result
            {
            case .success:
                if let json = response.result.value
                {
                    completion(true, json)
                }
                break
            case .failure(let error):
                print(error.localizedDescription)
                self.dict.setValue(error.localizedDescription, forKey: "message")
                self.dict.setValue(100, forKey: "status")
                completion(false , self.dict)
            }
        }
    }
    func postRequest(strURL: String, params: [String : Any], completion: @escaping (_ success: Bool, _ responseObject: Any) -> Void)
    {
        Alamofire.request(strURL, method: .post, parameters: params, headers: nil).responseJSON { (response) in
            switch response.result
            {
            case .success:
                if let json = response.result.value
                {
                    completion(true, json)
                }
                break
            case .failure(let error):
                print(error.localizedDescription)
                self.dict.setValue(error.localizedDescription, forKey: "message")
                self.dict.setValue(100, forKey: "status")
                completion(false , self.dict)
            }
        }
    }
    func forURL(strURL: String, completion: @escaping (_ responseObject: AnyObject?, _ error: NSError?) -> (Void)) throws -> URLSessionTask?
    {
        
        let config = URLSessionConfiguration.default // Session Configuration
        let session = URLSession(configuration: config) // Load configuration into Session
        let request  = NSMutableURLRequest()
        request.url = NSURL(string: strURL)! as URL
        request.httpMethod = "GET"
        
        let task = session.dataTask(with: request as URLRequest)
        {
            (data, response, error) in
            
            if error != nil
            {
                completion(nil, error as NSError?)
                return
            }
            else
            {
                let result = NSString(data: data!, encoding: String.Encoding.utf8.rawValue)
                
                do {
                    let json = try JSONSerialization.jsonObject(with: data!, options: JSONSerialization.ReadingOptions())
                    completion(json as AnyObject?, error as NSError?)
                    
                } catch
                {
                    let nserror = error as NSError
                    completion(nil, nserror)
                }
                
            }
            
            

        }
        
        task.resume()
        return task
    }
    
}








