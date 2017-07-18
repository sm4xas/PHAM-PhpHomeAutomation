<html>

<?php

// Script to fetch temperature data and plot a graph

// Table:
// id	sensorid	date	time	temperature	humidity

$addpassword = 	"addOK";

$db_host = 	"db.konfnet.com";
$db_user = 	"wse60027";
$db_pass = 	"rcr2139399";
$db_database = 	"wse60027";
$db_table = 	"templogger";

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

if (isset($_GET['addpassword']) && $_GET['addpassword'] == $addpassword) {
	echo "Saving data..";
	$sql = "INSERT INTO $db_table (id,sensorid,date,time,temperature,humidity) VALUES ('','" . $_GET['sensorid'] . "','" . $_GET['date'] . "','" . $_GET['time'] . "','" . $_GET['temperature'] . "','" . $_GET['humidity'] . "');";
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
}

	// Get 20 last posts..
	$sql = "SELECT id, sensorid, date, time, temperature, humidity FROM $db_table LIMIT 20;";
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
	
	// Create an array for the data
	
	echo "<table border=1 cellpadding=3>";
	
	while ($row = @mysqli_fetch_assoc($result)){
	
		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['sensorid']. "</td>";
		echo "<td>" . $row['date']. "</td>";
		echo "<td>" . $row['time']. "</td>";
		echo "<td>" . $row['temperature']. "</td>";
		echo "<td>" . $row['humidity'] . "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	
// The script will automatically free the result and close the MySQL
// connection when it exits, but let's just do it anyways
$result->free();
$mysqli->close();

?>
</html>