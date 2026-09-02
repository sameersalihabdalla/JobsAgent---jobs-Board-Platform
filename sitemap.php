<?php include("texts.php");
$actual_link = $my_url;
require_once('db_conn.php');
$sitemapText = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

$sql = "SELECT * FROM myjobs order by id desc";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link."/readmore.php?job=".$row['id'].'</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';
   }
}


$sql = "SELECT * FROM myjobs group by company";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link."/companies.php?search=".urlencode($row['company']).'</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';
   }
}


$sql = "SELECT * FROM myjobs group by city_name_en order by id desc";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link."/cities.php?search=".urlencode($row['city_name_en']).'</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';
   }
}



$sql = "SELECT * FROM myjobs group by name_en order by id desc";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link."/Countries.php?search=".urlencode($row['name_en']).'</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';
   }
}


$sql = "SELECT * FROM myjobs group by job_cat_en order by id desc";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link."/job_type.php?search=".urlencode($row['job_cat_en']).'</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';
   }
}


$sql = "SELECT * FROM myjobs group by job_title order by id desc";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link."/browsejobs.php?search=".urlencode($row['job_title']).'</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';
   }
}





$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/index.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';

$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/browsejobs.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';



               $sitemapText = $sitemapText.' <url>
               <loc>'.$actual_link.'/companies.php</loc>
               <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
               <priority>1.0</priority>
             </url>';


             

             
             $sitemapText = $sitemapText.' <url>
             <loc>'.$actual_link.'/urllist.txt</loc>
             <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
             <priority>1.0</priority>
           </url>';




           
           $sitemapText = $sitemapText.' <url>
           <loc>'.$actual_link.'/sitemap1.xml</loc>
           <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
           <priority>1.0</priority>
         </url>';


         
         $sitemapText = $sitemapText.' <url>
         <loc>'.$actual_link.'/sitemap.rss</loc>
         <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
         <priority>1.0</priority>
       </url>';


       
       $sitemapText = $sitemapText.' <url>
       <loc>'.$actual_link.'/feed.rss</loc>
       <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
       <priority>1.0</priority>
     </url>';


     
     $sitemapText = $sitemapText.' <url>
     <loc>'.$actual_link.'/sitemap-mobile.xml</loc>
     <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
     <priority>1.0</priority>
   </url>';

   $sitemapText = $sitemapText.' <url>
   <loc>'.$actual_link.'/sitemap-code.xml</loc>
   <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
   <priority>1.0</priority>
 </url>';


             $sitemapText = $sitemapText.' <url>
             <loc>'.$actual_link.'/statistics.php</loc>
             <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
             <priority>1.0</priority>
           </url>';



     


$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/links.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';

$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/readmore.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';



$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/link_out.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';


$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/link_out.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';

$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/sitemap.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';

$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/sitemap.xml</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';


$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/jobs_list.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';

$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/link_out.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';

$sitemapText = $sitemapText.' <url>
                 <loc>'.$actual_link.'/add_job.php</loc>
                 <lastmod>'.date(DATE_ATOM,time()).'</lastmod>
                 <priority>1.0</priority>
               </url>';
$sitemapText = $sitemapText.'</urlset>';

echo $sitemapText;
$sitemap = fopen("sitemap.xml", "w") or die("Unable to open file!");
fwrite($sitemap, $sitemapText);
fclose($sitemap);
?>