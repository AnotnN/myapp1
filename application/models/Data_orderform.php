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
   
   
   function send_notifs_by_addorder($data) {
      
     $query = $this->db->query(""
             . "SELECT "
              . "accounts.fio as fio,"
              . "accounts.email as email,"
              . "FIND_IN_SET ('ski',accounts.equip) as ski,"
              . "FIND_IN_SET ('sb',accounts.equip) as sb"
             ." FROM accounts WHERE FIND_IN_SET ('take',accounts.givetake)$where_equip "
             . ";");
     
     
     echo "<textarea name = 'smsg' rows = '40' cols = '80'>";
     print_r($data);
     echo "</textarea >";
     die();
     
        if ($query) {

            $row = $query->result_array();
            if ($row[0]) { 
                 
                $arr = $row[0];

            }
            
        }  
       
   }
   
   

}
?>