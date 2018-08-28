<?php require '../app/views/include/header.php'; ?>
<?php 
echo "<div class='row'>";
foreach ($data as $category) {
  $imgName= strtolower($category->name);
  $name = str_replace("_", " ", $category->name);
  $link = $name == "Doors" ? "index.php?url=pages/viewproduct/doors/doors" : "index.php?url=users/get".$imgName;
  echo "<div class='col-sm-6 col-sm-4 col-md-3'><div class='imageBox'><img class='categoryTumb' src='./img/category/".$imgName.".png'/><a href='$link'>".$name."</a></div></div>";
} 
echo "</div>";
?>
<?php require '../app/views/include/footer.php'; ?>
