<html>
<script>
var graphdata = [];
</script>

<?php

// Script to plot temperature and humidity data from database

include 'config.php';

// Connect to mysql database..
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);

// Oh no! A connect_errno exists so the connection attempt failed!
if ($mysqli->connect_errno) {
    // The connection failed. What do you want to do? 
    // You could contact yourself (email?), log the error, show a nice page, etc.
    // You do not want to reveal sensitive information

    // Let's try this:
    echo "Sorry, this website is experiencing problems.";

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    
    // You might want to show them something nice, but we will simply exit
    exit;
}
else{ // Everything is OK
  // Get 20 last posts..
	$sql = "SELECT id, sensorid, date, time, temperature, humidity FROM $db_table_sensordata LIMIT 20;";
	if (!$result = $mysqli->query($sql)) {
	    // Oh no! The query failed. 
	    echo "Sorry, the website is experiencing problems.";
	
	    // Again, do not do this on a public site, but we'll show you how
	    // to get the error information
	    echo "Error: Our query failed to execute and here is why: \n";
	    echo "Query: " . $sql . "\n";
	    echo "Errno: " . $mysqli->errno . "\n";
	    echo "Error: " . $mysqli->error . "\n";
	    exit;
	}
	
  echo "<script>";

  while ($row = @mysqli_fetch_assoc($result)){
	  echo "graphdata.push(".$row['temperature'] . ");";
  }
  
  echo "</script>";

echo "<canvas id=\"graphCanvas\" width=\"$graph_width\" height=\"$graph_height\" style=\"$graph_style\"></canvas>";
}

?>

<script>
var canvas = document.getElementById("graphCanvas");
var ctx = canvas.getContext("2d");

ctx.moveTo(0,100-graphdata[0]);

for (i = 0; i < graphdata.length; i++) { 
    ctx.lineTo(i*5,100-graphdata[i]);
    ctx.stroke();
	document.write(graphdata[i]);
	document.write("test");
}
<script>

</html>
