
  <?php
  
   $order['adultchild_title'] = $this->Data_forall->get_adultchild_title($order);
   
   $type_panel = "info";
   $rgb_panel = "rgb(204,231,245)";
   
   if ($order['status']=="in_operation_step1" or $order['status']=="in_operation_step2") {
    $type_panel = "warning";
    $rgb_panel = "rgb(251,246,219)";  
   }
   
   if ($order['istek_srok']==1) {
    $type_panel = "danger";
    $rgb_panel = "rgb(237,209,209)";  
   }
   
   if ($order['status']=="complete") {
    $type_panel = "success";
    $rgb_panel = "rgb(215,236,206)";  
   }
   
  
   
  ?>


<div class="panel panel-<?php echo $type_panel; ?>" >
    
  <div class="panel-body" style="background-color: <?php echo $rgb_panel; ?>">
      
 <div id="feed_order_inf<?php echo $order['id']; ?>">    
  
  
  <?php 
  
   $pageData['order'] = $order;
   
   $this->load->view('forall/order_for_show',$pageData); 
   
  ?>
  
 </div>
      
  <div id="feed_buttons_div<?php echo $order['id']; ?>">
    
 <div id="succsess_buttons_div<?php echo $order['id']; ?>">   
  <?php if ($order['status']!="complete") { ?>   
  <table border="0" style="width:100%;">
   <tr>
    <td colspan="2" align='left'> 
    <?php if ($order['istek_srok']==1) { ?>
     <br/> 
     <button type="button" class="btn btn-default" onclick="open_complete(<?php echo $order['id']; ?>);" style=";"><i class="fa fa-check" aria-hidden="true" style='margin-right: 5px; color:green;'></i><?php echo $this->lang->line("complete_order") ; ?></button>  
    <?php } ?>
    </td>
   </tr>   
   <tr>
    <td colspan="2"> 
     <br/>   
     <button type="button" class="btn btn-default" onclick="order_update(<?php echo $order['id']; ?>);" style=""><i class="fa fa-pencil" aria-hidden="true" style='margin-right: 5px; color:blueviolet;'></i><?php echo $this->lang->line("update") ; ?></button>  
    </td>
   </tr> 
   <tr>
    <td colspan="2" align='left'> 
    <?php if ($order['istek_srok']==0) { ?>
     <br/> 
     <button type="button" class="btn btn-default" onclick="open_disallow(<?php echo $order['id']; ?>);" style=";"><i class="fa fa-times" aria-hidden="true" style='margin-right: 5px; color:red;'></i><?php echo $this->lang->line("disallow_order") ; ?></button>  
    <?php } ?>
    </td>
   </tr>
  </table>   
  <?php }else{ ?>   
   
   <br><p>  
    <b><i class="fa fa-check" aria-hidden="true" style='margin-right: 5px; color:green;'></i><?php echo $this->lang->line("order_complete") ; ?></b>
   </p>  
   <?php echo $this->lang->line("komiss_k_oplat").": ".$order['credit'].$this->lang->line("valuta_socr") ; ?>
   <?php if ($order['istek_srok']==1) { ?>
     <br/><br/>
     <button type="button" class="btn btn-default" onclick="open_complete(<?php echo $order['id']; ?>);" style=";"><?php echo $this->lang->line("edit_cena") ; ?></button>  
    <?php } ?>
   
  <?php } ?>   
 </div>    
     
 <div class="alert alert-danger" id="warning_order_disallow<?php echo $order['id']; ?>" role="alert" style="display:none; margin-top: 10px;">

  <p>
  <div class="radio">
   <label>
    <input type="radio" name="reasonDisalowOredr" id="reasonDisalowOredr1<?php echo $order['id']; ?>" value="wrong_number">
    <?php echo $this->lang->line("wrong_number");?>
   </label>
  </div>
  <div class="radio">
   <label>
    <input type="radio" name="reasonDisalowOredr" id="reasonDisalowOredr2<?php echo $order['id']; ?>" value="error_accept">
    <?php echo $this->lang->line("error_accept");?>
   </label>
  </div>
  <div class="radio">
   <label>
    <input type="radio" name="reasonDisalowOredr" id="reasonDisalowOredr3<?php echo $order['id']; ?>" value="wrong_dates_in_order">
    <?php echo $this->lang->line("wrong_dates_in_order");?>
   </label>
  </div>
  </p> 
  
  <br/> 
  <button type="button" class="btn btn-danger" onclick="step2_order_disallow(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("disallow_order") ; ?></button>
  <button type="button" class="btn btn-default" onclick="close_disallow(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("cancel");?></button>
  
</div>  
      
<div class="alert alert-warning" id="warning_order_complete<?php echo $order['id']; ?>" role="alert" style="display:none; margin-top: 10px;">

    <label>
     <?php echo $this->lang->line("complete_txt");?>:   
    </label>  
    <p>
     <input type="number" name="cena<?php echo $order['id']; ?>" id="cena<?php echo $order['id']; ?>" value="" required min="100" oninput=" get_txt_cena(<?php echo $order['id']; ?>,<?php echo $order['kolvo']; ?>,<?php echo $order['kolvo_days']; ?>,<?php echo $order['hours_by_day']; ?>,this.value); " />
     <p><div id="cena_str<?php echo $order['id']; ?>"></div></p>
    </p>
    
  <br/> 
  <button type="button" class="btn btn-success" onclick="order_complete(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("finish");?></button>
  <button type="button" class="btn btn-default" onclick="close_complete(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("cancel");?></button>
  
</div>        
 
  </div>    
  
  </div>
</div>
