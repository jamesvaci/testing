<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content='ie=edge'>
  <link rel='stylesheet' href="../css/bootstrap.css">
  <link rel='stylesheet' href="../css/style.css">
  <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="../css/ekko-lightbox.css">
  <link rel="shortcut icon" type="image/png" href="../img/logotab.png"/>
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
  <title><?php echo SITENAME;?></title>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <a class="navbar-brand" href="index.php"><img class="header-logo" src='../img/logo.png'/></a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=users/getproducts">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=users/getreferences">References</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=users/getnews">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=users/getqa">Q & A</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="index.php?url=pages/discount">Discount</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="index.php?url=pages/contact">Contact</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link disabled" href="index.php?url=pages/market">Market</a>
          </li> -->
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="lang-circle" src='../img/eng.png'/>
          </a>
          <div id="langBar" class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a href="index.php?url=pages/index_sr">
              <img id="langCircleSrb" class="lang-circle" src='../img/srb.png'/>
            </a>
          </div>
        </li>
        <li class="nav-item dropdown userDrop">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropDownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropDownUser">
            <form  action="index.php?url=users/signin" method='post'>
              <?php
              if (isset($_SESSION['app_id'])):?>
                <div class="form_sign_register">
                  <a href="index.php?url=users/logout" type="submit" class="btn btn-primary">Logout</a>
                </div>
              <?php else:?>
              <div class="form_sign_register">
                <a href="index.php?url=users/signin" type="submit" class="btn btn-primary">Sign in</a>
                <p>or</p>
                <a href="index.php?url=users/register" type="submit" class="btn btn-primary">Register</a>
              </div>
            <?php endif;?>
            </form>
          </div>
        </li>
        </ul>
      </div>
    </div>
    </nav>
  </header>
  <div class="container">
