<?php require '../app/views/include/header.php'; ?>
<?php 
foreach ($data as $news) {
echo "<div class='row' style='margin: 70px 0 70px 30px;'>";
  echo "<div class='col-md-2 divNews'><b>".date('d/m/Y',$news->created)."</b></div>";
  echo "<div class='col-md-1 divNews'><span class='circleNews'></span></div>";
  echo "<div class='col-md-8'><b>".$news->title."</b><p>".$news->description."</p></div>";
  echo "</div>";
}
?>
<?php require '../app/views/include/footer.php'; ?>
