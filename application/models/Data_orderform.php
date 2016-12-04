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
   
   

}
?>