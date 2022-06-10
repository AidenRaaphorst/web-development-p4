<?php
include_once("connect.php");
session_start();


// CHECK IF USER IS ADMIN, IF NOT, SEND USER TO LOGIN PAGE


debug();

// Hier komt alle logica voor create en update voor elke database
// Read & Delete
if(isset($_GET['boekingID'])) {
  if(isset($_GET['delete']) && $_GET['delete'] == "true") {
    $sql = "DELETE FROM boekingen WHERE boekingID = :boekingID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":boekingID", $_GET["boekingID"]);
    $stmt -> execute();

    header("Location: ../admin.php?database=boekingen");
  }
  
  // Get entry & set data in session
  $sql = "SELECT * FROM boekingen WHERE boekingID = :boekingID";
  $stmt = $connect -> prepare($sql);
  $stmt -> bindParam(":boekingID", $_GET["boekingID"]);
  $stmt -> execute();
  $result = $stmt -> fetch();
  
  $_SESSION['boekingID'] = $result['boekingID'];
  $_SESSION['gebruikerID'] = $result['gebruikerID'];
  $_SESSION['reisID'] = $result['reisID'];
  
  header("Location: ../admin.php?database=boekingen");
} else if(isset($_GET['contactID'])) {
  if(isset($_GET['delete']) && $_GET['delete'] == "true") {
    $sql = "DELETE FROM contact WHERE contactID = :contactID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":contactID", $_GET["contactID"]);
    $stmt -> execute();

    header("Location: ../admin.php?database=contact");
  }
  
  // Get entry & set data in session
  $sql = "SELECT * FROM contact WHERE contactID = :contactID";
  $stmt = $connect -> prepare($sql);
  $stmt -> bindParam(":contactID", $_GET["contactID"]);
  $stmt -> execute();
  $result = $stmt -> fetch();
  
  $_SESSION['contactID'] = $result['contactID'];
  $_SESSION['naam'] = $result['naam'];
  $_SESSION['bericht'] = $result['bericht'];
  
  header("Location: ../admin.php?database=contact");
} else if(isset($_GET['gebruikerID'])) {
  if(isset($_GET['delete']) && $_GET['delete'] == "true") {
    $sql = "DELETE FROM gebruikers WHERE gebruikerID = :gebruikerID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":gebruikerID", $_GET["gebruikerID"]);
    $stmt -> execute();

    header("Location: ../admin.php?database=gebruikers");
  }
  
  // Get entry & set data in session
  $sql = "SELECT * FROM gebruikers WHERE gebruikerID = :gebruikerID";
  $stmt = $connect -> prepare($sql);
  $stmt -> bindParam(":gebruikerID", $_GET["gebruikerID"]);
  $stmt -> execute();
  $result = $stmt -> fetch();
  
  $_SESSION['gebruikerID'] = $result['gebruikerID'];
  $_SESSION['naam'] = $result['naam'];
  $_SESSION['email'] = $result['email'];
  $_SESSION['wachtwoord'] = $result['wachtwoord'];
  $_SESSION['admin'] = $result['admin'];
  
  header("Location: ../admin.php?database=gebruikers");
} else if(isset($_GET['recensieID'])) {
  if(isset($_GET['delete']) && $_GET['delete'] == "true") {
    $sql = "DELETE FROM recensies WHERE recensieID = :recensieID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":recensieID", $_GET["recensieID"]);
    $stmt -> execute();

    header("Location: ../admin.php?database=recensies");
  }
  
  // Get entry & set data in session
  $sql = "SELECT * FROM recensies WHERE recensieID = :recensieID";
  $stmt = $connect -> prepare($sql);
  $stmt -> bindParam(":recensieID", $_GET["recensieID"]);
  $stmt -> execute();
  $result = $stmt -> fetch();
  
  $_SESSION['recensieID'] = $result['recensieID'];
  $_SESSION['gebruikerID'] = $result['gebruikerID'];
  $_SESSION['reisID'] = $result['reisID'];
  $_SESSION['gevalideerd'] = $result['gevalideerd'];
  $_SESSION['bericht'] = $result['bericht'];
  $_SESSION['sterren'] = $result['sterren'];
  $_SESSION['datum'] = $result['datum'];
  
  header("Location: ../admin.php?database=recensies");
} else if(isset($_GET['reisID'])) {
  if(isset($_GET['delete']) && $_GET['delete'] == "true") {
    $sql = "DELETE FROM reizen WHERE reisID = :reisID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":reisID", $_GET["reisID"]);
    $stmt -> execute();

    header("Location: ../admin.php?database=reizen");
  }
  
  // Get entry & set data in session
  $sql = "SELECT * FROM reizen WHERE reisID = :reisID";
  $stmt = $connect -> prepare($sql);
  $stmt -> bindParam(":reisID", $_GET["reisID"]);
  $stmt -> execute();
  $result = $stmt -> fetch();
  
  $_SESSION['reisID'] = $result['reisID'];
  $_SESSION['beginDatum'] = $result['beginDatum'];
  $_SESSION['eindDatum'] = $result['eindDatum'];
  $_SESSION['land'] = $result['land'];
  $_SESSION['titel'] = $result['titel'];
  $_SESSION['prijs'] = $result['prijs'];
  $_SESSION['sterren'] = $result['sterren'];
  $_SESSION['beschrijving'] = $result['beschrijving'];
  
  header("Location: ../admin.php?database=reizen");
}

