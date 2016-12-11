
 <div class="row">
   <div class="well">  
     <?php echo form_open("login/auth","class='form-reg' style='margin: 5%;'"); ?>
       
       <h2 class="form-signin-heading"><?php echo $this->lang->line('please_enter'); ?></h2>
       
       <div id="err_div" style="color:red"><?php if (isset($error_msg)) echo "<span style='margin:5px 0px 5px 0px;' >".$error_msg."</span>"; ?></div>
       
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="login" name="login" class="form-control" placeholder="Email" required autofocus value="<?php if (isset($login)) echo $login; ?>">
        <br/>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="pass" name="pass" class="form-control" placeholder="<?php echo $this->lang->line('pass'); ?>" required value="<?php if (isset($pass)) echo $pass; ?>" >        
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="butt_enter" name="butt_enter"><?php echo $this->lang->line('enter'); ?></button>
      </form>
      
     <?php echo form_close(); ?>
   </div>
 </div> 
