<?php
class Data_forall extends CI_Model {


function get_plug_components($param) {
    
 $str = "";   
 
 $arr = array(
     
     "jquery"=>"<script src='".base_url()."/vendor/components/jquery/jquery.min.js'></script>",
     "jqueryui"=>"<script src='".base_url()."/vendor/components/jqueryui/jquery-ui.js'></script><link rel='stylesheet' href='".base_url()."/vendor/components/jqueryui/base/jquery-ui.min.css'>",
     "bootstrap"=>"<script type='text/javascript' src='".base_url()."/vendor/components/bootstrap/js/bootstrap.min.js'></script><link rel='stylesheet' href='".base_url()."/vendor/components/bootstrap/css/bootstrap.min.css'>",
     "font_awesome"=>"<link rel='stylesheet' href='".base_url()."/vendor/components/font-awesome/css/font-awesome.min.css'>",
     "bootstrapvalidate"=>"<script src='".base_url()."/vendor/components/bootstrapvalidate/bootstrapValidator.min.js'></script>",
     "datetimepicker"=>"<script src='".base_url()."/vendor/components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js' charset='UTF-8' ></script><script src='".base_url()."/vendor/components/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.".$_POST['localize'].".js' charset='UTF-8' ></script><link rel='stylesheet' href='".base_url()."/vendor/components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'>"
     
     );
 
 foreach ($param as $k => $v) {
  
   if (isset($arr[$v]))  $str .= $arr[$v]; 
     
 }
    
 return $str;   
}

function get_css($param) {
    
 $str = "";   
 
    $arr = array(
     
     "forall"=>"<link rel='stylesheet' href='".base_url()."/css/forall.css'>",
     "orderform"=>"<link rel='stylesheet' href='".base_url()."/css/orderform.css'>",
     "feed"=>"<link rel='stylesheet' href='".base_url()."/css/feed.css'>",
     "myorders"=>"<link rel='stylesheet' href='".base_url()."/css/myorders.css'>"
    );
 
 foreach ($param as $k => $v) {
  
   if (isset($arr[$v]))  $str .= $arr[$v]; 
     
 }
    
 return $str;   
}


function get_all_date_from_post() {
    
 $arr = array();   
 
 foreach ($_POST as $k => $v) {
   
  if ($this->input->post("$k", TRUE)) {$arr["$k"] = $this->input->post("$k");}
     
 }
      
    
 if (count($arr)) { return $arr; }else{ return FALSE; }   
}


function get_adultchild_title($order) {
    
 $str = "";
 
 $order['adultchild'] = array_flip(explode(",", $order['adultchild'] ));
 $order['adultchild_title'] = "";
    
  if (isset($order['adultchild']['adult'])) { 
     $order['adultchild']['adult'] = 1; 
     $order['adultchild_title'] .= $this->lang->line('adult');     
  }
  if (isset($order['adultchild']['child'])) { 
      
      $order['adultchild']['child'] = 1; 
      if ($order['adultchild_title']!="") $order['adultchild_title'].=" ".$this->lang->line('and')." "; 
      $order['adultchild_title'] .= $this->lang->line('child'); 
      
  }
 
 $str = $order['adultchild_title'];
 
 return $str;   
}

 function adultchild_to_array($arr){
       
    $arr['adultchild'] = array_flip(explode(",", $arr['adultchild'] ));
    $arr['adultchild_title'] = "";
    
     if (isset($arr['adultchild']['adult'])) { 
        
        $arr['adultchild']['adult'] = 1; 
        $arr['adultchild_title'] .= $this->lang->line('adult');
        
     }
     if (isset($arr['adultchild']['child'])) { 
        $arr['adultchild']['child'] = 1; 
        if ($arr['adultchild_title']!="") $arr['adultchild_title'].=" ".$this->lang->line('and')." "; 
        $arr['adultchild_title'] .= $this->lang->line('child'); 
     }
    
   return $arr;
  }
  
