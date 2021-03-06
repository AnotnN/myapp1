<?php
class Data_forall extends CI_Model {


function get_plug_components($param) {
    
 $str = "";   
 
 $arr = array(
     
     "jquery"=>"<script src='".base_url()."/vendor/components/jquery/jquery.min.js'></script>",
     "jqueryui"=>"<script src='".base_url()."/vendor/components/jqueryui/jquery-ui.js'></script><link rel='stylesheet' href='".base_url()."/vendor/components/jqueryui/base/jquery-ui.min.css'>",
     "bootstrap"=>"<script type='text/javascript' src='".base_url()."/vendor/components/bootstrap/js/bootstrap.min.js'></script><link rel='stylesheet' href='".base_url()."/vendor/components/bootstrap/css/bootstrap.min.css'>",
     "font_awesome"=>"<link rel='stylesheet' href='".base_url()."/vendor/components/font-awesome/css/font-awesome.min.css'>",
     "bootstrapvalidate"=>"<script src='".base_url()."/vendor/components/bootstrapvalidate/bootstrapValidator.min.js'></script>",
     "datetimepicker"=>"<script src='".base_url()."/vendor/components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js' charset='UTF-8' ></script><script src='".base_url()."/vendor/components/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.".$_POST['localize'].".js' charset='UTF-8' ></script><link rel='stylesheet' href='".base_url()."/vendor/components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'>"
     
     );
 
 foreach ($param as $k => $v) {
  
   if (isset($arr[$v]))  $str .= $arr[$v]; 
     
 }
    
 return $str;   
}

function get_css($param) {
    
 $str = "";   
 
    $arr = array(
     
     "forall"=>"<link rel='stylesheet' href='".base_url()."/css/forall.css'>",
     "orderform"=>"<link rel='stylesheet' href='".base_url()."/css/orderform.css'>",
     "feed"=>"<link rel='stylesheet' href='".base_url()."/css/feed.css'>",
     "myorders"=>"<link rel='stylesheet' href='".base_url()."/css/myorders.css'>"
    );
 
 foreach ($param as $k => $v) {
  
   if (isset($arr[$v]))  $str .= $arr[$v]; 
     
 }
    
 return $str;   
}


function get_all_date_from_post() {
    
 $arr = array();   
 
 foreach ($_POST as $k => $v) {
   
  if ($this->input->post("$k", TRUE)) {$arr["$k"] = $this->input->post("$k");}
     
 }
      
    
 if (count($arr)) { return $arr; }else{ return FALSE; }   
}


function get_adultchild_title($order) {
    
 $str = "";
 
 $order['adultchild'] = array_flip(explode(",", $order['adultchild'] ));
 $order['adultchild_title'] = "";
    
  if (isset($order['adultchild']['adult'])) { 
     $order['adultchild']['adult'] = 1; 
     $order['adultchild_title'] .= $this->lang->line('adult');     
  }
  if (isset($order['adultchild']['child'])) { 
      
      $order['adultchild']['child'] = 1; 
      if ($order['adultchild_title']!="") $order['adultchild_title'].=" ".$this->lang->line('and')." "; 
      $order['adultchild_title'] .= $this->lang->line('child'); 
      
  }
 
 $str = $order['adultchild_title'];
 
 return $str;   
}

 function adultchild_to_array($arr){
       
    $arr['adultchild'] = array_flip(explode(",", $arr['adultchild'] ));
    $arr['adultchild_title'] = "";
    
     if (isset($arr['adultchild']['adult'])) { 
        
        $arr['adultchild']['adult'] = 1; 
        $arr['adultchild_title'] .= $this->lang->line('adult');
        
     }
     if (isset($arr['adultchild']['child'])) { 
        $arr['adultchild']['child'] = 1; 
        if ($arr['adultchild_title']!="") $arr['adultchild_title'].=" ".$this->lang->line('and')." "; 
        $arr['adultchild_title'] .= $this->lang->line('child'); 
     }
    
   return $arr;
  }
  
  function get_partner() {
    
   $arr = array();
   
   if ($this->session->userdata('id_partner')) { 
       
     $id_partner = $this->session->userdata('id_partner');
   
     $query = $this->db->query(""
             . "SELECT "
              . "accounts.fio as fio,"
              . "accounts.type_of_partner as type_of_partner,"
              . "accounts.tel as tel,"
              . "accounts.email as email,"
              . "FIND_IN_SET ('give',accounts.givetake) as give,"
              . "FIND_IN_SET ('take',accounts.givetake) as take,"
              . "FIND_IN_SET ('ski',accounts.equip) as ski,"
              . "FIND_IN_SET ('sb',accounts.equip) as sb"
             ." FROM accounts WHERE (id='$id_partner')"
             . ";");
     
        if ($query) {

            $row = $query->result_array();
            if ($row[0]) { 
                 
                $arr = $row[0];

            }
            
        }
     
   }
   
   
   
   return $arr;   
  }

  
  function send_pismo($ot_kogo,$to,$tema,$telo) {

   $this->load->library('email');
      
   $config['charset'] = 'utf-8';
   $config['mailtype'] = 'html';
   $config['newline'] = "\r\n"; 
   $config['smtp_port'] = '587';
   
   //$ot_kogo = "no_reply@cprm-game.kz";

   $this->email->initialize($config);

   $ot_kogo_podpis = "$ot_kogo";
 
   $this->email->from("$ot_kogo", "$ot_kogo_podpis");
   $this->email->to("$to");
   $this->email->subject("$tema"); 
   $this->email->message("$telo");

   $this->email->send();
  
  }

}
?>