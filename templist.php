<html>
<?php
// Script for retrieveing sensor data and making a graph in HTML5

include 'config.php'

// Connect to mysql database..
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);

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

// Close DB connection
$result->free();
$mysqli->close();
?>
</html>
