<?php
class Data_login extends CI_Model {
    
 function email_check_withself($email) {

     $query = $this->db->query("SELECT id FROM accounts WHERE (email='$email')");
     $row = $query->row();

  if ($row) {return FALSE;} else {return TRUE;}
 }
 
 function vaild_login($login,$pass) {

        $pass = MD5($pass);
        
        $query = $this->db->query("
         SELECT 
          id
         FROM accounts WHERE 
          (email='$login')AND
          (pass='$pass')
         ;");
        
        
        if ($query->num_rows()>0)  { 
            
            $row = $query->row();       
            return $row->id; 
    
        } else { return FALSE; }  

 }
 
 function addtocookie($newdata) {

  $this->load->library('session');

  $this->session->set_userdata($newdata);
  
 } 
    
    
}
?>