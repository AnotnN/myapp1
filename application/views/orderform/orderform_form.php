
<?php if (!isset($order_feed)) {$order_feed = FALSE;}  ?>

<form id="OrderForm" method="post">   

    <input type="hidden" name="id_partner" id="id_partner" value="<?php echo $id_partner; ?>" />
    <input type="hidden" name="id_order" id="id_order" value="<?php echo $id_order; ?>" />
    <input type="hidden" name="status" id="status" value="<?php if (isset($order['status'])) { echo $order['status']; }else{echo 'vacant';}?>" />
    
  <div class="col-xs-12 col-sm-12" style="border:0;" >   
   <br/>  
   <table border="0" class="table-responsive" id="order_form_tab" style="border:0;width:100%;">    
    <tbody>
        <tr>
            <td>    
               <select id="id_resort" name="id_resort" class="form-control"  data-live-search="false" placeholder="Password"> >
                <?php if (!isset($order)) {  ?> <option value='' disabled selected><?=$this->lang->line('choose_resort');?></option> <?php } ?>
                <?php 
                 foreach ($resorts as $k => $v) {       
                   $selected = ""; if (isset($order['id_resort']) and $order['id_resort']==$v['id']) $selected="selected='selected'";
                   echo "<option $selected value='{$v['id']}' {$v['dis']}>{$v['title']}</option>";                       
                 } 
                ?>
               </select> 
               <div id="id_resort_messageContainer"></div>
            </td>
            <td style="width:40px;">
             <?php if ($order_feed==FALSE) { ?>   
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" style="border:0;"  data-content="<?php echo $this->lang->line('help_resort'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>  
             <?php } ?>    
            </td>
        </tr>
        <tr>
            <td>
             <div class="radio">
              <label class="radio-inline">
               <?php $checked = ""; if (isset($order['equip']) and $order['equip']=='ski') $checked = "checked='checked'";  ?>   
               <input type="radio" name="equip" id="ski" value="ski" <?php echo $checked; ?> /> 
               <?=$this->lang->line('ski');?>
              </label>
              <label class="radio-inline">
               <?php $checked = ""; if (isset($order['equip']) and $order['equip']=='sb') $checked = "checked='checked'";  ?>      
               <input type="radio" name="equip" id="sb" value="sb" <?php echo $checked; ?> /> 
               <?=$this->lang->line('sb');?>
              </label>
            </div>
             <div id="equip_messageContainer"></div>   
            </td>
            <td>
             <?php if ($order_feed==FALSE) { ?>      
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom"  style="border:0;" data-content="<?php echo $this->lang->line('help_equip'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>  
             <?php } ?>      
            </td>
        </tr>
        <tr>
            <td>
              <div class="form-inline">
               <label for="kolvo"><?=$this->lang->line('kolvo_peop');?>:</label>
               <input type="number" min="1" max="99" class="form-control" id="kolvo" name="kolvo" value="<?php if (isset($order['kolvo'])) {echo $order['kolvo'];} else {echo "1";}  ?>" style="width:70px; text-align: center; " >
              </div>   
              <div id="kolvo_messageContainer"></div>    
            </td>
            <td>
             <?php if ($order_feed==FALSE) { ?>       
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" style="border:0;"  data-content="<?php echo $this->lang->line('help_kolvo'); ?>">
               <i class="fa fa-question-circle"></i>
              </button>    
             <?php } ?>     
            </td>
        </tr>
        <tr>
            <td>
             <div class="checkbox">
              <label class="checkbox-inline">
               <?php $checked = ""; if (isset($order['adultchild']['adult'])) $checked = "checked='checked'";  ?>     
               <input type="checkbox" name="adultchild[]" id="adultchild[]" value="adult" <?php echo $checked; ?> /> 
               <?=$this->lang->line('adult');?>
              </label>
              <label class="checkbox-inline">
               <?php $checked = ""; if (isset($order['adultchild']['child'])) $checked = "checked='checked'";  ?>     
               <input type="checkbox" name="adultchild[]" id="adultchild[]" value="child" <?php echo $checked; ?> onchange="$('#child_age_div').toggle();" /> 
               <?=$this->lang->line('child');?>
              </label>
             </div>
             <div id="adultchild_messageContainer"></div>  
            </td>
            <td>
             <?php if ($order_feed==FALSE) { ?>   
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bootom" style="border:0;" data-content="<?php echo $this->lang->line('help_adult'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>    
             <?php } ?>    
            </td>
        </tr>
        <tr>
            <td style="">
             <div id="child_age_div" style="  <?php $checked = ""; if (isset($order['adultchild']['child'])) {}else{ echo "display: none;"; }  ?> ">   
              <label><?=$this->lang->line('age_child');?>:</label>  
              <div class="form-inline">
                <label for="age_child_from"><?=$this->lang->line('from');?></label>
                <select id="age_child_from" name="age_child_from" class="form-control"  data-live-search="false" >
                <?php
                  for($i=3;$i<=16;$i++) {
                   $selected = ""; if (isset($order['age_child_from']) and $order['age_child_from']==$i) $selected="selected='selected'";   
                   echo "<option value='$i' $selected>$i</option>";   
                  }
                ?>         
                </select>
                  
                <label for="age_child_to" style="margin-left: 10px"><?=$this->lang->line('to');?></label>
                <select id="age_child_to" name="age_child_to" class="form-control"  data-live-search="false" >
                <?php
                  for($i=3;$i<=16;$i++) {
                   $selected = ""; if (isset($order['age_child_to']) and $order['age_child_to']==$i) $selected="selected='selected'";      
                   echo "<option value='$i' $selected >$i</option>";   
                  }
                ?>         
                </select>
              </div> 
              </div>
            </td>
            <td></td>
        </tr>
        <!-- Дата и время первого занятия -->
        <tr>
         <td>
          <div class="form-group">   
          <label><?=$this->lang->line('fst_date_time');?>:</label>    
           <input type="text" value="<?php if (isset($order['date_time_format'])) {echo $order['date_time_format'];} ?>" readonly="readonly" style="background-color: #FFF;" class="form-control mydatetimepicker" id="date_time" name="date_time" data-date-format="dd.mm.yyyy HH:ii">          
          </div>
          <div id="date_time_messageContainer"></div>     
         </td>
         <td></td>  
        </tr> 
        <!-- Количество дней-->
        <tr>
         <td>
          <div class="form-inline">   
           <label><?=$this->lang->line('kolvo_days');?>:</label>    
           <input type="number" min="1" max="20" class="form-control" id="kolvo_days" name="kolvo_days" value="<?php if (isset($order['kolvo_days'])) {echo $order['kolvo_days'];} else {echo "1";}  ?>" style="width:70px; text-align: center; " >   
          </div>
          <div id="kolvo_days_messageContainer"></div>     
         </td>
         <td></td>  
        </tr>
        <!-- Сколько часов в день -->
        <tr>
         <td>
          <div class="form-inline">   
           <label><?=$this->lang->line('kolvo_hours_by_day');?>:</label>    
           <input type="number" min="1" max="12" class="form-control" id="hours_by_day" name="hours_by_day" value="<?php if (isset($order['hours_by_day'])) {echo $order['hours_by_day'];} else {echo "1";}  ?>" style="width:70px; text-align: center; " >   
          </div>
          <div id="hours_by_day_messageContainer"></div>     
         </td>
         <td></td>  
        </tr>
         <tr>
         <td>
          <div class="form-group">
           <label for="name"><?=$this->lang->line('your_name');?></label>
           <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($order['name'])) {echo $order['name'];} ?>" >
          </div>
          <div id="name_messageContainer"></div>     
         </td>
         <td></td>  
        </tr> 
        <tr>  
         <td>
          <div class="form-group">
           <label for="name"><?=$this->lang->line('tel');?></label>
           <input type="tel" class="form-control" id="tel" name="tel" value="<?php if (isset($order['tel'])) {echo $order['tel'];} ?>" >
          </div>
          <div id="tel_messageContainer"></div>     
         </td>
         <td></td>   
        </tr> 
        <tr>    
         <td>
          <?php if ($order_feed==FALSE) { ?>     
           <button class="btn btn-default butt_submit" id="butt_send_order" name="butt_send_order" type="submit" ><?=$this->lang->line('butt_send');?></button>          
          <?php } else { ?>
           <br/>
           <button class="btn btn-success butt_submit" id="butt_save_upd_order" name="butt_save_upd_order" type="submit" ><?=$this->lang->line('butt_save');?></button>           
          <?php } ?> 
         </td>  
         <td></td> 
        </tr>
    </tbody>
  </table>
  
  </div><!-- col1 --> 
     
 </form>


    <!-- Bootstrap form validator>-->
    <script src="http://localhost:8880/cprm-game.local/components/bootstrapvalidator/vendor/formvalidation/js/formValidation.min.js"></script>
    <!-- <script src='<?php echo base_url();?>/vendor/components/bootstrapvalidate/bootstrapValidator.min.js'></script>-->
    <script src="http://localhost:8880/cprm-game.local/components/bootstrapvalidator/vendor/formvalidation/js/bootstrap/bootstrap.min.js"></script>
    <script src="http://formvalidation.io/vendor/formvalidation/js/language/<?=$localize."_".strtoupper($localize);?>.js"></script>
    

<script type = "text/javascript">

$('#OrderForm').formValidation({
        
        framework: 'bootstrap',
        
        excluded: [':disabled'],
        
        locale: "<?=$localize."_".strtoupper($localize);?>",
        
        err: {
            container: function($field, validator) {
               var pref = $field.attr('name'); 
               
                if ($field.attr('name')=='adultchild[]') {pref = 'adultchild';}
             
               return $('#'+pref+'_messageContainer');
            }
        },
                
        button: {
         selector: '.butt_submit',
         disabled: ''
       },
        
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        
        fields: {
         
         id_resort: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_resort');?>'  
                    },
                    
                }
         },
         
         equip: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_equip');?>'  
                    },
                    
                }
         },
         
         kolvo: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_kolvo');?>'  
                    },
                    
                }
         },
         
         'adultchild[]': {
                 validators: {
                    choice: {
                      min: 1,
                      message: '<?=$this->lang->line('err_adult');?>'  
                    },
                    
                }
         },
         
         name: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_name');?>'  
                    },
                    
                }
         },
         
         tel: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_tel');?>'  
                    },
                    
                }
         },
         /*
         date_time: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_date_time');?>'  
                    },
                    
                }
         },*/
         
         kolvo_days: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_kolvo_days');?>'  
                    },
                    
                }
         },
         
         hours_by_day: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_kolvo_days');?>'  
                    },
                    
                }
         }
         
            
        }  
    }).on('success.form.fv', function(e) { 
     mysubmit();
     return false;
    });
    
</script>    