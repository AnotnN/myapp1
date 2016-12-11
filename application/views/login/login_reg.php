
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
 
 $(document).ready(function() {   
     
   <?php if (isset($alert_msg) and $alert_msg!="") { ?>  
    alertdismiss();
   <?php } ?>
  
  });
  
 
</script> 

 <div class="row">
     
     <?php echo form_open("login/reg","class='form-reg' style='margin: 5%;'"); ?>
     
        <h2 class="form-signin-heading"><?php echo $this->lang->line('reg'); ?></h2>
        <hr/>
        
  <div class="form-group">
    <label for="fio"><?php echo $this->lang->line('name'); ?></label>
    <input type="text" class="form-control" id="fio" name="fio" placeholder="<?php echo $this->lang->line('fio_primer'); ?>">
  </div>
  
  <div class="form-group">       
   <label for="type_of_partner"><?php echo $this->lang->line('type_partner'); ?></label>   
   <select class="form-control" id="type_of_partner" name="type_of_partner">
    <option value='' disabled selected><?=$this->lang->line('choose_type_of_partner');?></option>
    <?php 
     foreach ($types_of_partner as $k => $v) {
       echo "<option value='{$v['id']}'>{$v['title']}</option>";  
     }
    ?>
   </select>       
  </div>      
        
  <div class="checkbox">
    <label>
      <input type="checkbox" name="givetake[]" id="give" value="give" > <?php echo $this->lang->line('give_yes'); ?>
    </label>
      <br/>
    <label>
     <input type="checkbox" name="givetake[]" id="take" value="take" onchange=" $('#equip_div').toggle(); "> <?php echo $this->lang->line('take_yes'); ?>
    </label>
  </div>
       
  <div class="checkbox" id="equip_div" style="display:none;" >
    <label>
     <input type="checkbox" name="equip[]" id="ski" value="ski"> <?php echo $this->lang->line('ski'); ?>
    </label>
      <br/>
    <label>
      <input type="checkbox" name="equip[]" id="sb" value="sb"> <?php echo $this->lang->line('sb'); ?>
    </label>
  </div>
        
  <div class="form-group">
    <label for="tel"><?php echo $this->lang->line('tel'); ?></label>
    <input type="text" class="form-control" id="tel" name="tel" placeholder="<?php echo $this->lang->line('tel'); ?>">
  </div>      
        
  <div class="form-group">
    <label for="email"><?php echo $this->lang->line('email'); ?></label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
  </div>
  
   <div class="form-group">
    <label for="fio"><?php echo $this->lang->line('pass'); ?></label>
    <input type="password" class="form-control" id="pass" name="pass" placeholder="<?php echo $this->lang->line('pass'); ?>">
  </div>      
  <br/>      
  <button type="submit" id="butt_ok" name="butt_ok" class="btn btn-default" style="width:100%;">OK</button>
  
  <?php echo form_close(); ?>

  <div id="alerts" style="position: absolute; top:1%; right:1%;"><?php if (isset($alert_msg)) echo $alert_msg; ?></div>  
  
 </div>    
