<?php 
include_once("php/connect.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ria's | Admin Panel</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/databases.css">
  <link rel="stylesheet" href="css/nav-foot.css">
  <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
</head>

<body>
  <!-- CHECK IF USER IS ADMIN, IF NOT, SEND USER TO LOGIN PAGE -->


  <!-- Navbar -->
  <?php include_once("includes/navbar.php"); ?>

  <!-- Main -->
  <main>
    <!-- Select Databases -->
    <div class="choice">
      <h2>Databases</h2>
      <ul>
        <li><a href="?database=boekingen">Boekingen</a></li>
        <li><a href="?database=contact">Contact</a></li>
        <li><a href="?database=gebruikers">Gebruikers</a></li>
        <li><a href="?database=recensies">Recensies</a></li>
        <li><a href="?database=reizen">Reizen</a></li>
      </ul>
    </div>

    <!-- Show Selected Database -->
    <?php
      if(isset($_GET['database'])) {
        $database = $_GET['database'];

        
        if($database == "boekingen") { ?>
          <?php
            // Create values for create/update form
            $submitText = isset($_SESSION['boekingID']) ? "update" : "create";
            $boekingID = isset($_SESSION['boekingID']) ? $_SESSION['boekingID'] : "";
            $gebruikerID = isset($_SESSION['gebruikerID']) ? $_SESSION['gebruikerID'] : "";
            $reisID = isset($_SESSION['reisID']) ? $_SESSION['reisID'] : "";
    
            unset($_SESSION['boekingID']);
            unset($_SESSION['gebruikerID']);
            unset($_SESSION['reisID']);
          ?>

          <form action="php/sendtodb.php" method="post" class="create-update">
            <input type="hidden" name="table" value="boekingen"> <!-- Zodat ik kan zien voor welke database de post is. -->

            <table>
              <tr>
                <td><label for="boekingID">boekingID</label></td>
                <td><input type="text" name="boekingID" value="<?php echo $boekingID; ?>" readonly></td>
              </tr>
              
              <tr>
                <td><label for="gebruikerID">gebruikerID</label></td>
                <td><input type="text" name="gebruikerID" value="<?php echo $gebruikerID; ?>"></td>
              </tr>
              
              <tr>
                <td><label for="reisID">reisID</label></td>
                <td><input type="text" name="reisID" value="<?php echo $reisID; ?>"></td>
              </tr>
            </table>
            
            <input type="submit" name="<?php echo $submitText; ?>" value="<?php echo ucfirst($submitText); ?>">
            <input type="button" value="Clear" class="clear-form">
          </form>

          <div class="database-container">
            <h2 id="database-name"><?php echo ucfirst($database); ?></h2>
  
            <table class="database">
              <tr>
                <th>boekingID</th>
                <th>gebruikerID</th>
                <th>reisID</th>
  
                <th>Edit</th>
                <th>Delete</th>
              </tr>
  
              <?php
              $sql = "SELECT * FROM boekingen";
              $stmt = $connect -> prepare($sql);
              $stmt -> execute();
              $result = $stmt -> fetchAll();
  
              foreach($result as $res) { ?>
                <tr>
                  <td><p><?php echo $res['boekingID']; ?></p></td>
                  <td><p><?php echo $res['gebruikerID']; ?></p></td>
                  <td><p><?php echo $res['reisID']; ?></p></td>
  
                  <td><a href="php/sendtodb.php?boekingID=<?php echo $res['boekingID']; ?>">Edit</a></td>
                  <td><a href="php/sendtodb.php?boekingID=<?php echo $res['boekingID']; ?>&delete=true">Delete</a></td>
                </tr>
              <?php } ?>
  
            </table>
          </div>
          <?php
        } else if($database == "contact") { ?>
          <?php
            // Create values for create/update form
            $submitText = isset($_SESSION['contactID']) ? "update" : "create";
            $contactID = isset($_SESSION['contactID']) ? $_SESSION['contactID'] : "";
            $naam = isset($_SESSION['naam']) ? $_SESSION['naam'] : "";
            $bericht = isset($_SESSION['bericht']) ? $_SESSION['bericht'] : "";
            
            unset($_SESSION['contactID']);
            unset($_SESSION['naam']);
            unset($_SESSION['bericht']);
          ?>

          <form action="php/sendtodb.php" method="post" class="create-update">
            <input type="hidden" name="table" value="contact"> <!-- Zodat ik kan zien voor welke database de post is. -->

            <table>
              <tr>
                <td><label for="contactID">contactID</label></td>
                <td><input type="text" name="contactID" value="<?php echo $contactID; ?>" readonly></td>
              </tr>
              
              <tr>
                <td><label for="naam">naam</label></td>
                <td><input type="text" name="naam" value="<?php echo $naam; ?>"></td>
              </tr>
              
              <tr>
                <td><label for="bericht">bericht</label></td>
                <td><textarea type="text" name="bericht"><?php echo $bericht; ?></textarea></td>
              </tr>
            </table>
            
            <input type="submit" name="<?php echo $submitText; ?>" value="<?php echo ucfirst($submitText); ?>">
            <input type="button" value="Clear" class="clear-form">
          </form>

          <div class="database-container">
            <h2 id="database-name"><?php echo ucfirst($database); ?></h2>
  
            <table class="database">
              <tr>
                <th>contactID</th>
                <th>naam</th>
                <th>bericht</th>
  
                <th>Edit</th>
                <th>Delete</th>
              </tr>
  
              <?php
              $sql = "SELECT * FROM contact";
              $stmt = $connect -> prepare($sql);
              $stmt -> execute();
              $result = $stmt -> fetchAll();
  
              foreach($result as $res) { ?>
                <tr>
                  <td><p><?php echo $res['contactID']; ?></p></td>
                  <td><p><?php echo $res['naam']; ?></p></td>
                  <td class="long-text"><p><?php echo $res['bericht']; ?></p></td>
  
                  <td><a href="php/sendtodb.php?contactID=<?php echo $res['contactID']; ?>">Edit</a></td>
                  <td><a href="php/sendtodb.php?contactID=<?php echo $res['contactID']; ?>&delete=true">Delete</a></td>
                </tr>
              <?php } ?>
  
            </table>
          </div>
          <?php
        } else if($database == "gebruikers") { ?>
          <?php
            // Create values for create/update form
            $submitText = isset($_SESSION['gebruikerID']) ? "update" : "create";
            $gebruikerID = isset($_SESSION['gebruikerID']) ? $_SESSION['gebruikerID'] : "";
            $naam = isset($_SESSION['naam']) ? $_SESSION['naam'] : "";
            $email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
            $wachtwoord = isset($_SESSION['wachtwoord']) ? $_SESSION['wachtwoord'] : "";
            $admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : "";
            
            unset($_SESSION['gebruikerID']);
            unset($_SESSION['naam']);
            unset($_SESSION['email']);
            unset($_SESSION['wachtwoord']);
            unset($_SESSION['admin']);
          ?>

          <form action="php/sendtodb.php" method="post" class="create-update">
            <input type="hidden" name="table" value="gebruikers"> <!-- Zodat ik kan zien voor welke database de post is. -->

            <table>
              <tr>
                <td><label for="gebruikerID">gebruikerID</label></td>
                <td><input type="text" name="gebruikerID" value="<?php echo $gebruikerID; ?>" readonly></td>
              </tr>
              
              <tr>
                <td><label for="naam">naam</label></td>
                <td><input type="text" name="naam" value="<?php echo $naam; ?>"></td>
              </tr>
              
              <tr>
                <td><label for="email">email</label></td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
              </tr>

              <tr>
                <td><label for="wachtwoord">wachtwoord</label></td>
                <td><input type="text" name="wachtwoord" value="<?php echo $wachtwoord; ?>"></td>
              </tr>

              <tr>
                <td><label for="admin">admin</label></td>
                <td><input type="text" name="admin" value="<?php echo $admin; ?>"></td>
              </tr>
            </table>
            
            <input type="submit" name="<?php echo $submitText; ?>" value="<?php echo ucfirst($submitText); ?>">
            <input type="button" value="Clear" class="clear-form">
          </form>

          <div class="database-container">
            <h2 id="database-name"><?php echo ucfirst($database); ?></h2>
  
            <table class="database">
              <tr>
                <th>gebruikerID</th>
                <th>naam</th>
                <th>email</th>
                <th>wachtwoord</th>
                <th>admin</th>
  
                <th>Edit</th>
                <th>Delete</th>
              </tr>
  
              <?php
              $sql = "SELECT * FROM gebruikers";
              $stmt = $connect -> prepare($sql);
              $stmt -> execute();
              $result = $stmt -> fetchAll();
  
              foreach($result as $res) { ?>
                <tr>
                  <td><p><?php echo $res['gebruikerID']; ?></p></td>
                  <td><p><?php echo $res['naam']; ?></p></td>
                  <td><p><?php echo $res['email']; ?></p></td>
                  <td><p><?php echo $res['wachtwoord']; ?></p></td>
                  <td><p><?php echo $res['admin']; ?></p></td>
  
                  <td><a href="php/sendtodb.php?gebruikerID=<?php echo $res['gebruikerID']; ?>">Edit</a></td>
                  <td><a href="php/sendtodb.php?gebruikerID=<?php echo $res['gebruikerID']; ?>&delete=true">Delete</a></td>
                </tr>
              <?php } ?>
  
            </table>
          </div>
          <?php
        } else if($database == "recensies") { ?>
          <?php
            // Create values for create/update form
            $submitText = isset($_SESSION['recensieID']) ? "update" : "create";
            $recensieID = isset($_SESSION['recensieID']) ? $_SESSION['recensieID'] : "";
            $gebruikerID = isset($_SESSION['gebruikerID']) ? $_SESSION['gebruikerID'] : "";
            $reisID = isset($_SESSION['reisID']) ? $_SESSION['reisID'] : "";
            $gevalideerd = isset($_SESSION['gevalideerd']) ? $_SESSION['gevalideerd'] : "";
            $bericht = isset($_SESSION['bericht']) ? $_SESSION['bericht'] : "";
            $sterren = isset($_SESSION['sterren']) ? $_SESSION['sterren'] : "";
            $datum = isset($_SESSION['datum']) ? $_SESSION['datum'] : "";
            
            unset($_SESSION['recensieID']);
            unset($_SESSION['gebruikerID']);
            unset($_SESSION['reisID']);
            unset($_SESSION['gevalideerd']);
            unset($_SESSION['bericht']);
            unset($_SESSION['sterren']);
            unset($_SESSION['datum']);
          ?>

          <form action="php/sendtodb.php" method="post" class="create-update">
            <input type="hidden" name="table" value="recensies"> <!-- Zodat ik kan zien voor welke database de post is. -->

            <table>
              <tr>
                <td><label for="recensieID">recensieID</label></td>
                <td><input type="text" name="recensieID" value="<?php echo $recensieID; ?>" readonly></td>
              </tr>
              
              <tr>
                <td><label for="gebruikerID">gebruikerID</label></td>
                <td><input type="text" name="gebruikerID" value="<?php echo $gebruikerID; ?>"></td>
              </tr>
              
              <tr>
                <td><label for="reisID">reisID</label></td>
                <td><input type="text" name="reisID" value="<?php echo $reisID; ?>"></td>
              </tr>

              <tr>
                <td><label for="gevalideerd">gevalideerd</label></td>
                <td><input type="text" name="gevalideerd" value="<?php echo $gevalideerd; ?>"></td>
              </tr>

              <tr>
                <td><label for="bericht">bericht</label></td>
                <td><textarea type="text" name="bericht"><?php echo $bericht; ?></textarea></td>
              </tr>

              <tr>
                <td><label for="sterren">sterren</label></td>
                <td><input type="text" name="sterren" value="<?php echo $sterren; ?>"></td>
              </tr>

              <tr>
                <td><label for="datum">datum</label></td>
                <td><input type="date" name="datum" value="<?php echo $datum; ?>"></td>
              </tr>
            </table>
            
            <input type="submit" name="<?php echo $submitText; ?>" value="<?php echo ucfirst($submitText); ?>">
            <input type="button" value="Clear" class="clear-form">
          </form>

          <div class="database-container">
            <h2 id="database-name"><?php echo ucfirst($database); ?></h2>
  
            <table class="database">
              <tr>
                <th>recensieID</th>
                <th>gebruikerID</th>
                <th>reisID</th>
                <th>gevalideerd</th>
                <th>bericht</th>
                <th>sterren</th>
                <th>datum</th>
  
                <th>Edit</th>
                <th>Delete</th>
              </tr>
  
              <?php
              $sql = "SELECT * FROM recensies";
              $stmt = $connect -> prepare($sql);
              $stmt -> execute();
              $result = $stmt -> fetchAll();
  
              foreach($result as $res) { ?>
                <tr>
                  <td><p><?php echo $res['recensieID']; ?></p></td>
                  <td><p><?php echo $res['gebruikerID']; ?></p></td>
                  <td><p><?php echo $res['reisID']; ?></p></td>
                  <td><p><?php echo $res['gevalideerd']; ?></p></td>
                  <td class="long-text"><p><?php echo $res['bericht']; ?></p></td>
                  <td><p><?php echo $res['sterren']; ?></p></td>
                  <td><p><?php echo $res['datum']; ?></p></td>
  
                  <td><a href="php/sendtodb.php?recensieID=<?php echo $res['recensieID']; ?>">Edit</a></td>
                  <td><a href="php/sendtodb.php?recensieID=<?php echo $res['recensieID']; ?>&delete=true">Delete</a></td>
                </tr>
              <?php } ?>
  
            </table>
          </div>
          <?php
        } else if($database == "reizen") { ?>
          <?php
            // Create values for create/update form
            $submitText = isset($_SESSION['reisID']) ? "update" : "create";
            $reisID = isset($_SESSION['reisID']) ? $_SESSION['reisID'] : "";
            $beginDatum = isset($_SESSION['beginDatum']) ? $_SESSION['beginDatum'] : "";
            $eindDatum = isset($_SESSION['eindDatum']) ? $_SESSION['eindDatum'] : "";
            $land = isset($_SESSION['land']) ? $_SESSION['land'] : "";
            $titel = isset($_SESSION['titel']) ? $_SESSION['titel'] : "";
            $prijs = isset($_SESSION['prijs']) ? $_SESSION['prijs'] : "";
            $sterren = isset($_SESSION['sterren']) ? $_SESSION['sterren'] : "";
            $beschrijving = isset($_SESSION['beschrijving']) ? $_SESSION['beschrijving'] : "";
            
            unset($_SESSION['reisID']);
            unset($_SESSION['beginDatum']);
            unset($_SESSION['eindDatum']);
            unset($_SESSION['land']);
            unset($_SESSION['titel']);
            unset($_SESSION['prijs']);
            unset($_SESSION['sterren']);
            unset($_SESSION['beschrijving']);
          ?>

          <form action="php/sendtodb.php" method="post" class="create-update">
            <input type="hidden" name="table" value="reizen"> <!-- Zodat ik kan zien voor welke database de post is. -->

            <table>
              <tr>
                <td><label for="reisID">reisID</label></td>
                <td><input type="text" name="reisID" value="<?php echo $reisID; ?>" readonly></td>
              </tr>
              
              <tr>
                <td><label for="beginDatum">beginDatum</label></td>
                <td><input type="date" name="beginDatum" value="<?php echo $beginDatum; ?>"></td>
              </tr>
              
              <tr>
                <td><label for="eindDatum">eindDatum</label></td>
                <td><input type="date" name="eindDatum" value="<?php echo $eindDatum; ?>"></td>
              </tr>

              <tr>
                <td><label for="land">land</label></td>
                <td><input type="text" name="land" value="<?php echo $land; ?>"></td>
              </tr>

              <tr>
                <td><label for="titel">titel</label></td>
                <td><input type="text" name="titel" value="<?php echo $titel; ?>"></td>
              </tr>

              <tr>
                <td><label for="prijs">prijs</label></td>
                <td><input type="text" name="prijs" value="<?php echo $prijs; ?>"></td>
              </tr>

              <tr>
                <td><label for="sterren">sterren</label></td>
                <td><input type="text" name="sterren" value="<?php echo $sterren; ?>"></td>
              </tr>

              <tr>
                <td><label for="beschrijving">beschrijving</label></td>
                <td><textarea type="text" name="beschrijving"><?php echo $beschrijving; ?></textarea></td>
              </tr>
            </table>
            
            <input type="submit" name="<?php echo $submitText; ?>" value="<?php echo ucfirst($submitText); ?>">
            <input type="button" value="Clear" class="clear-form">
          </form>

          <div class="database-container">
            <h2 id="database-name"><?php echo ucfirst($database); ?></h2>
  
            <table class="database">
              <tr>
                <th>reisID</th>
                <th>beginDatum</th>
                <th>eindDatum</th>
                <th>land</th>
                <th>titel</th>
                <th>prijs</th>
                <th>sterren</th>
                <th>beschrijving</th>
  
                <th>Edit</th>
                <th>Delete</th>
              </tr>
  
              <?php
              $sql = "SELECT * FROM reizen";
              $stmt = $connect -> prepare($sql);
              $stmt -> execute();
              $result = $stmt -> fetchAll();
  
              foreach($result as $res) { ?>
                <tr>
                  <td><p><?php echo $res['reisID']; ?></p></td>
                  <td><p><?php echo $res['beginDatum']; ?></p></td>
                  <td><p><?php echo $res['eindDatum']; ?></p></td>
                  <td><p><?php echo $res['land']; ?></p></td>
                  <td><p><?php echo $res['titel']; ?></p></td>
                  <td><p><?php echo $res['prijs']; ?></p></td>
                  <td><p><?php echo $res['sterren']; ?></p></td>
                  <td class="long-text"><p><?php echo $res['beschrijving']; ?></p></td>
  
                  <td><a href="php/sendtodb.php?reisID=<?php echo $res['reisID']; ?>">Edit</a></td>
                  <td><a href="php/sendtodb.php?reisID=<?php echo $res['reisID']; ?>&delete=true">Delete</a></td>
                </tr>
              <?php } ?>
  
            </table>
          </div>
          <?php
        }
      } else {
        echo "Selecteer een database";
      }
    ?>
  </main>

  <!-- Footer -->
  <?php include_once("includes/footer.php"); ?>

  <!-- Scripts -->
  <script src="js/main.js"></script>
  <script src="js/clearForm.js"></script>
</body>

</html>