<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {

  	parent::__construct();

         header("Content-Type: text/html; charset=UTF8");
  
         $this->load->helper(array('form', 'url'));
         $this->load->database();
         $this->load->library('session');
  
         $this->load->model('Data_forall', '', TRUE);
         $this->load->model('Data_uni', '', TRUE);
         
         if (($this->session->userdata('userLang') != null)AND($this->session->userdata('userLang') != FALSE)) {   
          $userLang = $this->session->userdata('userLang');
         } else {
          $userLang = BASELANG;   
         } 
         
         ini_set('date.timezone', TIMEZONE);  
         setlocale(LC_ALL, "Russian_Russia.UTF8");
         
    }
	
    public function index() {
     
      if (!$this->session->userdata('id_partner')) { 
          
       redirect("login/auth");
      
      } else {
          
       $partner = $this->Data_forall->get_partner();
       
       if ($partner['take']==0 or !$partner['take']) redirect("myorders/give");
       if ($partner['take']!=0) redirect("feed");
          
      }
        
      if (($this->session->userdata('userLang') != null)AND($this->session->userdata('userLang') != FALSE)) {   
          $userLang = $this->session->userdata('userLang');
         } else {
          $userLang = BASELANG;   
         }
         
      $pageData['page_title'] = "Hello world";  
      $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
      $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome" ) );
      
      $this->load->view('layouts/header',$pageData);  
      $this->load->view('welcome_message');
      $this->load->view('layouts/footer');  
      
    }
}
