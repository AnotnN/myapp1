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
      
      $pageData['localize'] = $this->Data_uni->get_localize($userLang);
      
      $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome"/*,"bootstrapvalidate"*/ ) );
      
      $pageData['resorts'] = $this->Data_uni->uni_get_alldata_from_table("resorts","");
      
      $this->load->view('layouts/header',$pageData);  
      $this->load->view('orderform/main');
      $this->load->view('layouts/footer');  
      
    }
}
