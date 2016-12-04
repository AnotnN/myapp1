<script type = "text/javascript">

 function myalert(txt) {   
    $("#alerts").html(txt);
    alertdismiss();   
 }
 function alertdismiss() {   
    $("#alerts").fadeTo(5000, 500).fadeOut(1000, function(){
     $("#alerts").alert('close');
    });
 }

 function open_disallow(id) {
  $('#succsess_buttons_div'+id).hide();
  $('#warning_order_disallow'+id).show(); 
 }
 function close_disallow(id) {
  $('#succsess_buttons_div'+id).show();   
  $('#warning_order_disallow'+id).hide(); 
 }
 
 function order_delete(id) {
     
       $.post( "<?php echo base_url();?>myorders/order_delete", { id_order: id }, 
                                  
        function(json) { 
                               
          if (json.jq_html!="0") {
           window.location = "<?php echo base_url(); ?>myorders";
          } else {               
            myalert(json.jq_alert_msg);   
          }
                                 
         return false;
         
        }, "json");   
     
 }
 
 function order_update(id) {
 
      $.post( "<?php echo base_url();?>myorders/order_update", { id_order: id}, 
                                  
        function(json) { 
                               
          if (json.jq_html!="0") {
           
           $("#myorders_list_div").hide();
           $("#myorders_update_div").show();
           
           $("#myorders_update_div").html(json.jq_html);
           $("#id_order").val(id);
           
          } 
                                 
         return false;
         
        }, "json");   
 
 }
 
 function mysubmit() {
   
     $.post( "<?php echo base_url();?>orderform/add_jqOrder", $('#OrderForm').serialize(), 
                                  
        function(json) { 
                                  
          if (json.jq_html!="0") {
           
            window.location = "<?php echo base_url(); ?>myorders";
            
           } else {               
            myalert(json.jq_alert_msg);   
           }
                                 
         return false;
         
        }, "json"); 
                
    
       
     return false;
    }
    
</script> 

<div class="container-fluid">
<div class="row">
 <div id="myorders_list_div">  
 
    <?php 
    
     $i = 0;
     foreach ($orders as $row) {      
      if ($i==0) echo "<br/>";   
      echo $this->load->view('myorders/myorders_order',array("order"=>$row),TRUE);   
      $i++;   
     }
    
    ?>
 
 </div>
 <div id="myorders_update_div" style="display:none;">
        
 </div>

  <div id="alerts" style="position: absolute; top:1%; right:1%;"></div>  
    
</div>    
</div>

