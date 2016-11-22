
<!-- Bootstrap form validator>-->
    <script src="http://localhost:8880/cprm-game.local/components/bootstrapvalidator/vendor/formvalidation/js/formValidation.min.js"></script>
   <!-- <script src='<?php echo base_url();?>/vendor/components/bootstrapvalidate/bootstrapValidator.min.js'></script>-->
    <script src="http://localhost:8880/cprm-game.local/components/bootstrapvalidator/vendor/formvalidation/js/bootstrap/bootstrap.min.js"></script>
    <script src="http://formvalidation.io/vendor/formvalidation/js/language/<?=$localize."_".strtoupper($localize);?>.js"></script>
    

<style>
    
    #order_form_tab td {
      vertical-align: top; 
    }    
    
</style>    

<div class="container-fluid">
<div class="row">
 
 <div id="order_form_div">  
 
    <?php echo $form; ?>
 
 </div>    
    
 <div id="succsess_div" style="display: none;"></div>   
    
</div>    
</div>    


<script type = "text/javascript">
 
  $(document).ready(function() {   
     
   <?php if (isset($alert_msg) and $alert_msg!="") { ?>  
    alertdismiss();
   <?php } ?>
  
  });
  
  
 
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
 
   function myalert(txt) {
   
    $("#alerts").html(txt);
    alertdismiss();  
   
   }
   function alertdismiss() {   
    $(".alert").fadeTo(5000, 500).fadeOut(1000, function(){
     $(".alert").alert('close');
    });
   }

   
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
         selector: '#butt_send_order',
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
         }
            
        }  
    }).on('success.form.fv', function(e) { 
     mysubmit();
     return false;
    });
  
    function mysubmit() {
   
     $.post( "<?php echo base_url();?>orderform/add_jqOrder", $('#OrderForm').serialize(), 
                                  
        function(json) { 
                                  
          if (json.jq_html!="0") {
                                    
             $("#order_form_div").hide();
             $("#succsess_div").show();
             $("#succsess_div").html(json.jq_html);
             
                                    
           } else {
               
            myalert(json.jq_alert_msg);   
           }
                                 
         return false;
         
        }, "json"); 
                
    
       
     return false;
    }
   
</script>

<div id="alerts"><?php if (isset($alert_msg)) echo $alert_msg;?></div>