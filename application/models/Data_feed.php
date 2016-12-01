<?php
class Data_feed extends CI_Model {
    
    
 function get_orders_by_feed() {
     
  $arr = array();   
  
  $query = $this->db->query(""
            . "SELECT "
             . "orders.*, "
             . "orders.date_time as date_time, "
             . "DATE_FORMAT(orders.date_time,'%d.%m.%Y %H:%i') as date_time_format,"
             . "resorts.title as resort_title "
            . "FROM orders,resorts WHERE "
             . "(orders.id_resort=resorts.id)"
             . "AND(orders.status='vacant') "
            . "ORDER BY data_born"
            . ";");
     
    if ($query) {

     $arr = $query->result_array();  
        
    }    
     
  
  return $arr;
 }   
    
    
}
?>