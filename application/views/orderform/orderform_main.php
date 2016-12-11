

<style>
    
    #order_form_tab td {
      vertical-align: top; 
    }    
    
</style>    

<div class="row">
 
 <div id="order_form_div">  
 
    <?php echo $form; ?>
 
 </div>    
    
 <div id="succsess_div" style="display: none;"></div>   
    
</div>    
  


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
  
 $(function(){ 
    var date = new Date();
    date.setDate(date.getDate());
 
  $('.mydatetimepicker').datetimepicker({
     language:  '<?=$localize;?>',
     autoclose: 1,
     weekStart: 1,
     todayHighlight: 1,
     minView: 0,
     startDate: date
  });
 
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


<div id="alerts" style="position: absolute; top:1%; right:1%;"></div>  
  