<!DOCTYPE html>
<?php  include("texts.php");  ?>
<html lang="<?=$language_ch?>">
<head>
<?php include("texts.php"); ?>
<title><?=$site_name_c?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php include("meta.php");?>

</head>
<body dir="<?=$direction?>">

<?php include("menu.php")?>

<!-- END nav -->

<div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
<div class="overlay"></div>
<div class="container">
<div class="row no-gutters slider-text align-items-end justify-content-start">
<div class="col-md-12  text-center mb-5">
<p class="breadcrumbs mb-0"><span class="mr-3"><a href="index.php"><?=$home?> <i class="ion-ios-arrow-forward"></i></a></span> <span>Developer</span></p>
<h1 class="mb-3 bread">Developer</h1>
</div>
</div>
</div>
</div>

<section class="ftco-section contact-section bg-light">
<div class="container">
<div class="row d-flex mb-5 contact-info">
<div class="col-md-12 mb-4">

</div>

<div class="col-md-6 d-flex">
<div id="map" class="bg-white"></div>
</div>
</div>
</div>
</section>

<?php include("footer.php");?> 

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<?php include("scripts.php");?>


</body>
</html>