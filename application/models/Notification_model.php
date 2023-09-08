<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model {       

    public function add_task_reminder($uid,$enquiry_id,$date,$time,$subject){
            $uid = $uid;
            $enq_id = $enquiry_id;
            $rem_date = $date;
            $rem_time = $time;
            $reminder_txt = $subject;        
            $server_key = $this->config->item('firebase_server_key');                        
            $ch = curl_init();        
            curl_setopt($ch, CURLOPT_URL, 'https://new-crm-f6355.firebaseio.com/reminders/'.$uid.'.json');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"enq_id\": \"".$enq_id."\",\"rem_date\": \"".$rem_date."\",\"rem_time\": \"".$rem_time."\",\"reminder_txt\": \"".$reminder_txt."\",\"uid\": \"".$uid."\"}");        
            $headers = array(
                'Content-Type:application/json',
                'Authorization:key='.$server_key
            );
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            
            /*if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            print_r($result);*/

            curl_close($ch);
            return $result;

    }


    public function update_task_reminder($uid,$enquiry_id,$date,$time,$subject,$notification_id){
            //echo $notification_id.'nnn';
            $uid = $uid;
            $enq_id = $enquiry_id;
            $rem_date = $date;
            $rem_time = $time;
            $reminder_txt = $subject;        
            $server_key = $this->config->item('firebase_server_key');                        
            $ch = curl_init();        
            curl_setopt($ch, CURLOPT_URL, 'https://new-crm-f6355.firebaseio.com/reminders/'.$uid.'/'.$notification_id.'.json');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"enq_id\": \"".$enq_id."\",\"rem_date\": \"".$rem_date."\",\"rem_time\": \"".$rem_time."\",\"reminder_txt\": \"".$reminder_txt."\",\"uid\": \"".$uid."\"}");        
            $headers = array(
                'Content-Type:application/json',
                'Authorization:key='.$server_key
            );
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            
            /*if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            print_r($result);*/

            curl_close($ch);

            return $result;
    }


}