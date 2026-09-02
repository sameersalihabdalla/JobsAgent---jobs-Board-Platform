<!DOCTYPE html>
<?php
include("db_conn.php");
$skeywords="";
$skeywords = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$query = "SELECT * FROM myjobs WHERE city_name_en LIKE '%$skeywords%' order by city_name_en desc LIMIT 20";
$result = $conn->query($query);
$keywords=$skeywords;

if ($result->num_rows > 0) {
// Output data of each row
while($row = $result->fetch_assoc()) {
  $keywords=$keywords.','. $row["job_title"];

}
}

?>
<?php include("texts.php");?>
<html lang="<?=$language_ch?>">
  <head>
    <title> <?=$site_name_c?> - <?=$city?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <?php include("meta.php");?>
<?php echo'<meta name="keywords" content="'.$keywords.'">'; ?>
  </head>
  <body dir="<?=$direction?>">
    
	    <?php include("menu.php")?>

    <!-- END nav -->
    
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
          <div class="col-md-12  text-center mb-5">
          	<p class="breadcrumbs mb-0"><span class="mr-3"><a href="/"><?=$home?> <i class="ion-ios-arrow-forward"></i></a></span> <span><?=$city?></span></p>
            <h1 class="mb-3 bread"><?=$city?></h1>
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
$limit = 10; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$query = "SELECT * FROM myjobs WHERE city_name_en LIKE '%$search%' order by city_name_en desc LIMIT $start, $limit";
$result = $conn->query($query);

$total_query = "SELECT COUNT(*) FROM myjobs WHERE city_name_en LIKE '%$search%'";
$total_result = $conn->query($total_query);
$total = $total_result->fetch_row()[0];

$pages = ceil($total / $limit);
?>
				 
    <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
				echo'<div class="job-post-item p-4 d-block d-lg-flex align-items-center">
<div class="one-third mb-4 mb-md-0">
<div class="job-post-item-header align-items-center">
<span class="subadge">'.$row["job_type_en"].'</span>
<h2 class="mr-3 text-black"><a href="/readmore.php?job='.$row['id'].'">'.$row["job_title"].'</a></h2>
<div class="mr-3"><span class="icon-layers"></span> <a href="/companies.php?search='.$conn->real_escape_string(Urlencode($row['company'])).'">'.$row['company'].'</a></div>
<div><span class="icon-my_location"></span> <span><a class="mr-2" href="Countries.php?search='.$row['name_en'].'">'.$row["name_en"].'</a> , <a class="ml-2"  href="cities.php?search='.$row['city_name_en'].'">'.$row["city_name_en"].'</a></span><br>
</span></div>
<span>'.$row['date'].'  -  '.$row['add_date'].'</span>
<hr>'.$share_this.'
<button style="color:#3399cc;" class=" icon-twitter btn btn-sm p-1 " data-sharer="twitter" data-title="' . $row['job_title'] . '" data-hashtags="' . $row['job_title'] . '" data-url=http://www.jobsagent.org/readmore.php?job=' . $row["id"] . '> </button>
<button style="color:blue;"  class="  icon-facebook btn btn-sm p-1" data-sharer="facebook" data-title="' . $row['job_title'] . '" data-hashtags="' . $row['job_title'] . '" data-url=http://www.jobsagent.org/readmore.php?job=' . $row["id"] . '> </button>
<button  style="color:#04779d;" class="  icon-linkedin btn btn-sm p-1" data-sharer="linkedin" data-title="' . $row['job_title'] . '" data-hashtags="' . $row['job_title'] . '" data-url=http://www.jobsagent.org/readmore.php?job=' . $row["id"] . '> </button>
<button style="color:green;" class="  icon-whatsapp btn btn-sm p-1" data-sharer="whatsapp" data-title="' . $row['job_title'] . '" data-hashtags="' . $row['job_title'] . '" data-url=http://www.jobsagent.org/readmore.php?job=' . $row["id"] . '> </button>
<button style="color:#086583; " class="  icon-telegram btn btn-sm p-1" data-sharer="telegram" data-title="' . $row['job_title'] . '" data-hashtags="' . $row['job_title'] . '" data-url=http://www.jobsagent.org/readmore.php?job=' . $row["id"] . '> </button>

</div>
</div>

<div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
<div>

</div>
<a href="/readmore.php?job='.$row['id'].'" class="btn btn-primary py-2">'.$read_more.'</a>
</div>
</div>';
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
		</section>

		
		<section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-7 text-center heading-section heading-section-white ">
              <h2>Subcribe to our Newsletter</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
              <div class="row d-flex justify-content-center mt-4 mb-4">
                <div class="col-md-12">
                  <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
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