<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="allstyle.css">
		<title>Admin</title>
	</head>
	
    <body>
        <h3 id="überschrift">BENUTZER ANLEGEN</h3>
		<form action="benutzer.php" method="GET">  
		
		
			<div class="container">
				
				<label><b>Vorname</b></label>
				<input type="text" placeholder="Eingabe Vorname" name="vorname" required>
				
				<label><b>Nachname</b></label>
				<input type="text" placeholder="Eingabe nachname" name="nachname" required>
				
				<label><b>Geburtstag</b></label>
				<br></br>
				<input type="date" placeholder="Eingabe geburtstag" name="geburtstag" required>
				<br></br>
				
				<label><b>Benutzername</b></label>
				<input type="text" placeholder="Eingabe Benutzername" name="name" required>
				
				
				<label><b>Passwort</b></label>
				<input type="password" placeholder="Eingabe Passwort" name="passwort" required>

				<label><b>Passwort wiedeholen</b></label>
				<input type="password" placeholder="Passwort Wiederholen" name="passwort" required>
				 
				<label><b>Admin</b></label>
				<input type="radio" name="admin"  value=1 >Yes
				<input type="radio" name="admin"  value=0  checked="checked">NO
				
				<br/></br>

				<button type="submit" class="signupbtn">Registrieren</button>
				<button type="reset" class="signupbtn">Zurücksetzen</button>
				<button type="reset" class="signupbtn" onclick="window.location.href='index.html'">Logout</button>
				
				</br></br></br>
			</div>
			
		</form>
		
		
<!--       Bestellung       -->	

	<h3 id="überschrift">BESTELLUNG</h3>	
	<form action="UserAdminOberflaeche.php" method="Post">
	
		<div class="container"> 		
<?php

// connect to DB
		$mysql = mysqli_connect( 'localhost', 'root', '' );
		if(!$mysql)
		{
		  echo 'Cannot connect to database.';
		  exit;
		}
		
// select DB
		$selected = mysqli_select_db( $mysql, 'festbon' );
		if(!$selected)
		{
		  echo 'Cannot select database.';
		  exit;
		}
		
	echo"Aktueller Lagerbestand";
	
	// UPDATE
	if(isset($_POST['update'])){
	$UpdateQuery = "UPDATE essen SET Artikel='$_POST[artikel]', Preis='$_POST[preis]', Bestand='$_POST[bestand]' WHERE Artikel='$_POST[hidden]'";               
	mysqli_query($mysql ,$UpdateQuery);
	};
	
	// DELETE
	if(isset($_POST['delete'])){
	$DeleteQuery = "DELETE FROM essen WHERE Artikel='$_POST[hidden]'";          
	mysqli_query($mysql, $DeleteQuery);
	};

	// ADD
	if(isset($_POST['add'])){
	$AddQuery = "INSERT INTO essen (artikel, preis, bestand) VALUES ('$_POST[uartikel]','$_POST[upreis]','$_POST[ubestand]')";    
	mysqli_query($mysql, $AddQuery);
	};

	// SELECT 
	$sql ="SELECT * from essen";
	$myData = mysqli_query($mysql, $sql) or die (mysqli_error());
	echo "<table border=3>;
	<tr>
	<th>Artikel</th>
	<th>Preis</th>
	<th>Bestand</th>
	</tr>";
	while($record = mysqli_fetch_array($myData)){
	echo "<form action=UserAdminOberflaeche.php method=post>";
	echo "<tr>";
	echo "<td>" . "<input type=text name=artikel value='" . $record['Artikel'] . "' </td>";
	echo "<td>" . "<input type=text name=preis value='" . $record['Preis'] . "' </td>";
	echo "<td>" . "<input type=text name=bestand value='" . $record['Bestand'] . "' </td>";
	echo "<td>" . "<input type=hidden name=hidden value='" . $record['Artikel'] . "' </td>";
	echo "<td>" . "<input type=submit name=update value=update" . " </td>";
	echo "<td>" . "<input type=submit name=delete value=delete" . " </td>";
	echo "</tr>";
	echo "</form>";
	}
	echo "<form action=UserAdminOberflaeche.php method=post>";
	echo "<tr>";
	echo "<td><input type=text name=uartikel></td>";
	echo "<td><input type=text name=upreis></td>";
	echo "<td><input type=text name=ubestand></td>";
	echo "<td>" . "<input type=submit name=add value=add" . " </td>";
	echo "</tr>";
	echo "</form>";
	echo "</table>";
	mysqli_close($mysql);
?>
		</div>
	</form>
		

    </body>
</html>