  function get_partner() {
    
   $arr = array();
   
   if ($this->session->userdata('id_partner')) { 
       
     $id_partner = $this->session->userdata('id_partner');
   
     $query = $this->db->query(""
             . "SELECT "
              . "accounts.fio as fio,"
              . "accounts.type_of_partner as type_of_partner,"
              . "accounts.tel as tel,"
              . "accounts.email as email,"
              . "FIND_IN_SET ('give',accounts.givetake) as give,"
              . "FIND_IN_SET ('take',accounts.givetake) as take,"
              . "FIND_IN_SET ('ski',accounts.equip) as ski,"
              . "FIND_IN_SET ('sb',accounts.equip) as sb"
             ." FROM accounts WHERE (id='$id_partner')"
             . ";");
     
        if ($query) {

            $row = $query->result_array();
            if ($row[0]) { 
                 
                $arr = $row[0];

            }
            
        }
     
   }
   
   
   
   return $arr;   
  }

  
  function send_pismo($ot_kogo,$to,$tema,$telo) {

   /* 
      
  $header = "MIME-Version: 1.0\r\n"; 
  $header .= "Content-Type: text/html; charset=utf-8\r\n"; 
  $header .= "From: INOKON.ru <info@inokon.ru>\r\n"; 
  $header .= "Reply-to: info@inokon.ru\r\n"; 

  mail($to,$tema,$telo,$header);  

 
 /*
        
 // соединяемся с сервером $smtp_host на порт $smtp_port 
$smtp_msg = "";        
$smtp_host = "smtp.mail.ru";
$smtp_port = "25";
$localhost = "localhost";
$smtp_user = "robot_inokon@mail.ru";
$smtp_pass = "ktjyfhlj1";

$from = "inokon@inbox.ru";

$data = "Content-type: text/html; charset=utf-8 \r\nSubject: $tema\r\n\r\n".$telo;

$smtp_socket = fsockopen($smtp_host, $smtp_port) or die ('Не могу соединиться');   
while ($line = fgets($smtp_socket, 515)) { 
$smtp_msg .= $line; 
  if (substr($line, 3, 1) == " ") break; 
}     
// приняли ответ сервера, если он начинается на 220 - значит всё ок, сервер работает 
$answer = substr($smtp_msg, 0, 3);
//if($answer != '220') die ("1");  
// посылаем серверу приветствие и свой адрес 
$answer = $this->smtp_send_cmd($smtp_socket, 'HELO '.$localhost);   
//if($answer != '250') die ("2"); 
// если всё ок, скажем серверу что хотим авторизоваться 
$answer = $this->smtp_send_cmd($smtp_socket, 'AUTH LOGIN');    
//if($answer != '334') die ("3");       
// если сервер работает через smtp авторизацию на исходящие, посылаем ему логин от ящика $smtp_user 
$answer = $this->smtp_send_cmd($smtp_socket, base64_encode($smtp_user));  
//if($answer != '334') die ("login"); 
// и пароль $smtp_pass 
$answer = $this->smtp_send_cmd($smtp_socket, base64_encode($smtp_pass));  
//if($answer != '235') die ("pass"); 
// говорим от кого 
$answer = $this->smtp_send_cmd($smtp_socket, 'MAIL FROM:'.$from);  
//if($answer != '250') die ("from"); 
// и кому посылаем 
$answer = $this->smtp_send_cmd($smtp_socket, 'RCPT TO:'.$to);  
//if($answer != '250') die ("to"); 
// сообщаем, что начинаем вводить данные: 
$answer = $this->smtp_send_cmd($smtp_socket, "DATA"); 
//if($answer != '354') die ("DATA"); 
// собственно сам процесс введения данных: 
fputs($smtp_socket, $data."\r\n");  
// говорим, что закончили посылать данные: 
$answer = $this->smtp_send_cmd($smtp_socket, "."); 
//if($answer != '250') die ("."); 
// если всё ок, закрываем соединение с севером 
$answer = $this->smtp_send_cmd($smtp_socket, "QUIT"); 
//if($answer != '221') die ("QUIT"); 
fclose($smtp_socket); 

/*
       
     $this->load->library('email');
     $config['protocol'] = 'sendmail';
    // $config['mailpath'] = '/usr/sbin/sendmail -t -i';
     
   //  $config['protocol'] = 'smtp';
   //  $config['smtp_host'] = 'smtp.mail.ru';
   //  $config['smtp_user'] = 'robot_inokon@mail.ru';
   //  $config['smtp_pass'] = 'ktjyfhlj1';
   //  $config['smtp_port'] = '25';
     
    
     //$config['useragent'] = 'mail.ru';    
     //$config['protocol'] = 'mail';     
    
     $config['mailtype'] = 'html';
     $this->email->initialize($config);

     $this->email->from("inokon@inbox.ru", 'INOKON.ru');
     $this->email->to("$to");
     $this->email->subject("$tema");
     $this->email->message("$telo");


     $this->email->send();        
   
*/
     
     /*
     
     $this->load->library('email');
     
     
     $config['protocol'] = 'smtp';
     $config['smtp_host'] = 'in.mailjet.com';
     $config['smtp_user'] = '61082b7ebfc9b3edea4511c2a7fc8959';
     $config['smtp_pass'] = '3eeedaf6abdd6d6d00af31df9f9c8c20';
     $config['smtp_port'] = '587';
       
       
     
    
     //$config['useragent'] = 'mail.ru';    
     //$config['protocol'] = 'mail';     
    
     $config['mailtype'] = 'html';
     $this->email->initialize($config);

     $this->email->from("inokon@inbox.ru", 'INOKON.ru');
     $this->email->to("$to");
     $this->email->subject("$tema");
     $this->email->message("$telo");


     $this->email->send();        
     */
 

//if (MYSITEID==1) { $config['protocol'] = 'smtp'; }       
/*$config['smtp_host'] = 'ssl://in.mailjet.com';
$config['smtp_port'] = '465';
$config['smtp_user'] = '61082b7ebfc9b3edea4511c2a7fc8959';
$config['smtp_pass'] = 'ab33b435c2d2ebcf1ad84ca0323cde20';
*/
      
   
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n"; 

$this->load->library('email');

//$ot_kogo = "no_reply@ski-schule.ru";
$ot_kogo = "newmailreg@mail.ru";

$this->email->initialize($config);


$ot_kogo_podpis = "$ot_kogo";

$this->email->from("$ot_kogo", "$ot_kogo_podpis");
$this->email->to("$to");
$this->email->subject("$tema");
$this->email->message("$telo");

$this->email->send();
  
/*   
    $headers = 'From: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
      
    mail($to, $tema, $telo, $headers);
  
     */ 
    }

}
?>