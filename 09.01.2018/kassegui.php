<?php
$q=$_GET["q"];

$con = mysql_connect('localhost', 'root', '');
if (!$con)
 {
 die('Could not connect: ' . mysql_error());
 }

mysql_select_db("ajax_demo", $con);

$sql="SELECT * FROM essen WHERE id = '".$q."'";

$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>Artikel</th>
<th>Menge</th>
<th>Preis</th>
</tr>";

while($row = mysql_fetch_array($result))
 {
 echo "<tr>";
 echo "<td>" . $row['Artikel'] . "</td>";
 echo "<td>" . $row['Preis'] . "</td>";
 echo "<td>" . $row['Menge'] . "</td>";

 }
echo "</table>";

mysql_close($con);
?>