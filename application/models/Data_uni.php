<?php
class Data_uni extends CI_Model {
    
   
function uni_insert($data,$table) {
   
  $fields = $values = "";
  
  $cntarr = COUNT($data);
  $i = 0;
  
  foreach ($data as $k => $v) {
      
    $i++;  
      
    $fields .= "$k";
    if ($i<$cntarr) $fields .= ",";
    
    $values .= "'$v'";
    if ($i<$cntarr) $values .= ",";
    
  }
  
  
  if (($fields!="")AND($values!="")) {
           
   $query = $this->db->query("INSERT INTO $table ($fields) VALUES ($values);");  
   
   if ($query) { return $this->db->insert_id(); } else { return FALSE; }
  
  }
  
  
 return FALSE; 
}    

function uni_get_value_by_some_pars($value,$table,$arr) {
       
  $where = "";  
  $i = 0;
  
  foreach ($arr as $k => $v) {
    
    if ($i>0) $where .= "AND";
    $where .= "($k='$v')";
  
    $i++;  
      
  } 
    
     $query = $this->db->query("SELECT $value as val FROM $table WHERE $where ;");
     
        if ($query) {

            $row = $query->row();
            if ($row) return $row->val;

        } else { return FALSE; }  
        
} 

function uni_get_value_by_field($value,$table,$field,$field_value) {
       
     $query = $this->db->query("SELECT $value as val FROM $table WHERE ($field='$field_value')");
     
        if ($query) {

            $row = $query->row();
            if ($row) return $row->val;

        } else { return FALSE; }  
        
}    
    
function uni_update($table,$where_field_name,$where_field_value,$value_name,$new_value) {
      
     $query = $this->db->query("UPDATE $table SET $value_name='$new_value' WHERE $where_field_name='$where_field_value'");

     if ($query) { return TRUE; } else { return FALSE; }  
       
}   

function uni_update_arr($data,$table,$where_field_name,$where_field_value) {
   
  $sets = "";
  
  $cntarr = COUNT($data);
  $i = 0;
  
  foreach ($data as $k => $v) {
      
    $i++;  
      
    $sets .= "$k='$v'";
    if ($i<$cntarr) $sets .= ",";
 
  }
  
  
  if ($sets!="") {
      
    $query = $this->db->query("UPDATE $table SET $sets WHERE $where_field_name='$where_field_value'");

    if ($query) { return TRUE; } else { return FALSE; }  
  
  }
  
  
 return FALSE; 
} 

function uni_get_toKVarr_from_table_by_some_pars($table,$k_field,$v_field,$pars,$sort_field) {
    
  $where = "";  
  $i = 0;
  
  foreach ($pars as $k => $v) {
    
    if ($i>0) $where .= "AND";
    $where .= "($k='$v')";
  
    $i++;  
      
  }   
    
     $arr = array(); $sort = "";
     
     if ($sort_field!="") $sort = "ORDER by $sort_field"; 
     
     $query = $this->db->query("SELECT $k_field as k, $v_field as v FROM $table WHERE $where $sort");
     
        if ($query) {

         foreach ($query->result_array() as $row) {
          $arr[$row['k']] = $row['v'];
         }   
         
        }    
        
     return $arr;   
}

function uni_get_toKVarr_from_table_by_value($table,$k_field,$v_field,$value_name,$value,$sort_field) {
        
     $arr = array(); $sort = "";
     
     if ($sort_field!="") $sort = "ORDER by $sort_field"; 
     
     $query = $this->db->query("SELECT $k_field as k, $v_field as v FROM $table WHERE $value_name='$value' $sort");
     
        if ($query) {

         foreach ($query->result_array() as $row) {
          $arr[$row['k']] = $row['v'];
         }   
         
        }    
        
     return $arr;   
}

function uni_get_row_by_some_pars($table,$arr) {
    
  $where = "";  
  $i = 0;
  
  foreach ($arr as $k => $v) {
    
    if ($i>0) $where .= "AND";
    $where .= "($k='$v')";
  
    $i++;  
      
  }   
  
  $query = $this->db->query("SELECT * FROM $table WHERE $where ;");
     
        if ($query) {

            $row = $query->result_array();
            if ($row) $arr = $row;

            if (isset($arr[0])) { return $arr[0]; }else{ return FALSE; }
        } else { return FALSE; }    
    
}

function uni_get_row_by_id($table,$id_title,$id_value) {
     $arr = array(); 
     $query = $this->db->query("SELECT * FROM $table WHERE ($id_title='$id_value')");
     
        if ($query) {

            $row = $query->result_array();
            if ($row) $arr = $row;

            if (isset($arr[0])) { return $arr[0]; }else{ return FALSE; }
        } else { return FALSE; }           
 }
 
function uni_get_data_from_table_by_some_pars($table,$arr,$sort_field) {
   
 $res = array(); 
 if ($sort_field!="") {$sort = "ORDER by $sort_field";}else{$sort = "";}  
 $where = "";  
 $i = 0;
  
 if ($arr) {
     
  foreach ($arr as $k => $v) {
    
    if ($i>0) $where .= "AND";
    $where .= "($k='$v')";
  
    $i++;  
      
  }       
  
  
      $query = $this->db->query("SELECT * FROM $table WHERE $where $sort ;");
     
      if ($query)  $res = $query->result_array();
       
        
  }
  
 return $res;  
} 
 
function uni_get_data_from_table_by_value($table,$value_name,$value,$sort_field) {
        
     $arr = array(); $sort = "";
     
     if ($sort_field!="") $sort = "ORDER by $sort_field"; 
     
     $query = $this->db->query("SELECT * FROM $table WHERE $value_name='$value' $sort ");
     
      if ($query) {
       foreach ($query->result_array() as $row) {
        $arr[] = $row;
       }
      }   
        
 return $arr;   
}


function uni_get_alldata_toKVarr_from_table($table,$k_field,$v_field,$sort_field) {
        
     $arr = array(); $sort = "";
     
     if ($sort_field!="") $sort = "ORDER by $sort_field"; 
     
     $query = $this->db->query("SELECT $k_field as k, $v_field as v FROM $table $sort");
     
        if ($query) {

         foreach ($query->result_array() as $row) {
          $arr[$row['k']] = $row['v'];
         }   
         
        }    
        
 return $arr;   
}


function uni_get_alldata_from_table($table,$sort_field) {
        
     $arr = array(); $sort = "";
     
     if ($sort_field!="") $sort = "ORDER by $sort_field"; 
     
     $query = $this->db->query("SELECT * FROM $table $sort");
     
      if ($query) {
       foreach ($query->result_array() as $row) {
        $arr[] = $row;
       }
      }   
        
     return $arr;   
}

function uni_delete_by_some_pars($table,$arr) {
        
  $where = "";  
  $i = 0;
  
  foreach ($arr as $k => $v) {
    
    if ($i>0) $where .= "AND";
    $where .= "($k='$v')";
  
    $i++;  
      
  }
    
     $query = $this->db->query("DELETE FROM $table WHERE $where ;");
     
     if ($query) {return TRUE; } else { return FALSE; }          
}

function uni_delete_by_field($table,$field_title,$field_value) {
        
     $query = $this->db->query("DELETE FROM $table WHERE ($field_title='$field_value')");
     
     if ($query) {return TRUE; } else { return FALSE; }          
}
    

function get_kurator_by_numb($numb) {
     
     $arr = array();
        
     $query = $this->db->query(""
             . "SELECT "
              . "teachers.* "
             . "FROM teachers,participants WHERE "
             . "(participants.numb='$numb')AND"
             . "(teachers.id_part=participants.id_part);"
             . "");
     
      if ($query) {
          
       if ($query->num_rows() > 0) {
       
        $arr = $query->result_array();   
        return $arr[0]; 
        
       }else{  return FALSE;  }     
       
      }        
        
    }
    
