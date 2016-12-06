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
           window.location = "<?php echo base_url(); ?>myorders/<?php echo $takegive; ?>";
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
           
            window.location = "<?php echo base_url(); ?>myorders/<?php echo $takegive; ?>";
            
           } else {               
            myalert(json.jq_alert_msg);   
           }
                                 
         return false;
         
        }, "json"); 
                
    
       
     return false;
    }
    
 function open_disallow(id) {
  $('#succsess_buttons_div'+id).hide();
  $('#warning_order_disallow'+id).show(); 
 }
 function close_disallow(id) {
  $('#succsess_buttons_div'+id).show();   
  $('#warning_order_disallow'+id).hide(); 
 }
 
 function open_complete(id) {
  $('#succsess_buttons_div'+id).hide();
  $('#warning_order_complete'+id).show(); 
  $('#cena'+id).focus();
 }
 function close_complete(id) {
  $('#succsess_buttons_div'+id).show();   
  $('#warning_order_complete'+id).hide(); 
 }
 
 function get_txt_cena(id,kolvo_chel,kolvo_days,hours_by_day,cena) {
     
   var txt = "";  
   var cena_dop_den = 100;
   var itogo = 0;
   var procent_komiss = 13;
   
   if (cena>100) {
   
    txt = "<?php echo $this->lang->line("your_dolg");?>"+": "+procent_komiss+"% "+"<?php echo $this->lang->line("ot");?> ("+kolvo_chel+"<?php echo $this->lang->line("chel");?>"+" * "+hours_by_day+"<?php echo $this->lang->line("chas");?>"+" * "+cena+"<?php echo $this->lang->line("valuta_socr");?>)";
    
    itogo = (itogo + kolvo_chel*hours_by_day*cena)/100*13;
    
    if (kolvo_days>1) { txt = txt + " + " + cena_dop_den + "<?php echo $this->lang->line("valuta_socr");?>" + " <?php echo $this->lang->line("zadopday");?>"; itogo = itogo + (kolvo_days-1)*cena_dop_den }
    
    itogo = Math.round(itogo);
    
    txt = txt + " = " + itogo +"<?php echo $this->lang->line("valuta_socr");?>";
    
   }
   
   $('#cena_str'+id).text(txt);
   
 }
 
 function step2_order_disallow(id) {
     
       $.post( "<?php echo base_url();?>feed/order_disallow", { id_order: id, id_partner: <?php echo $id_partner;?> }, 
                                  
        function(json) { 
                               
          if (json.jq_html!="0") {
           window.location = "<?php echo base_url(); ?>myorders/<?php echo $takegive; ?>";
          } 
                                 
         return false;
         
        }, "json");   
     
 }
 
 function order_complete(id) {
     
       $.post( "<?php echo base_url();?>myorders/order_complete", { id_order: id, cena: $('#cena'+id).val() }, 
                                  
        function(json) { 
                               
          if (json.jq_html!="0") {
           window.location = "<?php echo base_url(); ?>myorders/<?php echo $takegive; ?>";
          } else {
           myalert(json.jq_alert_msg);   
          }    
                                 
         return false;
         
        }, "json");   
     
 }
    
</script> 

<div class="container-fluid">
<div class="row">
 <div id="myorders_list_div" style="padding-top:5px;">  
 
    <?php 
    
     $i = 0;
     foreach ($orders as $row) {        
      echo $this->load->view("myorders/myorders_".$takegive."_order",array("order"=>$row),TRUE);   
      $i++;   
     }
    
    ?>
 
 </div>
 <div id="myorders_update_div" style="display:none;">
        
 </div>

  <div id="alerts" style="position: absolute; top:1%; right:1%;"></div>  
    
</div>    
</div>

