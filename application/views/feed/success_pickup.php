


<div id="order_card_div"  style="background-color: #e8ccff; padding: 10px 5px 10px 5px;">

   <div id="order_update_div" style="">
       <table><tr><td id="order_update_div_tab"></td></tr></table>
   </div>
    
   <div id="data_showing_order">
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
  
  <b>
  <br/><br/>
  <?php echo $this->lang->line('your_name').": ".$order['name'] ; ?>
  <br/>
  <?php echo $this->lang->line('tel').": ".$order['tel'] ; ?>
  </b>  
   </div>
  
</div>

<div id="success_feedorder_title_div" style="background-color: #efbff2; color: #FFF; padding: 10px 5px 10px 5px;" >
  
 <div id="succsess_buttons_div">
   
  <br/>   
  <table border="0" style="width:100%;">
   <tr>
    <td colspan="2">   
     <button type="button" class="btn btn-default" onclick="step2_order_accept(<?php echo $order['id']; ?>);" style='color:green;'><b><i class="fa fa-check" aria-hidden="true" style='margin-right: 5px; color:green;'></i><?php echo $this->lang->line("accept") ; ?></b></button>  
    </td>
   </tr>
   <tr>
    <td colspan="2"> 
     <br/>   
     <button type="button" class="btn btn-default" onclick="step2_order_update(<?php echo $order['id']; ?>);" style=""><i class="fa fa-pencil" aria-hidden="true" style='margin-right: 5px; color:blueviolet;'></i><?php echo $this->lang->line("update") ; ?></button>  
    </td>
   </tr> 
   <tr>
    <td colspan="2" align='left'> 
     <br/> 
     <button type="button" class="btn btn-default" onclick="open_disallow();" style=";"><i class="fa fa-times" aria-hidden="true" style='margin-right: 5px; color:red;'></i><?php echo $this->lang->line("disallow_order") ; ?></button>  
    </td>
   </tr>
  </table> 
  
  <BR/><p><?php echo $this->lang->line("your_order_success");?></p>   
 
 </div>   
  
</div>


<div class="alert alert-danger" id="warning_order_disallow" role="alert" style="display:none;">

  <p>
  <div class="radio">
   <label>
    <input type="radio" name="reasonDisalowOredr" id="reasonDisalowOredr1" value="wrong_number">
    <?php echo $this->lang->line("wrong_number");?>
   </label>
  </div>
  <div class="radio">
   <label>
    <input type="radio" name="reasonDisalowOredr" id="reasonDisalowOredr2" value="error_accept">
    <?php echo $this->lang->line("error_accept");?>
   </label>
  </div>
  </p> 
  
  <br/> 
  <button type="button" class="btn btn-danger" onclick="step2_order_disallow(<?php echo $order['id']; ?>);"><?php echo $this->lang->line("disallow_order") ; ?></button>
  <button type="button" class="btn btn-default" onclick="close_disallow();"><?php echo $this->lang->line("cancel");?></button>
  
</div>
