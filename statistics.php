
<!DOCTYPE html>
<?php include("texts.php");?>
<html lang="<?=$language_ch?>">
<head>
<title> <?=$site_name_c?> - <?=$Statistics?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
<p class="breadcrumbs mb-0"><span class="mr-3"><a href="/"><?=$home?> <i class="ion-ios-arrow-forward"></i></a></span> <span><?=$Statistics?></span></p>
<h1 class="mb-3 bread"><?=$Statistics?></h1>
</div>
</div>
</div>
</div>

<section class="ftco-section bg-light">
<div class="container">
<div class="row">
<div class="col-lg-12 pr-lg-4">
<div class="row">


<?php
$datee="";
$visitors="";
$actual_link = "https://www.jobsagent.org";
require_once('db_conn.php');
$sql = "SELECT  datee , COUNT(id) AS vistors FROM visitors GROUP BY datee  ORDER BY id DESC LIMIT 30";
echo'';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
   $datee=$datee.'"'.$row['datee'].'"'.',';
   $visitors=$visitors.'"'.$row['vistors'].'"'.',';
   
}
}

?>

<canvas id="myChart" style="width:100%;" style="font-family:'myfont';"></canvas>

<script>
var xValues = [<?=$datee;?>];
var yValues = [<?=$visitors;?>];
var barColors ="#3399cc";
new Chart("myChart", {
  type: "horizontalBar",
  data: {
  labels: xValues,
  datasets: [{
    backgroundColor: barColors,
    data: yValues
  }]
},
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "<?php echo $msg4;?>"
    },
    scales: {
      xAxes: [{ticks: {min: 1, max:5000}}]
    }
  }
});
</script>




</div>

</div>
<div class="col-lg-4 sidebar">

</div>
</div>

</div>



</div>

</div>
</div>

</div>

<?php include("newsletter.php");?>

<?php include("footer.php");?>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php include("scripts.php");?>


</body>

</html>









