<?php if ($this->uri->segment(1)!="login") { ?>
<?php

 if (!isset($partner)) $partner = $this->Data_forall->get_partner();

?>

<div class="row">

 <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <?php if ($partner['give']==0) { ?> 
             <a class="navbar-brand" href="#">Project</a>
            <?php } else { ?>      
             <?php if ($this->uri->segment(1)!="orderform") { ?> <a class="btn btn-info" style="margin: 7px 15px 0px 5px;" href="<?php echo base_url()."orderform"; ?>" role="button"><i class="fa fa-plus-circle" aria-hidden="true" style="margin-right: 5px;" ></i><?php echo $this->lang->line('plus_order'); ?></a><?php } ?>
            <?php } ?>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <?php if ($partner['take']!=0) { ?><li class="<?php if ($this->uri->segment(1)=="feed") echo 'active'; ?>" ><?=anchor("feed",$this->lang->line('feed_apps'))?></li><?php } ?>  
              <li class="<?php if ($this->uri->segment(1)=="myorders" and $this->uri->segment(2)=="give") echo 'active'; ?>" ><?=anchor("myorders/give",$this->lang->line('myorders_give'))?></li>
              <?php if ($partner['take']!=0) { ?><li class="<?php if ($this->uri->segment(1)=="myorders" and $this->uri->segment(2)=="take") echo 'active'; ?>" ><?=anchor("myorders/take",$this->lang->line('myorders_take'))?></li><?php } ?>
              <li><?=anchor("login/exitout",$this->lang->line('exit'))?></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>    
    
</div>
<?php } ?>