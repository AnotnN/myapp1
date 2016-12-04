<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderform extends CI_Controller {

    function __construct() {

  	parent::__construct();

         header("Content-Type: text/html; charset=UTF8");
  
         $this->load->helper(array('form', 'url'));
         $this->load->database();
         $this->load->library('session');
  
         $this->load->model('Data_forall', '', TRUE);
         $this->load->model('Data_uni', '', TRUE);
         $this->load->model('Data_orderform', '', TRUE);
         
         if (($this->session->userdata('userLang') != null)AND($this->session->userdata('userLang') != FALSE)) {   
          $userLang = $this->session->userdata('userLang');
         } else {
          $userLang = BASELANG;   
         }
         
         $this->lang->load('forall', $userLang);
         $this->lang->load('orderform', $userLang);
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
        
      $pageData['page_title'] = $this->lang->line('orderform_title_page');
      
      $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
      $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome","datetimepicker" ) );
      $pageData['plug_css'] = $this->Data_forall->get_css( array("forall","orderform") );
      
      $pageData['id_partner'] = 1;
      
      $pageData['resorts'] = $this->Data_uni->uni_get_alldata_from_table("resorts","");
      
      $pageData['id_order'] = '';
      
      $pageData['form'] = $this->load->view('orderform/orderform_form',$pageData,TRUE);  
      
      //$pageData['order'] = $this->Data_orderform->get_order(22);
      
      $this->load->view('layouts/header',$pageData); 
      
      //$this->load->view('orderform/success');
      
      $this->load->view('orderform/orderform_main');
      $this->load->view('layouts/footer');  
      
    }
    
    function del_jqOrder($userLang) {
        
      $jq_html = "0";  
        
      if ($this->input->post('id_order')) {
       
       $jq_html = $this->Data_uni->uni_delete_by_field("orders","id",$this->input->post('id_order'));  
          
      }  
      
      if ($jq_html=="0" or $jq_html==FALSE) $response['jq_alert_msg'] = "".$this->input->post('dontdeleting'); 
      
      $response['jq_html'] = "$jq_html"; 
      
      echo json_encode($response);     
    }
    
    function add_jqOrder($userLang) {
        
        
       $this->load->library('form_validation');  
     
       $data = $this->Data_forall->get_all_date_from_post();
       
       $this->lang->load('myvalidation', $userLang);
       
       $alert_msg = $jq_html = "0";
       $jq_html_data_showing_order = "";
       
       $this->form_validation->set_rules('id_partner', '', 'integer|required');
       $this->form_validation->set_rules('id_resort', $this->lang->line('id_resort'), 'required');
       $this->form_validation->set_rules('equip', $this->lang->line('equip'), 'required');
       $this->form_validation->set_rules('kolvo', $this->lang->line('kolvo'), 'integer|required');
       $this->form_validation->set_rules('adultchild[]', $this->lang->line('adultchild'), 'required');
       $this->form_validation->set_rules('age_child_from', $this->lang->line('from'), 'trim');
       $this->form_validation->set_rules('age_child_to', $this->lang->line('to'), 'trim');
       $this->form_validation->set_rules('name', $this->lang->line('your_name'), 'trim|required');
       $this->form_validation->set_rules('tel', $this->lang->line('tel'), 'trim|min_length[10]|required');       
       $this->form_validation->set_rules('date_time', $this->lang->line('fst_date_time'), 'regex_match[/(\d{2}).(\d{2}).(\d{4}) (\d{2}):(\d{2})/]');
       $this->form_validation->set_rules('kolvo_days', $this->lang->line('kolvo_days'), 'integer|required');
       $this->form_validation->set_rules('hours_by_day', $this->lang->line('kolvo_hours_by_day'), 'integer|required');

       if ($this->form_validation->run() == FALSE) { 
       
        $alert_msg = "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>×</span><strong>".$this->lang->line('error')."</strong>".validation_errors()."</div>";   
           
       } else {
         
        $data['adultchild'] = implode(",", $data['adultchild']);   
        $data['date_time'] = $this->Data_uni->YearToDay($data['date_time']);
        $data['id_partner_give'] = $data['id_partner']; 
        unset($data['id_partner']);
        $data['id_partner_take'] = 0; 
           
        //INSERT или UPDATE
        if ((isset($data['id_order']) and $data['id_order']=='')or(isset($data['id_order']) and $data['id_order']==0)) unset($data['id_order']);
        
        if (isset($data['id_order'])) {
         
          $pageData['id_order'] = $data['id_order']; 
          unset($data['id_order']);
          
          unset($data['id_partner_take']);
          
          $this->Data_uni->uni_update_arr($data,"orders","id",$pageData['id_order']);
          //$this->Data_orderform->update_order($data,$pageData['id_order']);
          
          //Карточка для акцепта заказа со стороны инструктора
          if ($data['status']=="in_operation_step1") {
           $pageData['order'] = $this->Data_orderform->get_order($pageData['id_order']);
           $pageData['no_buttons'] = TRUE;
           $jq_html_data_showing_order = $this->load->view('feed/feed_success_pickup',$pageData,TRUE);    
          }
          
        } else {
           
         $data['data_born'] = date("Y-m-d H:i:s"); 
            
         $pageData['id_order'] = $this->Data_uni->uni_insert($data,"orders");
         
        /* if ($pageData['id_order']) {
             
          $param = array(
             "id_order"=>$pageData['id_order']
          );
         
          $pageData['id_feed'] = $this->Data_uni->uni_insert($data,"feed");
          
         } */
        
        } 
         
        $pageData['order'] = $this->Data_orderform->get_order($pageData['id_order']);
      
        $jq_html = $this->load->view('orderform/orderform_success',$pageData,TRUE);
       }
       
      $response['jq_html'] = "$jq_html"; 
      $response['jq_html_data_showing_order'] = "$jq_html_data_showing_order";
      $response['jq_alert_msg'] = "$alert_msg"; 

      echo json_encode($response);  
    }
    
}
