<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">	
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php echo $page_title;?></title>
 <link rel="favicon" href="assets/images/favicon.png">
 
 <?php
 
  if (isset($plug_components)) echo $plug_components;
  if (isset($plug_scripts)) echo $plug_scripts;
  if (isset($plug_css)) echo $plug_css;
 
 ?>

</head>
<body>
    

<div class="container-fluid">    
 <?php $this->load->view('layouts/navbar');   ?>