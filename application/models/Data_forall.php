<?php
class Data_forall extends CI_Model {


function get_plug_components($param) {
    
 $str = "";   
 
 $arr = array(
     
     "jquery"=>"<script src='".base_url()."/vendor/components/jquery/jquery.min.js'></script>",
     "jqueryui"=>"<script src='".base_url()."/vendor/components/jqueryui/jquery-ui.js'></script><link rel='stylesheet' href='".base_url()."/vendor/components/jqueryui/base/jquery-ui.min.css'>",
     "bootstrap"=>"<script type='text/javascript' src='".base_url()."/vendor/components/bootstrap/js/bootstrap.min.js'></script><link rel='stylesheet' href='".base_url()."/vendor/components/bootstrap/css/bootstrap.min.css'>",
     "font_awesome"=>"<link rel='stylesheet' href='".base_url()."/vendor/components/font-awesome/css/font-awesome.min.css'>",
     "bootstrapvalidate"=>"<script src='".base_url()."/vendor/components/bootstrapvalidate/bootstrapValidator.min.js'></script>"
     
     );
 
 foreach ($param as $k => $v) {
  
   if (isset($arr[$v]))  $str .= $arr[$v]; 
     
 }
    
 return $str;   
}


}
?>