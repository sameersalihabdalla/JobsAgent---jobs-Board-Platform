<?php
// Array with names
// get the q parameter from URL
$q = $_REQUEST["q"];
if ($q !== "") {

  require('db_conn.php');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else
  {}
  $sql = "SELECT * from cities where country_id='".$q."' order by name";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {	  
      echo'<option  value='. $row["id"].'>'. $row["name"].'</option>';
    }
  } else {
    echo "0 results";
  }

  
  }


?>