 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class ChatModel extends CI_Model {
   	public function __construct()
        {
                parent::__construct();
                 // Your own constructor code
                 $this->load->database();
         } 
 	private $Table = 'chat';
	
 
	public function SendTxtMessage($data){
  		$res = $this->db->insert($this->Table, $data ); 
 		if($res == 1)
 			return true;
 		else
 			return false;
	}
	public function GetReciverChatHistory($receiver_id){
		
		$receiver_id = trim($receiver_id, ",");
		$sender_id=$this->session->user_id;
		

		$condition  = "`sender_id`= '$sender_id' AND `receiver_id` = '$receiver_id' OR (`sender_id`= '$receiver_id' AND `receiver_id` = '$sender_id')";
		
		$this->db->select('*');
		$this->db->from($this->Table);
		$this->db->where($condition);
		//$this->db->or_where_in("sender_id", $usrarr);
		//$this->db->or_where_in("receiver_id", $usrarr);
		
   		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
	}
	
	
	
 	public function GetReciverMessageList($receiver_id){
  		
		$this->db->select('*');
		$this->db->from($this->Table);
		$this->db->where('receiver_id',$receiver_id);
   		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
		 
	}
	public function TrashById($receiver_id)
	{  
 		$res = $this->db->delete($this->Table, ['receiver_id' => $receiver_id] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}	
 }