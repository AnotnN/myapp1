
<div class="panel panel-default">
  <div class="panel-body">
      
  <?php
  
   $order['adultchild_title'] = $this->Data_forall->get_adultchild_title($order);
      
  ?>
      
 <div id="feed_order_inf<?php echo $order['id']; ?>">    
      
  <?php echo $this->lang->line('resort').": ".$order['resort_title'] ; ?>
  <br/>
  <?php echo $this->lang->line('equip').": ".$this->lang->line("{$order['equip']}") ; ?>
  <br/>
  <?php echo $this->lang->line('kolvo_peop').": ".$order['kolvo'].", (".$order['adultchild_title'].")" ; ?>
  <br/>
  <?php 
   if (isset($order['adultchild']['child']) and $order['adultchild']['child']==1) {
    echo $this->lang->line('age_child').": ";
    if ($order['age_child_from']!=$order['age_child_to']) echo mb_strtolower($this->lang->line('from'), 'UTF-8')." "; 
    echo $order['age_child_from'];
    if ($order['age_child_from']!=$order['age_child_to']) echo " ".mb_strtolower($this->lang->line('to'), 'UTF-8')." ".$order['age_child_to']; 
   }  
  ?>
  <br/>
  <?php echo $this->lang->line('fst_less').": ".str_replace(" ", " ".$this->lang->line('in')." ", $order['date_time_format']); ?>
  <br/>
  <?php echo $this->lang->line('kolvo_days').": ".$order['kolvo_days'] ; ?>
  <br/>
  <?php echo $this->lang->line('hours_by_day').": ".$order['hours_by_day'] ; ?>
  
  <br/><br/>
  
 </div>
      
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
