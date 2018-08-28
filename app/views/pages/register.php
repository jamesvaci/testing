<?php require '../app/views/include/header.php'; ?>
<div class="row justify-content-center registerModal">
<form action="index.php?url=users/register" method='post'>
  <?php if(strlen($data['success'])>0){
    echo '<div class="alert alert-success" role="alert">'.$data['success'].'</div>';
  }
  if(strlen($data['email_used'])>0){
    echo '<div class="alert alert-danger" role="alert">'.$data['email_used'].'<span><i class="far fa-dizzy"></i></span></div>';
  }?>
  <div class="form-group">
    <input type="name" name="first_name" class="form-control" placeholder="Enter first name" value="<?php echo $data['first_name'];?>">
    <?php if(strlen($data['first_name_err'])>0){ echo '<div class="alert alert-warning" role="alert">'.$data['first_name_err'].'</div>'; }?>
  </div>
  <div class="form-group">
    <input type="name" name="last_name" class="form-control" placeholder="Enter last name" value="<?php echo $data['last_name'];?>">
    <?php if(strlen($data['last_name_err'])>0){ echo '<div class="alert alert-warning" role="alert">'.$data['last_name_err'].'</div>'; }?>
  </div>
  <div class="form-group">
    <input type="email" name="email" class="form-control" placeholder="Enter email"  value="<?php echo $data['email'];?>">
    <?php if(strlen($data['email_err'])>0){ echo '<div class="alert alert-warning" role="alert">'.$data['email_err'].'</div>'; }?>
  </div>
  <div class="form-group">
    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $data['password'];?>">
    <?php if(strlen($data['password_err'])>0){ echo '<div class="alert alert-warning" role="alert">'.$data['password_err'].'</div>'; }?>
  </div>
  <div class="form-group">
    <input type="password" name="conf_password" class="form-control" placeholder="Confim Password" value="<?php echo $data['confirm_password'];?>">
    <?php if(strlen($data['confirm_password_err'])>0){ echo '<div class="alert alert-warning" role="alert">'.$data['confirm_password_err'].'</div>'; }?>
  </div>
  <div class="form-check">
    <input name="terms_valid" type="checkbox" class="form-check-input" id="terms">
    <label class="form-check-label" for="exampleCheck1">I agree with the <a href="https://www.dropbox.com/s/8rqa0nafex87tqp/Terms%20of%20Service%20%26%20Privacy%20Policy.pdf?dl=0">Terms & Privacy Policy</a></label>
    <?php if(strlen($data['terms_valid_err'])>0){ echo '<div class="alert alert-warning" role="alert">'.$data['terms_valid_err'].'</div>'; }?>
  </div>
  <button type="submit" class="btn btn-primary registerButton">Submit</button>
</form>
</div>
<?php require '../app/views/include/footer.php'; ?>
