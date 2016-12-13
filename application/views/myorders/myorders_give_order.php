
  <?php
  
   $order['adultchild_title'] = $this->Data_forall->get_adultchild_title($order);
   
   $type_panel = "info";
   $rgb_panel = "rgb(204,231,245)";
   
   if ($order['status']=="in_operation_step1" or $order['status']=="in_operation_step2") {
    $type_panel = "warning";
    $rgb_panel = "rgb(251,246,219)";  
   }
   if ($order['status']=="complete") {
    $type_panel = "success";
    $rgb_panel = "rgb(215,236,206)";  
   }
   
  ?>


<div class="panel panel-<?php echo $type_panel; ?>" >
    
  <div class="panel-body" style="background-color: <?php echo $rgb_panel; ?>">
      
 <div id="feed_order_inf<?php echo $order['id']; ?>">    
     
  <?php echo $this->lang->line('data_born').": <b>".$order['data_born_format']."</b>" ; ?>
  <br/>
  <?php echo $this->lang->line('status').": <i>".$this->lang->line($order['status'])."</i>" ; ?>
  <br/><br/>
  
  
  <?php 
  
   $pageData['order'] = $order;
   
   $this->load->view('forall/order_for_show',$pageData); 
   
  ?>
  
   <br/>
   <?php echo $this->lang->line('your_name').": ".$order['name'] ; ?>
   <br/>
   <?php echo $this->lang->line('tel').": ".$order['tel'] ; ?>
  
 </div>
      
  <div id="feed_buttons_div<?php echo $order['id']; ?>">
   
  <?php if ($order['status']=="vacant") { ?>  
    
 <div id="succsess_buttons_div<?php echo $order['id']; ?>">     
  <table border="0" style="width:100%;">
   <tr>
    <td colspan="2"> 
     <br/>   
     <button type="button" class="btn btn-default" onclick="order_update(<?php echo $order['id']; ?>);" style=""><i class="fa fa-pencil" aria-hidden="true" style='margin-right: 5px; color:blueviolet;'></i><?php echo $this->lang->line("update") ; ?></button>  
    </td>
   </tr> 
   <tr>
    <td colspan="2" align='left'> 
     <br/> 
     <button type="button" class="btn btn-default" onclick="open_disallow(<?php echo $order['id']; ?>);" style=";"><i class="fa fa-times" aria-hidden="true" style='margin-right: 5px; color:red;'></i><?php echo $this->lang->line("delete") ; ?></button>  
    </td>
   </tr>
  </table>   
 </div>    
      
 <div class="alert alert-danger" id="warning_order_disallow<?php echo $order['id']; ?>" role="alert" style="display:none;">

  <p>
   <label><?php echo $this->lang->line("warning_cancel_order");?></label>
  </p> 
  
  <br/> 
  <button type="button" class="btn btn-danger" onclick="order_delete(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("delete");?></button>
  <button type="button" class="btn btn-default" onclick="close_disallow(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("cancel");?></button>
  
 </div>    
      
  <?php } ?>
      
      
  </div>    
  
  </div>
</div>
