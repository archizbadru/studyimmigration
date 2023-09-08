<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message_models extends CI_Model {

 public function smssend($phone,$message,$companey_id='',$user_id=''){
    /* $search = array(
    '/\n/',     // replace end of line by a space
    '/\>[^\S ]+/s',   // strip whitespaces after tags, except space
    '/[^\S ]+\</s',   // strip whitespaces before tags, except space
    '/(\s)+/s'    // shorten multiple whitespace sequences
    );
 
   $replace = array(
    ' ',
    '>',
    '<',
    '\\1'
    );*/
 
  $meg = urlencode($message);
  $companey_id = ($companey_id == '') ? $this->session->companey_id : $companey_id;
 //$url="https://api.msg91.com/api/sendhttp.php?authkey=308172AuZ3VC9dU5df325a4&route=1&sender=LALANT&mobiles=".$phone."&message=".$meg."&country=91";
 
$this->db->where('comp_id',$companey_id);
$this->db->where('api_for',2);
$api_conf  = $this->db->get('api_integration')->row_array();
// return $api_conf;
if(empty($api_conf)){
  echo "SMS API details not found";
  exit();
}

/*if (strlen($phone) >= 12 && ($this->session->companey_id==83 || $this->session->companey_id==81)) {
    $phone = substr($phone, 2, 10);
}*/


// $res =  $this->db->where(['comp_id'=>$this->session->companey_id,'type'=>$this->input->post('mesge_type')])
//         ->get("tbl_email_whatapp_sms_trans")
//         ->row();
//         if(!empty($res)){
         
          
//         }


$url=$api_conf['api_url']."&".$api_conf['key_moblie']."=".$phone."&".$api_conf['api_key']."=".$meg."&country=91";
//print_r($url);exit;
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
            'created_by'    =>  ($this->session->user_id != '') ? $this->session->user_id : $user_id,
            'msg'           => $message,
            'response'      => $response,
            'comp_id'       => $companey_id,
            'sms_email_whatapp_trans_id'=>(!empty($res)) ? $res->id : null,
            'url'           => $url
          );
          $this->db->insert('sms_send_log',$insert_array);
          //For rule execution
          if(!empty($phone)){
                  return true;
                }else{
                  return false;
          }     
    }
   public function total_whatsaap(){
      return   $this->db->select('*')
      ->from('whatsapp_send_log')
      ->get()
      ->num_rows();
   }
   public function today_whatsapp(){
      $date=date('Y-m-d');
      return   $this->db->select('*')
      ->from('whatsapp_send_log')
      ->like("created_at",$date)
      ->get()
      ->num_rows();
   }
   public function total_msg(){
       return   $this->db->select('*')
      ->from('sms_send_log')
      ->get()
      ->num_rows();
   }
   public function today_tody_msg(){
        $date=date('Y-m-d');
      return   $this->db->select('*')
      ->from('sms_send_log')
      ->like("created_at",$date)
      ->get()
      ->num_rows(); 
   }
 
     public function sendwhatsapp($number,$message,$companey_id='',$user_id=''){

      $companey_id = ($companey_id == '') ? $this->session->companey_id : $companey_id;
      $user_id = ($user_id == '') ? $this->session->user_id : $user_id;

          $this->db->select('whatsapp_api');
          $this->db->where('companey_id',$companey_id);
          $this->db->where('pk_i_admin_id',$user_id);
          $api_row  = $this->db->get('tbl_admin')->row_array();
          if(empty($api_row['whatsapp_api'])){
          $this->db->select('api_url as whatsapp_api');
          $this->db->where('comp_id',$companey_id);          
          $this->db->where('api_for',1);          
          $api_row  = $this->db->get('api_integration')->row_array();
          }

           $my_apikey = $api_row['whatsapp_api'];

           $destination =$number;
          // $api_url = "https://panel.apiwha.com/send_message.php";
           $api_url = "https://panel.capiwha.com/send_message.php";
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
        //print_r($response);
        $wp_mob_num = $number;
        if (strlen($number) == 12 && substr($number, 0, 2) == "91")
            $wp_mob_num = substr($number, 2, 10);
        
        $this->db->where('mobile_no',$wp_mob_num);
        if( $this->db->get('whatsapp_send_log')->num_rows() == 0){
          $insert_array = array(
                                  'mobile_no'     => $wp_mob_num,
                                  'status'        =>  $response['result_code'],
                                  'created_by'    =>  $user_id,
                                  'msg'           => $message,
                                  'response'      => json_encode($response)
                              );
          $this->db->insert('whatsapp_send_log',$insert_array);

        }
        
        $err = curl_error($curl);
        //echo $err;
        curl_close($curl);
//For rule execution
if(!empty($wp_mob_num)){
        return true;
      }else{
        return false;
}
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

       public function send_email($to,$subject,$message,$comp_id=0)
       {
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
          $this->db->where('comp_id',$comp_id);
          $this->db->where('status',1);
          $email_row  = $this->db->get('email_integration')->row_array();
         
          if (!empty($email_row)) 
          {            
           
            $config['protocol']     = $email_row['protocol'];
            $config['smtp_host']    = $email_row['smtp_host'];
            $config['smtp_port']    = $email_row['smtp_port'];
            $config['smtp_timeout'] = $email_row['smtp_timeout'];
            $config['smtp_user']    = $email_row['smtp_user'];
            $config['smtp_pass']    = $email_row['smtp_pass'];
            $config['charset']      = 'utf-8';
            $config['mailtype']     = 'html'; // or html
            $config['newline']      = "\r\n";
            $this->load->library('email');
            $this->email->initialize($config);          
            $this->email->from($email_row['smtp_user']);          
            $this->email->to($to);
            $this->email->subject($subject); 
            $this->email->message($message);                           
            if($this->email->send())
            {
              return true;
            }
            else
            {
              return false;
            }
           
          }
          else
          {
            return false;
          }
       }

       
    
}