
<script type = "text/javascript">

  function show_warning_div(id) {
   $("#feed_buttons_div"+id).hide();
   $("#feed_warning_pickup_div"+id).show();
  }
  function close_warning_div(id) {
   $("#feed_buttons_div"+id).show();
   $("#feed_warning_pickup_div"+id).hide();  
  }
 
  function pickup_order(id) {
  
     $.post( "<?php echo base_url();?>feed/pickup_jqOrder", { id_order: id, id_partner: <?php echo $id_partner;?> }, 
                                  
        function(json) { 
                               
          if (json.jq_html!="0") {
            $("#feed_div").html(json.jq_html);  
          } 
                                 
         return false;
         
        }, "json"); 
        
  }
  
  
 function step2_order_accept() {
     
 }
 
 function step2_order_update() {
     
 }
 
 
 function open_disallow() {
  $('#succsess_buttons_div').hide();
  $('#warning_order_disallow').show(); 
 }
 function close_disallow() {
  $('#succsess_buttons_div').show();   
  $('#warning_order_disallow').hide(); 
 }
 
 function step2_order_disallow(id) {
     
       $.post( "<?php echo base_url();?>feed/order_disallow", { id_order: id, id_partner: <?php echo $id_partner;?> }, 
                                  
        function(json) { 
                               
          if (json.jq_html!="0") {
           window.location = "<?php echo base_url(); ?>feed";
          } 
                                 
         return false;
         
        }, "json");   
     
 }

 function step2_order_accept(id) {
 
      $.post( "<?php echo base_url();?>feed/order_accept", { id_order: id, id_partner: <?php echo $id_partner;?> }, 
                                  
        function(json) { 
                               
          if (json.jq_html!="0") {
           window.location = "<?php echo base_url(); ?>feed";
          } 
                                 
         return false;
         
        }, "json");   
 
 }
 
 function step2_order_update(id) {
 
      $.post( "<?php echo base_url();?>feed/feed_step2_order_update", { id_order: id, id_partner: <?php echo $id_partner;?> }, 
                                  
        function(json) { 
                               
          if (json.jq_html!="0") {
           
           $("#data_showing_order").hide();
           $("#succsess_buttons_div").hide();
           $("#order_update_div").show();
           $("#order_update_div_tab").html(json.jq_html);
           $("#id_order").val(id);
           
          } 
                                 
         return false;
         
        }, "json");   
 
 }
  
  function mysubmit() {
   
     $.post( "<?php echo base_url();?>orderform/add_jqOrder", $('#OrderForm').serialize(), 
                                  
        function(json) { 
                                  
          if (json.jq_html!="0") {
           
            $("#order_update_div").hide();
            $("#data_showing_order").show();
            $("#data_showing_order").html(json.jq_html_data_showing_order);
            $("#succsess_buttons_div").show();
                                    
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
 <div id="feed_div">  
 
    <?php 
    
     $i = 0;
     foreach ($orders as $row) {
      
      if ($i==0) echo "<br/>";   
      echo $this->load->view('feed/feed_order',array("order"=>$row),TRUE);   
      $i++;   
     }
    
    ?>
 
 </div>    
    
</div>    
</div>  