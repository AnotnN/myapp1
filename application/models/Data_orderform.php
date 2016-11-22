<?php
class Data_orderform extends CI_Model {

    
   function get_order($id) {
    
    $arr = array();   
       
    
    $arr = $this->Data_uni->uni_get_row_by_id("orders","id",$id);
    
     $query = $this->db->query(""
            . "SELECT "
             . "orders.*,"
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
    
    $arr['adultchild'] = array_flip(explode(",", $arr['adultchild'] ));
    $arr['adultchild_title'] = "";
    
    if (isset($arr['adultchild']['child'])) { $arr['adultchild']['child'] = 1; $arr['adultchild_title'] .= $this->lang->line('adult');}
    if (isset($arr['adultchild']['adult'])) { $arr['adultchild']['adult'] = 1; if ($arr['adultchild_title']!="") $arr['adultchild_title'].=" ".  $this->lang->line('and'); $arr['adultchild_title'] .= " ".$this->lang->line('child'); }
    
    
    return $arr;   
   }


}
?>