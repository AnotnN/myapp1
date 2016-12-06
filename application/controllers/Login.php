<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {

  	parent::__construct();

         header("Content-Type: text/html; charset=UTF8");
  
         $this->load->helper(array('form', 'url'));
         $this->load->database();
         $this->load->library('session');
  
         $this->load->model('Data_forall', '', TRUE);
         $this->load->model('Data_uni', '', TRUE);
         $this->load->model('Data_login', '', TRUE);
         
         if (($this->session->userdata('userLang') != null)AND($this->session->userdata('userLang') != FALSE)) {   
          $userLang = $this->session->userdata('userLang');
         } else {
          $userLang = BASELANG;   
         }
         
         $this->lang->load('forall', $userLang);
         $this->lang->load('login', $userLang);
         $this->config->set_item('language', $userLang);
         
         ini_set('date.timezone', TIMEZONE);  
         setlocale(LC_ALL, "Russian_Russia.UTF8");
         
    }
    
    
    public function index() {
         
    }
    
    
    
    
    
}
