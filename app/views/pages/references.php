<?php require '../app/views/include/header.php'; ?>
<?php 
$references = array_chunk($data, 15, true);
echo "<div class='row'>";
foreach ($references as $chunk) {
  foreach ($chunk as $place => $key) {
    echo "<div class='col-md-4'>";
    echo "<p>".$key->name." - ".$key->place."</p>";
    echo "</div>";
  }
}
echo "</div>";
 ?>
<?php require '../app/views/include/footer.php'; ?>
