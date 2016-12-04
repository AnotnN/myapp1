
    
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
    echo "<br/>";
   }  
  ?>
  <br/>
  <?php echo $this->lang->line('fst_less').": ".str_replace(" ", " ".$this->lang->line('in')." ", $order['date_time_format']); ?>
  <br/>
  <?php echo $this->lang->line('kolvo_days').": ".$order['kolvo_days'] ; ?>
  <br/>
  <?php echo $this->lang->line('hours_by_day').": ".$order['hours_by_day'] ; ?>
  <br/>
  