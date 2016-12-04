<?php
class Data_myorders extends CI_Model {
    
    
 function get_myorders($takegive,$id_partner) {
      
  $arr = array();   
  
  $where_takegive = "AND(orders.id_partner_$takegive=$id_partner)";

  
  $query = $this->db->query(""
            . "SELECT "
             . "orders.*, "
             . "orders.date_time as date_time, "
             . "DATE_FORMAT(orders.date_time,'%d.%m.%Y %H:%i') as date_time_format,"
             . "DATE_FORMAT(orders.data_born,'%d.%m.%Y %H:%i') as data_born_format,"
             . "resorts.title as resort_title "
            . "FROM orders,resorts WHERE "
             . "(orders.id_resort=resorts.id)"
             . $where_takegive
             . "AND(orders.status!='deleted') "
            . "ORDER BY status,data_born"
            . ";");
      
    if ($query) {

     $arr = $query->result_array();  
        
    }    
     
  
  return $arr;
 }
    
    
}
?>