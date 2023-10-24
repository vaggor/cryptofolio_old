<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	public function postToCurl($url){
		$CURL = curl_init();
	    curl_setopt($CURL, CURLOPT_URL, $url); 
	    //curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
	    //curl_setopt($CURL, CURLOPT_POST, 1); 
	    //curl_setopt($CURL, CURLOPT_POSTFIELDS, $data); 
	    curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Content-type: application/json; charset=utf-8'));
	    curl_setopt($CURL, CURLOPT_HEADER, false); 
	    curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($CURL, CURLOPT_CUSTOMREQUEST, "GET"); 
	    curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
	    $resp = curl_exec($CURL); 
	    //$status_code = curl_getinfo($CURL, CURLINFO_HTTP_CODE);  
	    //print_r($resp);exit;
	    return $resp;
	}

	public function postToIAlert($url,$data){
		$CURL = curl_init();
	    curl_setopt($CURL, CURLOPT_URL, $url); 
	    //curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
	    curl_setopt($CURL, CURLOPT_POST, 1); 
	    curl_setopt($CURL, CURLOPT_POSTFIELDS, $data); 
	    curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Content-type: application/json;','Auth-Code: ED9C433A28B0B991A4BC'));
	    curl_setopt($CURL, CURLOPT_HEADER, false); 
	    curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($CURL, CURLOPT_CUSTOMREQUEST, "POST"); 
	    curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
	    $resp = curl_exec($CURL); 
	    //$status_code = curl_getinfo($CURL, CURLINFO_HTTP_CODE);  
	    //print_r($resp);exit;
	    return $resp;
	}


	public function sendMessage($trading_pair,$to,$perc_profit){
		$url = 'http://clickmegh.com/ialert/ialert/api_v1_0/send_message';
		$from = 'info@cryptoFolio.com';
		$alias = 'cryptoFolio';
		$subject = 'Congrats!!! Trade '.$trading_pair.' ended successfully';
		//$body = 'Test Script';
		$body = 'Congratulations!!! Your trade '.$trading_pair.' made a '.$perc_profit.'% profit. Regards, CryptoFolio Team.';
		$data = $this->formMessage($from,$alias,$to,$subject,$body);
		$resp = $this->postToIAlert($url,$data);
		$resp = json_decode($resp);
		return $resp;
	}

	public function sendBuyMessage($trading_pair,$to){
		$url = 'http://clickmegh.com/ialert/ialert/api_v1_0/send_message';
		$from = 'info@cryptoFolio.com';
		$alias = 'cryptoFolio';
		$subject = 'Trade Order '.$trading_pair.' Placed';
		//$body = 'Test Script';
		$body = 'Your trade order '.$trading_pair.' has been successfully placed';
		$data = $this->formMessage($from,$alias,$to,$subject,$body);
		$resp = $this->postToIAlert($url,$data);
		$resp = json_decode($resp);
		return $resp;
	}

	public function sendActivationEmail($to,$subject,$message,$hash){
		$url = 'http://clickmegh.com/ialert/ialert/api_v1_0/send_message';
		$from = 'info@cryptoFolio.com';
		$alias = 'cryptoFolio';
	
		$data = $this->formMessage($from,$alias,$to,$subject,$message);
		$resp = $this->postToIAlert($url,$data);
		$resp = json_decode($resp);
		return $resp;
	}


	public function formMessage($from,$alias,$to,$subject,$body){
		$obj = '{
					"Message": {
					"from": "'.$from.'",
					"alias": "'.$alias.'",
					"to": "'.$to.'",
					"subject": "'.$subject.'",
					"body": "'.$body.'"
					}
				}';
		return $obj;
	}


	

}