// Create & Update
if($_POST['table'] == "boekingen") {
  if(isset($_POST['create'])) {
    $sql = "INSERT INTO boekingen (boekingID, gebruikerID, reisID) 
            VALUES(:boekingID, :gebruikerID, :reisID)";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":boekingID", $_POST["boekingID"]);
    $stmt -> bindParam(":gebruikerID", $_POST["gebruikerID"]);
    $stmt -> bindParam(":reisID", $_POST["reisID"]);
    $stmt -> execute();

    header("Location: ../admin.php?database=boekingen");
  }
  
  if(isset($_POST['update'])) {
    $sql = "UPDATE boekingen
            SET gebruikerID = :gebruikerID, reisID = :reisID
            WHERE boekingID = :boekingID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":boekingID", $_POST["boekingID"]);
    $stmt -> bindParam(":gebruikerID", $_POST["gebruikerID"]);
    $stmt -> bindParam(":reisID", $_POST["reisID"]);
    $stmt -> execute();
    
    header("Location: ../admin.php?database=boekingen");
  }
} else if($_POST['table'] == "contact") {
  if(isset($_POST['create'])) {
    $sql = "INSERT INTO contact (contactID, naam, bericht) 
            VALUES(:contactID, :naam, :bericht)";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":contactID", $_POST["contactID"]);
    $stmt -> bindParam(":naam", $_POST["naam"]);
    $stmt -> bindParam(":bericht", $_POST["bericht"]);
    $stmt -> execute();

    header("Location: ../admin.php?database=contact");
  }
  
  if(isset($_POST['update'])) {
    $sql = "UPDATE contact
            SET naam = :naam, bericht = :bericht
            WHERE contactID = :contactID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":contactID", $_POST["contactID"]);
    $stmt -> bindParam(":naam", $_POST["naam"]);
    $stmt -> bindParam(":bericht", $_POST["bericht"]);
    $stmt -> execute();
    
    header("Location: ../admin.php?database=contact");
  }
} else if($_POST['table'] == "gebruikers") {
  if(isset($_POST['create'])) {
    $sql = "INSERT INTO gebruikers (gebruikerID, naam, email, wachtwoord, admin) 
            VALUES(:gebruikerID, :naam, :email, :wachtwoord, :admin)";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":gebruikerID", $_POST["gebruikerID"]);
    $stmt -> bindParam(":naam", $_POST["naam"]);
    $stmt -> bindParam(":email", $_POST["email"]);
    $stmt -> bindParam(":wachtwoord", $_POST["wachtwoord"]);
    $stmt -> bindParam(":admin", $_POST["admin"]);
    $stmt -> execute();
    
    header("Location: ../admin.php?database=gebruikers");
  }
  
  if(isset($_POST['update'])) {
    $sql = "UPDATE gebruikers
            SET naam = :naam, email = :email, wachtwoord = :wachtwoord, admin = :admin
            WHERE gebruikerID = :gebruikerID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":gebruikerID", $_POST["gebruikerID"]);
    $stmt -> bindParam(":naam", $_POST["naam"]);
    $stmt -> bindParam(":email", $_POST["email"]);
    $stmt -> bindParam(":wachtwoord", $_POST["wachtwoord"]);
    $stmt -> bindParam(":admin", $_POST["admin"]);
    $stmt -> execute();
    
    header("Location: ../admin.php?database=gebruikers");
  }
} else if($_POST['table'] == "recensies") {
  if(isset($_POST['create'])) {
    $sql = "INSERT INTO recensies (recensieID, gebruikerID, reisID, gevalideerd, bericht, sterren, datum) 
            VALUES(:recensieID, :gebruikerID, :reisID, :gevalideerd, :bericht, :sterren, :datum)";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":recensieID", $_POST["recensieID"]);
    $stmt -> bindParam(":gebruikerID", $_POST["gebruikerID"]);
    $stmt -> bindParam(":reisID", $_POST["reisID"]);
    $stmt -> bindParam(":gevalideerd", $_POST["gevalideerd"]);
    $stmt -> bindParam(":bericht", $_POST["bericht"]);
    $stmt -> bindParam(":sterren", $_POST["sterren"]);
    $stmt -> bindParam(":datum", $_POST["datum"]);
    $stmt -> execute();
    
    header("Location: ../admin.php?database=recensies");
  }
  
  if(isset($_POST['update'])) {
    $sql = "UPDATE recensies
            SET gebruikerID = :gebruikerID, reisID = :reisID, gevalideerd = :gevalideerd, bericht = :bericht, sterren = :sterren, datum = :datum
            WHERE recensieID = :recensieID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":recensieID", $_POST["recensieID"]);
    $stmt -> bindParam(":gebruikerID", $_POST["gebruikerID"]);
    $stmt -> bindParam(":reisID", $_POST["reisID"]);
    $stmt -> bindParam(":gevalideerd", $_POST["gevalideerd"]);
    $stmt -> bindParam(":bericht", $_POST["bericht"]);
    $stmt -> bindParam(":sterren", $_POST["sterren"]);
    $stmt -> bindParam(":datum", $_POST["datum"]);
    $stmt -> execute();
    
    header("Location: ../admin.php?database=recensies");
  }
} else if($_POST['table'] == "reizen") {
  if(isset($_POST['create'])) {
    $sql = "INSERT INTO reizen (reisID, beginDatum, eindDatum, land, titel, prijs, sterren, beschrijving) 
            VALUES(:reisID, :beginDatum, :eindDatum, :land, :titel, :prijs, :sterren, :beschrijving)";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":reisID", $_POST["reisID"]);
    $stmt -> bindParam(":beginDatum", $_POST["beginDatum"]);
    $stmt -> bindParam(":eindDatum", $_POST["eindDatum"]);
    $stmt -> bindParam(":land", $_POST["land"]);
    $stmt -> bindParam(":titel", $_POST["titel"]);
    $stmt -> bindParam(":prijs", $_POST["prijs"]);
    $stmt -> bindParam(":sterren", $_POST["sterren"]);
    $stmt -> bindParam(":beschrijving", $_POST["beschrijving"]);
    $stmt -> execute();
    
    header("Location: ../admin.php?database=reizen");
  }
  
  if(isset($_POST['update'])) {
    $sql = "UPDATE reizen
            SET beginDatum = :beginDatum, eindDatum = :eindDatum, land = :land, titel = :titel, prijs = :prijs, sterren = :sterren, beschrijving = :beschrijving
            WHERE reisID = :reisID";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":reisID", $_POST["reisID"]);
    $stmt -> bindParam(":beginDatum", $_POST["beginDatum"]);
    $stmt -> bindParam(":eindDatum", $_POST["eindDatum"]);
    $stmt -> bindParam(":land", $_POST["land"]);
    $stmt -> bindParam(":titel", $_POST["titel"]);
    $stmt -> bindParam(":prijs", $_POST["prijs"]);
    $stmt -> bindParam(":sterren", $_POST["sterren"]);
    $stmt -> bindParam(":beschrijving", $_POST["beschrijving"]);
    $stmt -> execute();
    
    header("Location: ../admin.php?database=reizen");
  }
}







function debug() {
  echo "_GET:";
  echo "<br>";
  echo var_dump($_GET);

  echo "<br>";
  echo "<br>";

  echo "_POST:";
  echo "<br>";
  echo var_dump($_POST);
}

?>