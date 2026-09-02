<!DOCTYPE html>
<?php include("texts.php");?>
<html lang="en">
<head>
<title> <?=$site_name_c?> - <?=$job_list?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php include("meta.php");?>
</head>
<body>
<?php include("menu.php")?>
<div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
<div class="overlay"></div>
<div class="container">
<div class="row no-gutters slider-text align-items-end justify-content-start">
<div class="col-md-12  text-center mb-5">
<p class="breadcrumbs mb-0"><span class="mr-3"><a href="/"><?=$home?> <i class="ion-ios-arrow-forward"></i></a></span> <span><?=$job_list?></span></p>
<h1 class="mb-3 bread"><?=$job_list?></h1>
</div>
</div>
</div>
</div>
<section class="ftco-section bg-light">
<div class="container">
<div class="row">
<div class="col-lg-8 pr-lg-4">
<div class="row">


<?php





include("db_conn.php");
$limit = 100; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$query = "SELECT * FROM myjobs WHERE company LIKE '%$search%' order by id desc LIMIT $start, $limit";
$result = $conn->query($query);

$total_query = "SELECT COUNT(*) FROM myjobs WHERE company LIKE '%$search%'";
$total_result = $conn->query($total_query);
$total = $total_result->fetch_row()[0];

$pages = ceil($total / $limit);
?>

<?php if ($result->num_rows > 0): ?>
<?php while ($row = $result->fetch_assoc()): ?>
<?php

echo $my_url.'/readmore.php?job='.$row['id'].'<br>';

?>
<?php endwhile; ?>
<?php else: ?>
<p>No results found</p>
<?php endif; ?>

<nav aria-label="Page navigation example">
<ul class="pagination pagination pagination-sm">
<div class="row mt-5">
<div class="col text-center">
<div class="block-27">
<ul  >
<?php for ($i = 1; $i <= $pages; $i++): ?>

<?php if($page==$i)
{

echo'<li class="page-item active"><a href="?search=',$search.'&page='.$i.'">'.$i.'</a></li>';
}
else
{
echo'<li class="page-item "><a  href="?search='.urlencode($search).'&page='.$i.'">'.$i.'</a></li>';


}
?>
<?php endfor; ?>
</ul>
</div>
</div>
</div>
</ul>
</nav>




</div>

</div>
<div class="col-lg-4 sidebar">
<div class="sidebar-box bg-white p-4 ">
<h3 class="heading-sidebar"><?=$search_by_company_name?></h3>
<form method="GET" action="" class="search-form mb-3">

<div class="form-group">
<span class="icon icon-search"></span>
<input type="text" name="search" class="form-control"  placeholder="<?=$Search?>..." value="<?php echo htmlspecialchars($search); ?>">

</div>

<div class="form-group">
<div class="form-field">
<div class="select-wrap">
<div class="icon"><span class="flaticon-stethoscope"></span></div>
<select name="" id="" class="form-control small">
<option class="small" value="0"><?=$all?></option>

<?php
require('db_conn.php');
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * from myjobs group by company";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc())
{	
echo'<option class="small" value='.$row["id"].'>'.$row["company"].'</option>';
}
} else {
echo "0 results";
}
$conn->close();
?>	
</select>
</div>
</div>
</div>




<button class="btn btn-primary" type="submit"><span class="icon-search"></span>   <?=$Search?></button>
</div>
</div>

</div>


</form>

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