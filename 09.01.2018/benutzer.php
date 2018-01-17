	<?php

	$name = $_GET["name"];
	$passwort = $_GET["passwort"]; 
	$passwort1 = $_GET["passwort"];

	$geburtstag = $_GET["geburtstag"];
	$vorname = $_GET["vorname"]; 
	$nachname = $_GET["nachname"];
	
	$admin = $_GET["admin"];
	
	
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
      echo 'Keine Verbindung zu DB';
      exit;
    }
   
 // kontrolle ob user schon gibst   wenn ja  "existiert schon"
	$query = "SELECT Username FROM mitarbeiter WHERE Username='$name'";
	$result = mysqli_query ($mysql, $query);	
	if(mysqli_num_rows($result) > 0)
	{
		echo "<script>alert('Benutzer exestiert schon!'); 
		location.href='UserAdminOberflaeche.php';</script>";
	}
	else
	{
		// query to  Tabelle im DB
		$query = "insert into mitarbeiter values ('$Id','$vorname','$nachname','$geburtstag','$admin','$name',sha1('$passwort'));";
		$result = mysqli_query( $mysql, $query );
		if(!$result)
		{
			echo 'Kein Eintrag in Tabelle möglich';
			exit;
		}
		else if( $passwort1 != $passwort )
		{
			echo "<script>alert('Passwort falsch -- Nicht identisch'); 
			location.href='UserAdminOberflaeche.php';</script>";
			
		}
		else
		{
			echo "<script>alert('Benutzer erfolgreich hinzugefuegt'); 
			location.href='UserAdminOberflaeche.php';</script>";
			echo 'Benutzer erfolgreich hinzugefuegt';
		}	
	}
?>
		