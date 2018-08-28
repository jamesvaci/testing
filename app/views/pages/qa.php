<?php require '../app/views/include/header.php'; ?>
<div class="row justify-content-center qaPage">
  <div class="col-xs-12 col-md-4">    
    <?php if ($data['isLoggedIn'] == 1): ?>
     <form action="index.php?url=users/qa" method='post'>
       <div class="form-group">
         <input type="text" name="question" class="form-control" placeholder="Please write your question here">
       </div>
       <button type="submit" class="btn btn-primary qaButton">Post</button>
     </form>    
   <?php else: ?>
     <h5>To ask a question please <a href="index.php?url=users/signin">sign in</a> first</h5>
    <?php endif; ?>
  </div>
</div>
<div class="row justify-content-center">
  <?php foreach ($data['qa'] as $quest){
  echo '<div class="col-xs-12 col-sm-4 col-md-3 qaBox">';
  echo '<div class="question">';
  echo '<h6>'.$quest->first_name.'</h6>';
  echo '<h5>'.$quest->question.'</h5>';
  if ($quest->answer) {
    echo '<div class="answer">';
    echo '<h6>Bane</h6>';
    echo '<h5>'.$quest->answer.'</h5>';
    echo '</div>';
  }
  echo '</div>';
  echo '</div>';
  }?>
</div>
<?php require '../app/views/include/footer.php'; ?>
