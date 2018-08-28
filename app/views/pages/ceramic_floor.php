<?php require '../app/views/include/header.php'; ?>
<?php 
echo "<div class='row'>";
$first_key = key($data[0]);
$categories = json_decode($data[0]->$first_key);
foreach ($categories as $value) {
  $name = str_replace("_", " ", $value);
  $ahref = strtolower($value);
  echo "<div class='col-sm-6 col-sm-4 col-md-4'><div class='imageBox'><img class='categoryTumb' src='./img/category/".$ahref.".png'/><a href='index.php?url=pages/viewproduct/kitchens/classic_kitchens/".$ahref."'>".$name."</a></div></div>";
}
echo "</div>";
?>
<?php require '../app/views/include/footer.php'; ?>
