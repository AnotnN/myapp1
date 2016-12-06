<?php
class Data_myorders extends CI_Model {
    
    
 function get_myorders_take($id_partner) {
      
  $arr = array();   
  
  $query = $this->db->query(""
            . "SELECT "
             . "orders.*, "
             . "orders.date_time as date_time, "
             . "DATE_FORMAT(orders.date_time,'%d.%m.%Y %H:%i') as date_time_format,"
             . "DATE_FORMAT(orders.data_born,'%d.%m.%Y %H:%i') as data_born_format,"
             . "resorts.title as resort_title,"
             . "IF( DATE_ADD(orders.date_time, INTERVAL orders.kolvo_days DAY)<=NOW(),1,0 ) as istek_srok "
            . "FROM orders,resorts WHERE "
             . "(orders.id_resort=resorts.id)"
             . "AND(orders.id_partner_take=$id_partner)"
             . "AND(orders.status!='deleted') "
             . ""
            . "ORDER BY status DESC,data_born"
            . ";");
      
    if ($query) {

     $arr = $query->result_array();  
        
    }    
     
  return $arr;
 }
    
 function get_myorders_give($id_partner) {
      
  $arr = array();   
  
  
  $query = $this->db->query(""
            . "SELECT "
             . "orders.*, "
             . "orders.date_time as date_time, "
             . "DATE_FORMAT(orders.date_time,'%d.%m.%Y %H:%i') as date_time_format,"
             . "DATE_FORMAT(orders.data_born,'%d.%m.%Y %H:%i') as data_born_format,"
             . "resorts.title as resort_title "
            . "FROM orders,resorts WHERE "
             . "(orders.id_resort=resorts.id)"
             . "AND(orders.id_partner_give=$id_partner)"
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