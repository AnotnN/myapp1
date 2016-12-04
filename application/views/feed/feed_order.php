
<div class="panel panel-default">
  <div class="panel-body">
      
  <?php
  
   $pageData['order'] = $order;
   
  ?>
      
   <div id="feed_order_inf<?php echo $order['id']; ?>">    

    <?php $this->load->view('forall/order_for_show',$pageData); ?>
   
   </div>
      
   <br/>   
  
      
 
  <div id="feed_buttons_div<?php echo $order['id']; ?>">
    
    <button type="button" class="btn btn-warning" onclick="show_warning_div(<?php echo $order['id']; ?>);"><?php echo $this->lang->line('pick_order'); ?></button>  
      
  </div>    
      
  <div id="feed_warning_pickup_div<?php echo $order['id']; ?>" class="alert alert-warning" role="alert" style="display:none;">
    <h5><?php echo $this->lang->line('warning_pick_order'); ?></h5><br/>  
    <button type="button" class="btn btn-warning" onclick="pickup_order(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("pick") ; ?></button>
    <button type="button" class="btn btn-default" onclick="close_warning_div(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("cancel");?></button>
  
  </div>    
  
  </div>
</div>
