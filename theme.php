<?php
if(isset($_GET["theme"]))
	{
		$themeId = $_GET["theme"];
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

$themeQuery = "select theme from themes where theme_id=$themeId";
$result = $conn->query($themeQuery);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<h1>".$row['theme']."</h1>";
	}
}
else {
	echo "No theme";
}
echo "<p>Quotes<p>";

$table = "select quote_id, quote from quotes where theme_id=$themeId";
$result = $conn->query($table);
if ($result->num_rows > 0) {
		  echo "<table border = '1'>";
		  echo "<tr>";
		  echo "<th>Quote</th>";
		  echo "</tr>";
		  while($row = $result->fetch_assoc()) {
					 echo "<tr>";
					echo '<td><a href = "./quote.php?theme='.$themeId.'&quote='.$row['quote_id'].'">'.$row['quote'].'</a></td>';
					 //echo '<td><a href = "./quote.php?quote='.$row['quote_id'].'">'.$row['quote'].'</a></td>';
					 echo "</tr>";
		  }
		  echo "</table>";
}
else {
		  echo "No Results";
}

echo "<p>Enter a new quote for this theme:</p>";
echo "<form action=''>";
	echo "<textarea name='new_quote' rows='10' cols='30'>Type the quote here.</textarea>";
	echo "<br><input type='submit'>";
echo "</form";

$conn->close();
echo "</body></html>";
?>
