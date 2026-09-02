<?php
function limitWords($text, $limit) {
	$word_arr = explode(" ", $text);
	
	if (count($word_arr) > $limit) {
	$words = implode(" ", array_slice($word_arr , 0, $limit) ) . '';
	return $words;
	}
	return $text;
	}


	function strip_tags_content($string)
{
// ----- remove HTML TAGs ----- 
$string = preg_replace('/<[^>]*>/', ' ', $string);
// ----- remove control characters ----- 
$string = str_replace("\r", ' ', $string);
$string = str_replace("\n", ' ', $string);
$string = str_replace("\t", ' ', $string);
$string = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n", ",", ";", ";", "<", "&", "nbsp", ":", ".", '"', ")", "(", "?", "؟", "-", "_", "@", ",,", ""), ' ', $string);
// ----- remove multiple spaces ----- 
$string = trim(preg_replace('/ {2,}/', ' ', $string));
return $string;
}

?>

<!DOCTYPE html>
<form action="get_data.php"   Method="POST">
<?php
include("texts.php");
include('db_conn.php');
if (isset($_GET['job'])) 
{

$goal=$_GET['job'];
$sql = "SELECT * FROM myjobs where id=".$goal;	
$keywords="";
$desc="";
$title="";
// Execute the query and display the results
$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
$title=$row['job_title'];
$mydate=$row['date'];
$keywords=$keywords.$row['job_title'].' '.limitwords($row['desciption'],12).$row['name'].' '.$row['city_name'].$row['job_type'];
$keywords=str_replace(" ", ",", $keywords);
$keywords=str_replace("  ","", $keywords);
$keywords=str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n","0","1","2","3","4","5","6","7","8","9","10",")","(","?","؟","-","_","@"),"",$keywords);	
$desc=$row['job_title'].','.$row['job_cat_en'].' : '.$row['name_en'].''.$row['city_name'];

echo'my_tags:<br> <input type="text" value="'.$row['name'].','.$row['city_name'].','.$row['job_type'].','.$row['company'].'" name="my_tag"   ><br><br>';
echo'add_date :<br> <input type="text" value="'.$row['add_date'].'" name="add_date"  ><br><br>';
echo'date:<br> <input type="text" value="'.$row['date'].'" name="my_date" ><br><br>';
echo'job_title:<br>  <input type="text" value="'.$title.'" name="job_title"/><br><br>
location:<br>  <input type="text" value="'.$row['name'].','.$row['city_name'].'"  name="location"/><br><br>
salary:<br>  <input type="text" value="'.$row['salary'].'"  name="salary"/><br><br>
salary_char:<br>  <input type="text" value="'.$row['currency'].'"  name="salary_char"/><br><br>
email:<br>  <input type="text" value="'.$row['email'].'"  name="email"/><br><br>
URL:<br>  <input type="text" value="'.$row['link'].'"  name="url"/><br><br>
img_url:<br> <input type="text" value="https://www.jobsagent.org/images/flags/'. strtolower($row["iso2"]).'.png"  name="img_url"/><br><br>
keyword:<br> <input type="text" value="'.$keywords.'"  name="keywords"/><br><br>
job_type:<br> <input type="text" value="'.$row['job_type_en'].'"  name="job_type"/><br><br>
job_cat:<br> <input type="text" value="'.$row['job_cat'].'"  name="job_cat"/><br><br>
company:<br> <input type="text" value="'.$row['company'].'"  name="company"/><br><br>




txt_description:<br>
<textarea name="txt_description"  cols="100" rows="20">


<h2>'.$row['job_title'].'</h2><hr><h>
نحن في '.$row['company'].' نبحث عن '.$row['job_title'].' للعمل في '.$row['name'].','.$row['city_name'].'  ينهي التقديم للوظيفة بتاريخ '.$row['date'];
echo '</h3><br>'
.str_replace(array("<h1>", "</h1>"), array("<h2>", "</h2>"), $row["desciption"]).'

<br>


<img src="https://www.jobsagent.org/images/img'.$row['id'].'.png"  class="img-fluid" width="25%" alt="'.$row['job_title'].'" title="'.$row['job_title'].'">


</textarea><br><br>';





}

}
?>



























<input id="btnSignIn" type="submit" value="submit" name="submit">





</form>

<script>
	document.getElementById('btnSign1In').click();

</script>