 function get_kurator_idschool_bynumb($numb) {
     
     $arr = array();
        
     $query = $this->db->query(""
             . "SELECT "
              . "id_school "
             . "FROM teachers WHERE "
             . "(teachers.id_part='$numb')"
             . "");
     
      if ($query) {
          
       if ($query->num_rows() > 0) {
       
        $row = $query->row();
        return $row->id_school; 
        
       }else{  return FALSE;  }     
       
      }       
      
  return FALSE;       
 }    

 function YearToDay($date) {

  $time = "";    
  $arr = explode(" ",$date);
  
  if (COUNT($arr)>1) { $date = $arr[0]; $time = " ".$arr[1]; }
  
  $time_arr = explode(":",$time);
  
  if (COUNT($arr)>1) {$time = $time_arr[0].":".$time_arr[1];};
 
    $expr = '/  (\d{2,4}) [[:punct:]] (\d{2}) [[:punct:]] (\d{2,4})/sx';
    $reg = preg_match($expr, $date, $pokets);
    if ((isset($pokets[3]))AND(isset($pokets[2]))AND(isset($pokets[1]))) {$date = $pokets[3].".".$pokets[2].".".$pokets[1];}else{$date = false;}
    return $date.$time;
  }
  
  
function get_uni_select_str($arr,$name,$id_selectd) {
  
  $str = "";
    
  $str .= "
  <select id='$name' name='$name' class='form-control' data-live-search='true' style=''>";
     
     $str .= "<option value='' style='display:none;'>  </option>";   
      
        foreach ($arr as $k => $v) {    
            
           if ($k==$id_selectd) {$selected = "selected='selected'";}else{$selected = "";}
           $str .= "<option value='$k' $selected >$v</option>";   
          
        } 
       
    
   $str .= "    
     </select>";     
    
  return $str; 
}
  
  function get_localize($userLang) {
      
   $localize = "ru";
   
    if ($userLang=='russian') $localize = "ru";
    if ($userLang=='english') $localize = "en";
    if ($userLang=='byelorussian') $localize = "ru";
    if ($userLang=='kazakh') $localize = "ru";  
       
   return $localize;   
  }
  
  function is_valid_date($date) {
    return preg_match('/^(\\d{2})\\.(\\d{2})\\.(\\d{4})$/', $date, $m)
        && checkdate($m[2], $m[1], $m[3]);
  }
  
  function table_exists($table){

   $query = $this->db->query("SHOW TABLES LIKE '".$table."'");
      
   if($query->num_rows()==1) { $flag = true; } else { $flag = false; }  
    
   return $flag;
  }
  
  function filed_exist($table,$field) {
      
   $query = $this->db->query("
        SELECT 
         * 
        FROM information_schema.COLUMNS WHERE 
         TABLE_SCHEMA = '".$this->db->database."' 
         AND TABLE_NAME = '$table' 
         AND COLUMN_NAME = '$field'
       ;");   
      
   if($query->num_rows()==1) { return TRUE; } else { return FALSE; }  
  }
 
}
?>
