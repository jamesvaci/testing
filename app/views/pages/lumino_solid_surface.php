<?php require '../app/views/include/header.php'; ?>
<?php 
echo "<div class='row'>";
$categories = json_decode($data[0]->subcategory);
foreach ($categories as $key => $value) {
  $name = str_replace("_", " ", $key);
  $ahref = strtolower($key);
  echo "<div class='col-sm-6 col-sm-4 col-md-3'><div class='imageBox'><img class='categoryTumb' src='./img/category/".strtolower($key).".png'/><a href='index.php?url=pages/viewproduct/lumino_solid_surface/".$ahref."'>".$name."</a></div></div>";
}
echo "</div>";
?>
<?php require '../app/views/include/footer.php'; ?>
