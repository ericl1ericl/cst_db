<?php
if(isset($_GET["theme"]) && isset($_GET["quote"]))
	{
		$themeId = $_GET["theme"];
		$quoteId = $_GET["quote"];
	}

$servername = "localhost";
$username = "root";
$password = "eric";
$dbname = "cst_db";
$conn = new mysqli($servername, $username, $password,
					 $dbname);
if ($conn->connect_error) {
		  die("Connection Failed: ".$conn->connect_error);
}
echo "<html><body>";

$quoteQuery = "select quote from quotes where quote_id=$quoteId";
$result = $conn->query($quoteQuery);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<h1>".$row['quote']."</h1>";
	}
}
else {
	echo "No quote";
}
echo "<p>Experiences<p>";

$table = "select exp_id, experience from experiences where quote_id=$quoteId";
$result = $conn->query($table);
if ($result->num_rows > 0) {
		  echo "<table border = '1'>";
		  echo "<tr>";
		  echo "<th>Experience</th>";
		  echo "</tr>";
		  while($row = $result->fetch_assoc()) {
					 echo "<tr>";
					 echo "<td>".$row['experience']."</td>";
					 echo "</tr>";
		  }
		  echo "</table>";
}
else {
		  echo "No Results";
}

echo "<p>Enter a new experience for this theme and quote:</p>";
echo "<form action=''>";
	echo "<textarea name='new_experience' rows='10' cols='30'>Type the experience here.</textarea>";
	echo "<br><input type='submit'>";
echo "</form";


$conn->close();
echo "</body></html>";
?>