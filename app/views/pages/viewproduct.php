<?php require '../app/views/include/header.php'; ?>
<?php 
$url = rtrim($_GET['url'], '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);
$directory = './img/category/';

if (isset($url[2])) {
  $directory .=$url[2] . "/";
}

$title = ucwords(str_replace("_", " ",end($url)));
if (isset($url[3])) {
  $directory .=$url[3] . "/";
}

if (isset($url[4])) {
  $directory .=$url[4] . "/";
}

if (isset($url[5])) {
  $directory .=$url[5] . "/";
}
// print_r($directory);
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
echo "<h1>".$title."</h1>";
echo '<div class="row justify-content-center"><div class="col-md-12"><div class="row">';
foreach ($scanned_directory as $picture) {
// print_r($directory.$picture);
$name = substr($picture, 0, strpos($picture,"-"));
$type = ".".substr($picture, -3);
$typeT = substr($picture, (strpos($picture,".".$type)-14));
$time = substr($typeT, 0, 10);
// $full = substr($name.'-'.$time,) . $type;
if ($type == '.png') {
  if (file_exists($directory.$name."-".$time.$type)) {
    echo '<a href="'.$directory.$name."-".$time.$type.'" data-toggle="lightbox" data-gallery="example-gallery" class="col-xs-6 col-sm-4 col-md-4">';
  } else {
    echo '<a href="'.$directory.$name."-".$time.'.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xs-6 col-sm-4 col-md-4">';
  }
  echo '<img src="'.$directory.$name.'-thumbnail-'.$time.$type.'" alt="'.$name.'" class="img-fluid">';
  echo '</a>';
}
}
echo '</div></div></div>';
?>
<?php require '../app/views/include/footer.php'; ?>
