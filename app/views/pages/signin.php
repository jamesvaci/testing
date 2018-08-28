<?php require '../app/views/include/header.php'; ?>
<div class="row justify-content-center registerModal">
<form action="index.php?url=users/signin" method='post'>
  <?php
  if(strlen($data['privlige'])>0){
    echo '<div class="alert alert-warning" role="alert">'.$data['privlige'].'</div>';
  }
  if(strlen($data['wrong_pass'])>0){
    echo '<div class="alert alert-danger" role="alert">'.$data['wrong_pass'].'<span><i class="far fa-dizzy"></i></span></div>';
  }?>
  <div class="form-group">
    <input type="name" name="email" class="form-control" placeholder="Enter first name" value="<?php echo $data['email'];?>">
  </div>
  <div class="form-group">
    <input type="password" name="password" class="form-control" placeholder="Enter last name" value="<?php echo $data['password'];?>">
  </div>
  <button type="submit" class="btn btn-primary signinButton">Sign In</button>
</form>
</div>
<?php require '../app/views/include/footer.php'; ?>
