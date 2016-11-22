
<script type = "text/javascript">

 function upd_order() {
   
  $("#id_order").val(<?php echo $id_order;?>); 
  $("#succsess_div").hide();
  $("#order_form_div").show();
             
 }
 
 function new_order() {
     
  $("#id_order").val(0); 
 
  clearform();
  
  $("#succsess_div").hide();
  $("#order_form_div").show();
  
 }
 
 function clearform() {
     
  $('#OrderForm').data('formValidation').resetForm(true); 
  $("#kolvo").val(1);
  $("#child_age_div").hide();
  /*
  $('#age_child_from option[selected="selected"]').each(
    function() {
        $(this).removeAttr('selected');
    }
  );
  $('#age_child_to option[selected="selected"]').each(
    function() {
        $(this).removeAttr('selected');
    }
  );
  
  $("#age_child_from").val($("#target option:first").val());
  $("#age_child_to").val($("#target option:first").val());
  */
 }
 
 function open_deleting() {
  
  $("#succsess_buttons_div").hide();    
  $("#deleting_succ").show();
     
 }
 function close_deleting() {
  
  $("#deleting_succ").hide();
  $("#succsess_buttons_div").show();  
     
 }

 //$('#deleting_succ').on('closed.bs.alert', function () {
  //close_deleting();
 //});

 function del_order() {
   
   $.post( "<?php echo base_url();?>orderform/del_jqOrder", { id_order: <?php echo $id_order;?> }, 
                                  
        function(json) { 
                console.log(json);                  
          if (json.jq_html!="0") {
              
           $("#id_order").val(0);  
           clearform();
           $("#succsess_div").hide();
           $("#order_form_div").show();
           
          } else {       
           myalert(json.jq_alert_msg);   
          }
                                 
         return false;
         
        }, "json"); 
                 
   
 }

</script>
<div id="order_card_div">
    
  <?php echo $this->lang->line('resort').": ".$order['resort_title'] ; ?>
  <br/>
  <?php echo $this->lang->line('equip').": ".$this->lang->line("{$order['equip']}") ; ?>
  <br/>
  <?php echo $this->lang->line('kolvo_peop').": ".$order['kolvo'].", ".$order['adultchild_title'] ; ?>
  <br/>
  <?php 
   if (isset($order['adultchild']['child']) and $order['adultchild']['child']==1) {
    echo $this->lang->line('age_child').": ";
    if ($order['age_child_from']!=$order['age_child_to']) echo mb_strtolower($this->lang->line('from'), 'UTF-8')." "; 
    echo $order['age_child_from'];
    if ($order['age_child_from']!=$order['age_child_to']) echo " ".mb_strtolower($this->lang->line('to'), 'UTF-8')." ".$order['age_child_to']; 
   }  
  ?>
  <br/><br/>
  <?php echo $this->lang->line('your_name').": ".$order['name'] ; ?>
  <br/>
  <?php echo $this->lang->line('tel').": ".$order['tel'] ; ?>
  
  
</div>

<div id="succsess_buttons_div">
   
 <br/>   
 <button type="button" class="btn btn-default" onclick="upd_order();"><?php echo $this->lang->line("update") ; ?></button>  
 <button type="button" class="btn btn-default" aria-label="Left Align" style="margin-left:5px;color:red;" onclick="open_deleting();">
  <i class="fa fa-trash-o" aria-hidden="true" style="margin-right: 5px"></i><?php echo $this->lang->line("del") ; ?>
 </button>
 <br/><br/> 
 <button type="button" class="btn btn-default" onclick="new_order();">
  <i class="fa fa-plus" aria-hidden="true" style="margin-right: 5px"></i><?php echo $this->lang->line("add_new_order") ; ?>
 </button>  
 <br/><br/> 

 
</div>    

<div class="alert alert-danger" id="deleting_succ" role="alert" style="display:none;">

  <h4><?php echo $this->lang->line("deleting_order_title") ; ?></h4>   
  <p><?php echo $this->lang->line("deleting_order_body");?></p> 
  <br/> 
  <button type="button" class="btn btn-danger" onclick="del_order();"><?php echo $this->lang->line("del") ; ?></button>
  <button type="button" class="btn btn-default" onclick="close_deleting();"><?php echo $this->lang->line("cancel");?></button>
  
</div>
