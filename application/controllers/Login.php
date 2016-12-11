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
    
    
    function reg() {
        
     $userLang = $this->session->userdata('userLang');   
     $this->lang->load('orderform', $userLang);
        
     $pageData['page_title'] = $this->lang->line('reg');
   
     $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
     $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome" ) );
     $pageData['plug_css'] = $this->Data_forall->get_css( array("forall","login") );
     
     $pageData['types_of_partner'] = $this->Data_uni->uni_get_alldata_from_table("types_of_partners","");
       
     
     if (isset($_POST['butt_ok'])) {
         
       $this->load->library('form_validation');  
     
       $data = $this->Data_forall->get_all_date_from_post();
       
       $this->lang->load('myvalidation', $userLang);
       
       $alert_msg = $jq_html = "0";
       $jq_html_data_showing_order = "";
       
       $this->form_validation->set_rules('fio', $this->lang->line('name'), 'trim|required');
       $this->form_validation->set_rules('type_of_partner', $this->lang->line('type_partner'), 'required');
       $this->form_validation->set_rules('givetake[]', $this->lang->line('give_yes'), 'required');
       $this->form_validation->set_rules('equip[]', $this->lang->line('give_yes'), 'trim');
       $this->form_validation->set_rules('tel', $this->lang->line('tel'), 'trim|required');
       $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|valid_email|callback_remailself');
       $this->form_validation->set_rules('pass', $this->lang->line('pass'), 'trim|required|min_length[5]');

       if ($this->form_validation->run() == FALSE) { 
       
        $pageData['alert_msg'] = "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>×</span><strong>".$this->lang->line('error')."</strong>".validation_errors()."</div>";   
           
       } else {
          
           $data['givetake'] = implode(",", $data['givetake']);  
           if (isset($data['equip'])) { $data['equip'] = implode(",", $data['equip']); } 
           unset($data['localize']);
           $data['pass'] = md5($data['pass']);
           
           $pageData['id_partner'] = $this->Data_uni->uni_insert($data,"accounts");
           
       }
       
       
     }   
     
     $this->load->view('layouts/header',$pageData); 
     
      if (isset($pageData['id_partner']) and $pageData['id_partner']) {     
       $this->load->view('login/login_success_reg');
      } else {
       $this->load->view('login/login_reg');
      }
    
     $this->load->view('layouts/footer');    
        
    }
    
    function auth() {
     
     $userLang = $this->session->userdata('userLang');   
   
     $pageData['page_title'] = $this->lang->line('enter');
   
     $pageData['localize'] = $_POST['localize'] = $this->Data_uni->get_localize($userLang);
     
     $pageData['plug_components'] = $this->Data_forall->get_plug_components( array( "jquery","bootstrap","font_awesome" ) );
     $pageData['plug_css'] = $this->Data_forall->get_css( array("forall","login") );
     
     if (isset($_POST['butt_enter'])) {
         
       $login = $this->input->post('login');
       $pass = $this->input->post('pass');
       
       if (($login=="") OR ($pass=="")) {
          
        $pageData['log_value'] = $login;
        $pageData['pas_value'] = $pass;

       } else {
           
         $valid_login = $this->Data_login->vaild_login($login,$pass);  
         
         if ($valid_login == FALSE) {
          $pageData['error_msg'] = $this->lang->line('incorrectemaillogin');
          $pageData['log_value'] = $login;
        } else {
            
            if ($userLang == FALSE)  {               
             if ($this->session->userdata('userLang')!=null) {         
              $userLang = $this->session->userdata('userLang');             
             } else {         
              $userLang = BASELANG;      
             }
            }
            
            $data['id_partner'] = $valid_login;
            $data['userLang'] = $userLang;
            
            $this->Data_login->addtocookie($data);
            
            redirect("welcome", 'refresh');

            
        }
           
       }  
         
     }
     
     $this->load->view('layouts/header',$pageData); 
     $this->load->view('login/login_auth');  
     $this->load->view('layouts/footer');    
    }
    
    
    function remailself($email) {

      $email_chek = $this->Data_login->email_check_withself($email);

      if ($email_chek==FALSE) $this->form_validation->set_message('email', $this->lang->line('remailself'));

    return $email_chek;
   } 
   
   function exitout() {
       
      $array_items = array('id_partner', 'userlang');
     
      $this->session->unset_userdata($array_items);
      $this->session->sess_destroy();
       
      Header("Location: ".base_url()."login/auth");
      
   }
   
}
