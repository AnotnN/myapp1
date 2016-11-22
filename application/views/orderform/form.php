<form id="OrderForm" method="post">   

    <input type="hidden" name="id_partner" id="id_partner" value="<?php echo $id_partner; ?>" />
    <input type="hidden" name="id_order" id="id_order" value="<?php echo $id_order; ?>" />
    
    
  <div class="col-xs-12 col-sm-12" style="border:0;" >   
   <br/>  
   <table border="0" class="table-responsive" id="order_form_tab" style="border:0;width:100%;">    
    <tbody>
        <tr>
            <td>    
               <select id="id_resort" name="id_resort" class="form-control"  data-live-search="false" placeholder="Password"> >
                 <option value='' disabled selected><?=$this->lang->line('choose_resort');?></option>
                <?php 
                 foreach ($resorts as $k => $v) {                   
                   echo "<option value='{$v['id']}' {$v['dis']}>{$v['title']}</option>";                       
                 } 
                ?>
               </select> 
               <div id="id_resort_messageContainer"></div>
            </td>
            <td style="width:40px;">
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" style="border:0;"  data-content="<?php echo $this->lang->line('help_resort'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>  
            </td>
        </tr>
        <tr>
            <td>
             <div class="radio">
              <label class="radio-inline">
               <input type="radio" name="equip" id="ski" value="ski" /> 
               <?=$this->lang->line('ski');?>
              </label>
              <label class="radio-inline">
               <input type="radio" name="equip" id="sb" value="sb" /> 
               <?=$this->lang->line('sb');?>
              </label>
            </div>
             <div id="equip_messageContainer"></div>   
            </td>
            <td>
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom"  style="border:0;" data-content="<?php echo $this->lang->line('help_equip'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>   
            </td>
        </tr>
        <tr>
            <td>
              <div class=" form-inline">
               <label for="kolvo"><?=$this->lang->line('kolvo_peop');?>:</label>
               <input type="number" min="1" max="99" class="form-control" id="kolvo" name="kolvo" value="1" style="width:70px; text-align: center; " >
              </div>   
              <div id="kolvo_messageContainer"></div>    
            </td>
            <td>
             <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" style="border:0;"  data-content="<?php echo $this->lang->line('help_kolvo'); ?>">
               <i class="fa fa-question-circle"></i>
             </button>     
            </td>
        </tr>
        <tr>
            <td>
             <div class="checkbox">
              <label class="checkbox-inline">
               <input type="checkbox" name="adultchild[]" id="adultchild[]" value="adult" /> 
               <?=$this->lang->line('adult');?>
              </label>
              <label class="checkbox-inline">
               <input type="checkbox" name="adultchild[]" id="adultchild[]" value="child" onchange="$('#child_age_div').toggle();" /> 
               <?=$this->lang->line('child');?>
              </label>
             </div>
             <div id="adultchild_messageContainer"></div>  
            </td>
            <td>
              <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bootom" style="border:0;" data-content="<?php echo $this->lang->line('help_adult'); ?>">
                 <i class="fa fa-question-circle"></i>
              </button>      
            </td>
        </tr>
        <tr>
            <td style="">
             <div id="child_age_div" style="display: none;">   
              <label><?=$this->lang->line('age_child');?>:</label>  
              <div class="form-inline">
                <label for="age_child_from"><?=$this->lang->line('from');?></label>
                <select id="age_child_from" name="age_child_from" class="form-control"  data-live-search="false" >
                <?php
                  for($i=3;$i<=16;$i++) {
                   echo "<option value='$i'>$i</option>";   
                  }
                ?>         
                </select>
                  
                <label for="age_child_to" style="margin-left: 10px"><?=$this->lang->line('to');?></label>
                <select id="age_child_to" name="age_child_to" class="form-control"  data-live-search="false" >
                <?php
                  for($i=3;$i<=16;$i++) {
                   echo "<option value='$i'>$i</option>";   
                  }
                ?>         
                </select>
              </div> 
              </div>
            </td>
            <td></td>
        </tr>
         <tr>
         <td>
          <div class="form-group">
           <label for="name"><?=$this->lang->line('your_name');?></label>
           <input type="text" class="form-control" id="name" name="name" >
          </div>
          <div id="name_messageContainer"></div>     
         </td>
         <td></td>  
        </tr> 
        <tr>  
         <td>
          <div class="form-group">
           <label for="name"><?=$this->lang->line('tel');?></label>
           <input type="tel" class="form-control" id="tel" name="tel" >
          </div>
          <div id="tel_messageContainer"></div>     
         </td>
         <td></td>   
        </tr> 
        <tr>    
         <td>
          <button class="btn btn-default" id="butt_send_order" name="butt_send_order" type="submit" ><?=$this->lang->line('butt_send');?></button>          
         </td>  
         <td></td> 
        </tr>
    </tbody>
  </table>
  
  </div><!-- col1 --> 
     
 </form>
     