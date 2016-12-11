<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myorders extends CI_Controller {

    function __construct() {

  	parent::__construct();

         header("Content-Type: text/html; charset=UTF8");
  
         $this->load->helper(array('form', 'url'));
         $this->load->database();
         $this->load->library('session');
  
         $this->load->model('Data_forall', '', TRUE);
         $this->load->model('Data_uni', '', TRUE);
         $this->load->model('Data_myorders', '', TRUE);
         
         if (($this->session->userdata('userLang') != null)AND($this->session->userdata('userLang') != FALSE)) {   
          $userLang = $this->session->userdata('userLang');
         } else {
          $this->session->set_userdata('userLang', BASELANG);
         }
         
         $this->lang->load('forall', $userLang);
         $this->lang->load('myorders', $userLang);
         $this->config->set_item('language', $userLang);
         
         ini_set('date.timezone', TIMEZONE);  
         setlocale(LC_ALL, "Russian_Russia.UTF8");
         
    }
    
    function take() {
      
     $takegive = "take";   
        
     $userLang = $this->session->userdata('userLang');   
        
     $pageData['page_title'] = $this->lang->line('myorders_title_page');
   
     $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
     $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome" ) );
     $pageData['plug_css'] = $this->Data_forall->get_css( array("forall","myorders") );
     
     $this->lang->load('feed', $userLang);
     $this->lang->load('orderform', $userLang);
     
     $pageData['takegive'] = "$takegive";
     
     $pageData['id_partner'] = $this->session->userdata('id_partner');
         
     $pageData['orders'] = $this->Data_myorders->get_myorders_take($pageData['id_partner']);   
     
     $this->load->view('layouts/header',$pageData); 
     $this->load->view('myorders/myorders_main');
     $this->load->view('layouts/footer');    
        
    }
    
    function give() {
      
     $takegive = "give";   
        
     $userLang = $this->session->userdata('userLang');   
        
     $pageData['page_title'] = $this->lang->line('myorders_title_page');
   
     $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
     $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome" ) );
     $pageData['plug_css'] = $this->Data_forall->get_css( array("forall","myorders") );
     
     $this->lang->load('feed', $userLang);
     $this->lang->load('orderform', $userLang);
     
     $pageData['takegive'] = "$takegive";
     
     $pageData['id_partner'] = $this->session->userdata('id_partner'); 
         
     $pageData['orders'] = $this->Data_myorders->get_myorders_give($pageData['id_partner']);   
     
     $this->load->view('layouts/header',$pageData); 
     $this->load->view('myorders/myorders_main');
     $this->load->view('layouts/footer');    
        
    }


    public function index() {
        
     
    }
    
    function order_delete() {
        
      $jq_html = "0";  
      $flag = FALSE;
      $alert_msg = "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>×</span><strong>".$this->lang->line('deleted_failed')."</strong></div>";     
      
      
      if ($this->input->post('id_order')) {
      
        $status = $arr = $this->Data_uni->uni_get_value_by_field("status","orders","id",$this->input->post('id_order'));

       if ($status=='vacant') {   
           
        $data['status'] = "deleted";
          
        $flag = $this->Data_uni->uni_update_arr($data,"orders","id",$this->input->post('id_order'));
        
       } else {
           
        $alert_msg = "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>×</span><strong>".$this->lang->line('delete_denied')."</strong></div>"; 
        
       }
       
      }  
      
      if ($flag!=FALSE) {           
       $jq_html = "1";
      }
      
      $response['jq_html'] = "$jq_html"; 
      $response['jq_alert_msg'] = "$alert_msg"; 
      
      echo json_encode($response);    
    }
    
    function order_complete() {
        
      $userLang = $this->session->userdata('userLang');
      
      $jq_html = "0";  
      $flag = FALSE;  
      $alert_msg = "";
      
      $cena_dop_day = 100;
      
     if ($this->input->post('id_order') and $this->input->post('cena')) {
      
      $this->load->model('Data_orderform', '', TRUE);
      
      $order = $this->Data_orderform->get_order($this->input->post('id_order'));
      
      $this->load->library('form_validation');  
     
      $this->lang->load('myvalidation', $userLang);
     
      $this->form_validation->set_rules('cena', $this->lang->line('cena'), 'integer|min_length[3]|required');
      
      if ($this->form_validation->run() == FALSE) { 
       
        $alert_msg = "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>×</span><strong>".$this->lang->line('error')."</strong>".validation_errors()."</div>";   
           
       } else {
          
         $itogo = ($order['hours_by_day']*$order['kolvo']*$this->input->post('cena'))/100*13;   
         if ($order['kolvo_days']>1) { $itogo += ($order['kolvo_days']-1)*$cena_dop_day; }
         $itogo = round($itogo);
         
         $data['status'] = "complete";
         $data['credit'] = $itogo;
         
         $this->Data_uni->uni_update_arr($data,"orders","id",$this->input->post('id_order'));
          
         $jq_html = "1";   
           
       }
         
     }
     
     $response['jq_html'] = "$jq_html"; 
     $response['jq_alert_msg'] = $alert_msg;
      
     echo json_encode($response); 
        
    }
    
    function order_update() {
        
      $userLang = $this->session->userdata('userLang');
      
      $jq_html = "0";  
      $flag = FALSE;  
      
      $this->lang->load('feed', $userLang);
            
     if ($this->input->post('id_order')) {
         
      $this->lang->load('orderform', $userLang);
      $this->load->model('Data_orderform', '', TRUE);
             
      $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
      $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome","datetimepicker" ) );
      $pageData['plug_css'] = $this->Data_forall->get_css( array("forall","orderform") );
      
      $pageData['id_partner'] = $this->session->userdata('id_partner');
      
      $pageData['resorts'] = $this->Data_uni->uni_get_alldata_from_table("resorts","");
      
      $pageData['order'] = $this->Data_orderform->get_order($this->input->post('id_order'));
      
      $pageData['id_order'] = $this->input->post('id_order');
      
      $pageData['order_feed'] = TRUE;
      
      $jq_html = $this->load->view('orderform/orderform_form',$pageData,TRUE);  
      
         
     }
     
     $response['jq_html'] = "$jq_html"; 
      
     echo json_encode($response); 
        
    }
    
    
}
