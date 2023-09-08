<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message_models extends CI_Model {

 public function smssend($phone,$message){
     $search = array(
		'/\n/',			// replace end of line by a space
		'/\>[^\S ]+/s',		// strip whitespaces after tags, except space
		'/[^\S ]+\</s',		// strip whitespaces before tags, except space
	 	'/(\s)+/s'		// shorten multiple whitespace sequences
	  );
 
	 $replace = array(
		' ',
		'>',
	 	'<',
	 	'\\1'
	  );
 
	$meg = preg_replace($search, $replace, $message);
 $url="https://api.msg91.com/api/sendhttp.php?mobiles=".$phone."&authkey=308172AuZ3VC9dU5df325a4&route=1&sender=611332&message=".$meg."&country=91";
 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));



      $response = curl_exec($curl);
       $err = curl_error($curl);
      curl_close($curl);

      if ($err) {

      } else {
         $response;
      }
                $insert_array = array(
                                  'mobile_no'     => $phone,
                                  'created_by'    =>  $this->session->user_id,
                                  'msg'           => $message,
                                  'response'      => $response
                              );
          $this->db->insert('sms_send_log',$insert_array);
      
    }
 
        public function total_whatsaap(){
             return $this->db->query('select count(response) as totsl from whatsapp_send_log')->num_rows();
        }
        public function today_whatsapp(){
           $date= date('Y-m-d');
             return $this->db->query('select count(response) as totsl from whatsapp_send_log where created_at like '.$date)->num_rows();
        }
        
         public function total_msg(){
             return $this->db->query('select count(response) as totsl from sms_send_log')->num_rows();
        }
        public function today_tody_msg(){
           $date= date('Y-m-d');
             return $this->db->query('select count(response) as totsl from sms_send_log where created_at like '.$date)->num_rows();
        }
 
     public function sendwhatsapp($number,$message){
           $my_apikey = "CW9FFHPDJGC5RXUWSIC6";
           $destination =$number;
          // $message = "MESSAGE TO SEND";
           $api_url = "https://panel.apiwha.com/send_message.php";
           $api_url .= "?apikey=". urlencode ($my_apikey);
           $api_url .= "&number=". urlencode ($destination);
           $api_url .= "&text=". urlencode ($message);
           $curl = curl_init();
           curl_setopt_array($curl, array(
           CURLOPT_URL => "$api_url",
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => "",
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 30,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => "GET",
        ));
        
        $response = curl_exec($curl);
        
        $response = json_decode($response,true);
        
        $wp_mob_num = $number;
        if (strlen($number) == 12 && substr($number, 0, 2) == "91")
            $wp_mob_num = substr($number, 2, 10);
        
        $this->db->where('mobile_no',$wp_mob_num);
        if( $this->db->get('whatsapp_send_log')->num_rows() == 0){
          $insert_array = array(
                                  'mobile_no'     => $wp_mob_num,
                                  'status'        =>  $response['result_code'],
                                  'created_by'    =>  $this->session->user_id,
                                  'msg'           => $message,
                                  'response'      => json_encode($response)
                              );
          $this->db->insert('whatsapp_send_log',$insert_array);

        }
        
        $err = curl_error($curl);
        
        curl_close($curl);
    }

public function get_chat($number){
           $my_apikey = "CW9FFHPDJGC5RXUWSIC6";
           $destination =$number;
          // $message = "MESSAGE TO SEND";
           $api_url = "http://panel.apiwha.com/get_messages.php";
           $api_url .= "?apikey=". urlencode ($my_apikey);
           $api_url .= "&number=". urlencode ($destination);
          /// $api_url .= "&text=". urlencode ($message);
           $curl = curl_init();
           curl_setopt_array($curl, array(
           CURLOPT_URL => "$api_url",
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => "",
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 30,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => "GET",
        ));
        
        return $response = curl_exec($curl);
        
       }
		
}