<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

    function __construct() {

  	parent::__construct();

         header("Content-Type: text/html; charset=UTF8");
  
         $this->load->helper(array('form', 'url'));
         $this->load->database();
         $this->load->library('session');
  
         $this->load->model('Data_forall', '', TRUE);
         $this->load->model('Data_uni', '', TRUE);
         $this->load->model('Data_feed', '', TRUE);
         
         if (($this->session->userdata('userLang') != null)AND($this->session->userdata('userLang') != FALSE)) {   
          $userLang = $this->session->userdata('userLang');
         } else {
          $userLang = BASELANG;   
         }
         
         $this->lang->load('forall', $userLang);
         $this->lang->load('feed', $userLang);
         $this->config->set_item('language', $userLang);
         
         ini_set('date.timezone', TIMEZONE);  
         setlocale(LC_ALL, "Russian_Russia.UTF8");
         
    }
    
    function _remap($method) {
 
   
     $allowedPages = array();

     $pars = $this->uri->segment_array();
 
      unset($pars[1]);
      unset($pars[2]);
     
      if (($this->session->userdata('userLang') != null)AND($this->session->userdata('userLang') != FALSE)) {   
          $userLang = $this->session->userdata('userLang');
         } else {
          $userLang = BASELANG;   
         }
         
      array_push($pars,$userLang);
        
      if ($method!='css') call_user_func_array(array($this, $method), $pars);
    
    }
	
    public function index($userLang) {
        
     $this->lang->load('orderform', $userLang);
     
     
     $pageData['page_title'] = $this->lang->line('feed_title_page');
   
     $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
     $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome" ) );
     $pageData['plug_css'] = $this->Data_forall->get_css( array("forall","feed") );
     
     
     $pageData['orders'] = $this->Data_feed->get_orders_by_feed();   
     
     $pageData['id_partner'] = 2;
        
     $this->load->view('layouts/header',$pageData); 
     $this->load->view('feed/feed_main');
     $this->load->view('layouts/footer');  
    }
    
    
    function pickup_jqOrder($userLang) {
      
      $jq_html = "0";  
      $flag = FALSE;
      
      if ($this->input->post('id_order') and $this->input->post('id_partner')) {
      
       $data['status'] = "in_operation_step1";
       $data['id_partner_take'] = $this->input->post('id_partner');
          
       $flag = $this->Data_uni->uni_update_arr($data,"orders","id",$this->input->post('id_order'));
       
      }  
      
      if ($flag!=FALSE) { 
          
       $this->lang->load('orderform', $userLang);
       $this->load->model('Data_orderform', '', TRUE);
       
       $pageData['order'] = $this->Data_orderform->get_order($this->input->post('id_order'));
         
       $jq_html = $this->load->view('feed/feed_success_pickup',$pageData,TRUE);
      }
      
      $response['jq_html'] = "$jq_html"; 
      
      echo json_encode($response);     
    }
    
    function order_accept() {
      
      $jq_html = "0";  
      $flag = FALSE;
      
      if ($this->input->post('id_order')) {
      
       $data['status'] = "in_operation_step2";
          
       $flag = $this->Data_uni->uni_update_arr($data,"orders","id",$this->input->post('id_order'));
       
      }  
      
      if ($flag!=FALSE) { 
          
       $jq_html = "1";
      }
      
      $response['jq_html'] = "$jq_html"; 
      
      echo json_encode($response);     
    }
    
    function order_disallow($userLang) {
      
      $jq_html = "0";  
      $flag = FALSE;
      
      if ($this->input->post('id_order') and $this->input->post('id_partner')) {
      
       $data['status'] = "vacant";
       $data['id_partner_take'] = 0;
          
       $flag = $this->Data_uni->uni_update_arr($data,"orders","id",$this->input->post('id_order'));
       
      }  
      
      if ($flag!=FALSE) { 
          
       $jq_html = "1";
      }
      
      $response['jq_html'] = "$jq_html"; 
      
      echo json_encode($response);     
    }
    
    function feed_step2_order_update($userLang) {
        
      $jq_html = "0";  
      $flag = FALSE;  
      
      $this->lang->load('feed', $userLang);
            
     if ($this->input->post('id_order') and $this->input->post('id_partner')) {
         
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
