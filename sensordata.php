<html>

<?php

// Script to fetch sensordata from temperature and humidity sensor
// TODO: Customize for multiple sensor types

include 'config.php'

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

if (isset($_GET['addpassword']) && $_GET['addpassword'] == $sensorpwd) {
	echo "Saving data..<br>";
  $sensor_id = $_GET['sensorid'];
  $sensor_date = $_GET['date'];
  $sensor_time = $_GET['time'];
  $sensor_temp = $_GET['temperature'];
  $sensor_humidity = $_GET['humidity'];
	//$sql = "INSERT INTO $db_table (id,sensorid,date,time,temperature,humidity) VALUES ('','" . $_GET['sensorid'] . "','" . $_GET['date'] . "','" . $_GET['time'] . "','" . $_GET['temperature'] . "','" . $_GET['humidity'] . "');";
  $sql = "INSERT INTO $db_table (id,sensorid,date,time,temperature,humidity) VALUES ('','$sensor_id','$sensor_date','$sensor_time','$sensor_temperature','$sensor_humidity');";
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
  else{
      echo "Data from sensor <b>$sensor_id</b> saved.<br>";
  }
}

// The script will automatically free the result and close the MySQL
// connection when it exits, but let's just do it anyways
$result->free();
$mysqli->close();

?>

</html>
