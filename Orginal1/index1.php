<?php

	$name = $_GET["name"];
	$passwort = $_GET["passwort"]; 
	
	
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
	
	$query = "select count(*) from mitarbeiter where
              Username = '$name' and
              Passwort = '$passwort'";

    $result = mysqli_query( $mysql, $query );
    if(!$result)
    {
      echo 'Kein Eintrag in DB möglich';
      exit;
    }
	
	
//Hier ist der fehler !!

    $row = mysqli_fetch_row( $result );
    $count = $row[0];
	
	if ( $count > 0 )
	{
		$query = "select count(*) from mitarbeiter where
		Username = '$name' and
        Passwort = '$passwort' and
		IsAdmin = 1";
		
		$result = mysqli_query( $mysql, $query );
		if(!$result)
		{
			echo $query;
			exit;			
		}
		$row = mysqli_fetch_row( $result );
		$count = $row[0];
		
		if ( $count > 0 )
		{
			header("Location:UserAdminOberflaeche.php");
		}
		else
		{
			header("Location: kassegui.html");			
		}	
		
	}
	else
    {
		// PSW Falsch
		echo "<script>alert('Passwort falsch !'); location.href='index.html';</script>";
			
    }
	
	
?>

