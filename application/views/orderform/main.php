
<!-- Bootstrap form validator>-->
    <script src="http://localhost:8880/cprm-game.local/components/bootstrapvalidator/vendor/formvalidation/js/formValidation.min.js"></script>
    <script src="http://localhost:8880/cprm-game.local/components/bootstrapvalidator/vendor/formvalidation/js/bootstrap/bootstrap.min.js"></script>
    <script src="http://formvalidation.io/vendor/formvalidation/js/language/<?=$localize."_".strtoupper($localize);?>.js"></script>
    

<style>
    
    #order_form_tab td {
      vertical-align: middle;  
    }    
    
</style>    

<div class="container-fluid">
<div class="row">
 
 <form id="OrderForm" method="post">   

  <div class="col-xs-12 col-sm-4" >   
     
   <table border="0" class="table-responsive" id="order_form_tab" style="width:100%;">    
    <tbody>
        <tr>
            <td style="width:40px;">
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" style="border:0;"  data-content="<?php echo $this->lang->line('help_resort'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>  
            </td>
            <td>    
               <select id="resort" name="resort" class="form-control"  data-live-search="false" placeholder="Password"> >
                 <option value='' disabled selected><?=$this->lang->line('choose_resort');?></option>
                <?php 
                 foreach ($resorts as $k => $v) {                   
                   echo "<option value='{$v['id']}' {$v['dis']}>{$v['title']}</option>";                       
                 } 
                ?>
               </select> 
               <div id="resort_messageContainer"></div>
            </td>
        </tr>
        <tr>
            <td>
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom"  style="border:0;" data-content="<?php echo $this->lang->line('help_equip'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>   
            </td>
            <td>
             <div class="radio">
              <label class="radio-inline">
               <input type="radio" name="equip" id="equip_ski" value="ski" /> 
               <?=$this->lang->line('ski');?>
              </label>
              <label class="radio-inline">
               <input type="radio" name="equip" id="equip_sb" value="sb" /> 
               <?=$this->lang->line('snowboard');?>
              </label>
            </div>
             <div id="equip_messageContainer"></div>   
            </td>
        </tr>
        <tr>
            <td>
             <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" style="border:0;"  data-content="<?php echo $this->lang->line('help_kolvo'); ?>">
               <i class="fa fa-question-circle"></i>
             </button>     
            </td>
            <td>
              <div class=" form-inline">
               <label for="kolvo"><?=$this->lang->line('kolvo_peop');?>:</label>
               <input type="number" min="1" max="99" class="form-control" id="kolvo" name="kolvo" value="1" style="width:70px; text-align: center; " >
              </div>   
              <div id="kolvo_messageContainer"></div>    
            </td>
        </tr>
        <tr>
            <td>
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bootom" style="border:0;" data-content="<?php echo $this->lang->line('help_adult'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>      
            </td>
            <td>
             <div class="checkbox">
              <label class="checkbox-inline">
               <input type="checkbox" name="adult" id="adult" value="adult" /> 
               <?=$this->lang->line('adult');?>
              </label>
              <label class="checkbox-inline">
               <input type="checkbox" name="adult" id="adult" value="child" onchange="$('#child_age_div').toggle();" /> 
               <?=$this->lang->line('child');?>
              </label>
             </div>
             <div id="adult_messageContainer"></div>  
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="height:75px;">
             <div id="child_age_div" style="display: none;">   
              <label><?=$this->lang->line('age_child');?>:</label>  
              <div class="form-inline">
                <label for="age_child_ot"><?=$this->lang->line('from');?></label>
                <select id="age_child_ot" name="age_child_ot" class="form-control"  data-live-search="false" >
                <?php
                  for($i=3;$i<=16;$i++) {
                   echo "<option value='$i'>$i</option>";   
                  }
                ?>         
                </select>
                  
                <label for="age_child_do" style="margin-left: 10px"><?=$this->lang->line('to');?></label>
                <select id="age_child_do" name="age_child_do" class="form-control"  data-live-search="false" >
                <?php
                  for($i=3;$i<=16;$i++) {
                   echo "<option value='$i'>$i</option>";   
                  }
                ?>         
                </select>
              </div> 
              </div>
            </td>
        </tr>
    </tbody>
  </table>
  
  </div><!-- col1 --> 
  
  <div class="col-xs-12 col-sm-8" >   
 
   <table border="0" class="table-responsive" id="order_form_tab">    
    <tbody>      
        <tr>
         <td>
          <div class="form-group">
           <label for="name"><?=$this->lang->line('your_name');?></label>
           <input type="text" class="form-control" id="name" name="name" >
          </div>
          <div id="name_messageContainer"></div>     
         </td>
        </tr> 
        <tr>
         <td>
          <div class="form-group">
           <label for="name"><?=$this->lang->line('tel');?></label>
           <input type="tel" class="form-control" id="tel" name="tel" >
          </div>
          <div id="tel_messageContainer"></div>     
         </td>
        </tr> 
        <tr>
         <td colspan="2">
          <button class="btn btn-default" id="butt_send_order" name="butt_send_order" type="submit" ><?=$this->lang->line('butt_send');?></button>          
         </td>  
        </tr>
    </tbody>
   </table>
      
  </div><!-- col2 --> 
     
 </form>    
     
</div>    
</div>    


<script type = "text/javascript">
    
 $(function () {
  $('[data-toggle="popover"]').popover();
 });
 
 $(document).on('click', function (e) {
    $('[data-toggle="popover"],[data-original-title]').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 ) {                
            (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  
        }

    });
 });

 
    $('#OrderForm').formValidation({
        
        framework: 'bootstrap',
        
        excluded: [':disabled'],
        
        locale: "<?=$localize."_".strtoupper($localize);?>",
        
        err: {
            container: function($field, validator) {
                return $('#'+$field.attr('name')+'_messageContainer');
            }
        },
                
        button: {
         selector: '#butt_send_order',
         disabled: ''
       },
        
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        
        fields: {
         
         resort: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_resort');?>'  
                    },
                    
                }
         },
         
         equip: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_resort');?>'  
                    },
                    
                }
         },
         
         kolvo: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_resort');?>'  
                    },
                    
                }
         },
         
         adult: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_resort');?>'  
                    },
                    
                }
         },
         
         name: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_resort');?>'  
                    },
                    
                }
         },
         
         tel: {
                validators: {
                    notEmpty: { 
                      message: '<?=$this->lang->line('err_resort');?>'  
                    },
                    
                }
         }
            
        }  
    }).on('success.form.fv', function(e) { 
     
    });
  
</script>

