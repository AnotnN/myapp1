<?php
class Data_orderform extends CI_Model {

   function update_order($param,$id_order) {
       
   }
    
   function get_order($id) {
    
    $arr = array();   
       
    
    $arr = $this->Data_uni->uni_get_row_by_id("orders","id",$id);
    
     $query = $this->db->query(""
            . "SELECT "
             . "orders.*, "
             . "orders.date_time as date_time, "
             . "DATE_FORMAT(orders.date_time,'%d.%m.%Y %H:%i') as date_time_format,"
             . "resorts.title as resort_title "
            . "FROM orders,resorts WHERE "
             . "(orders.id=$id)AND"
             . "(orders.id_resort=resorts.id)"
            . ";");
     
        if ($query) {

            $row = $query->result_array();
            if ($row) $arr = $row;

            if (isset($arr[0])) { $arr= $arr[0]; }
        } 
        
        
    $arr = $this->Data_forall->adultchild_to_array($arr);
    
    
    return $arr;   
   }
   
   
   function send_notifs_by_addorder($data,$order) {
      
     $pageData['order'] = $order;  
     
     $equip = explode(",", $data['equip']); 
     
     $where_equip = "AND (";
     
     foreach ($equip as $k => $v) {
      if ($k>0) $where_equip .= " OR "; 
      $where_equip .= "FIND_IN_SET ('$v',accounts.equip)";   
     }
     
     $where_equip .= ")";
     
     
     
     $query = $this->db->query(""
             . "SELECT "
              . "accounts.fio as fio,"
              . "accounts.email as email"
             ." FROM accounts WHERE ( FIND_IN_SET ('take',accounts.givetake) )$where_equip "
             . ";");
     
     
     
        if ($query) {

            foreach ($query->result_array() as $row) {
          
              $ot_kogo = "skibase";  
              $to = $row['email'];
              $tema = $this->lang->line('neworder');
              $telo = $this->load->view('forall/order_for_show',$pageData,TRUE); 
              
              $this->Data_forall->send_pismo($ot_kogo,$to,$tema,$telo); 
                
            }
            
        }  
       
   }
   
   

}
?>