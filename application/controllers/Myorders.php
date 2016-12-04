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
    
    function main($takegive) {
      
     $userLang = $this->session->userdata('userLang');   
        
     $pageData['page_title'] = $this->lang->line('myorders_title_page');
   
     $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
     $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome" ) );
     $pageData['plug_css'] = $this->Data_forall->get_css( array("forall","myorders") );
     
     $this->lang->load('feed', $userLang);
     $this->lang->load('orderform', $userLang);
     
     $pageData['id_partner'] = 2;
         
     $pageData['orders'] = $this->Data_myorders->get_myorders($takegive,$pageData['id_partner']);   
     
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
      
      $pageData['id_partner'] = 1;
      
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
