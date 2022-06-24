<?php
session_start();
include_once("php/connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ria's</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/nav-foot.css">
  <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600&family=Neonderthaw&family=Noto+Sans&display=swap" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <?php include_once("includes/navbar.php"); ?>

  <!-- Main -->
  <main id="bestemmingmain">
    <div id="bestemmingknoppen">
      <a class="navbutton" href="reizen.php">Alle landen</a>
      <?php
      $sql = "SELECT DISTINCT land FROM reizen ORDER BY land ASC";
      $stmt = $connect->prepare($sql);
      $stmt->execute();
      $landen = $stmt->fetchAll();

      foreach ($landen as $land) { ?>
        <a class="navbutton" href="reizen.php?land=<?php echo $land['land']; ?>"><?php echo ucfirst($land['land']); ?></a>
      <?php } ?>
    </div>
    <div id="bestemmingcontainer">
      <?php

      if (isset($_GET['land'])) {
        $sql = "SELECT * FROM reizen WHERE land = :land";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":land", $_GET['land']);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $res) { ?>
          <div class="bestemming">
            <p>
              <?php echo ucfirst($res['titel']); ?>
              <a href="reizen.php?titel=<?php echo $res['titel']; ?>"><button class="leesmeer" >Lees meer</button></a>
            </p>
            <img src="<?php echo $res['img'] ?>" alt="plaatje van de bestemming" height="230px">
          </div>
        <?php }
      } else if (isset($_GET['titel'])) {
        $sql = "SELECT * FROM reizen WHERE titel = :titel";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":titel", $_GET['titel']);
        $stmt->execute();
        $reizen = $stmt->fetchAll();

        foreach ($reizen as $reis) { ?>
          <div class="bestemminggroot">
            <h1>
              <?php echo ucfirst($reis['titel']); ?>
              <a href="php/boeken.php?reisID=<?php echo $reis['reisID'] ?>"><button class="boeken">Boeken</button></a>
            </h1>
            <p id="datum"><?php echo "Van ".$reis['beginDatum']." tot ".$reis['eindDatum']; ?></p>
            <p id="sterren"><img src="img/ster.png" height="20px"><?php echo $reis['sterren']; ?></p> 
            <p id="prijs"><?php echo "€".$reis['prijs']; ?></p>
            <p id="beschrijving"><?php echo $reis['beschrijving']; ?></p>
            <img class="bestemmingimg" src="<?php echo $reis['img'] ?>" alt="plaatje van de bestemming" height="500px" width="auto">

            <?php if(isset($_SESSION['userinfo'])) { ?>
              <h2 id="recensie-toevoegen">Recensie Schrijven</h2>
              <div class="recensie-toevoegen">
                <form action="php/recensie.php" method="post">
                  <!-- <div class="sterren-container"> -->
                    <label for="sterren">Sterren:</label>
                    <select name="sterren" id="rec-sterren">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  <!-- </div> -->

                  <!-- <div class="bericht-container"> -->
                    <label for="bericht">Bericht:</label>
                    <textarea type="text" name="bericht"></textarea>
                  <!-- </div> -->

                  <input name="reisID" value="<?php echo $reis['reisID'] ?>" hidden>

                  <input id="rec-submit" type="submit" name="recensie" value="Recensie toevoegen">
                </form>
              </div>
            <?php } ?>

            <h2 id="recensies">Recensies</h2>
            <div class="recensies">
              <?php
              $sql = "SELECT * FROM recensies WHERE reisID = :reisID AND gevalideerd = 2 ORDER BY datum DESC";
              $stmt = $connect->prepare($sql);
              $stmt->bindParam(":reisID", $reis['reisID']);
              $stmt->execute();
              $recensies = $stmt->fetchAll();

              foreach($recensies as $recensie) {
                $sql = "SELECT * FROM gebruikers WHERE gebruikerID = :gebruikerID";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(":gebruikerID", $recensie['gebruikerID']);
                $stmt->execute();
                $gebruiker = $stmt->fetch();
                ?>

                <div class="recensie">
                  <div class="data-container">
                    <p id="naam"><?php echo $gebruiker['naam']; ?></p>
                    <div class="data">
                      <?php
                      for ($i=0; $i < $recensie['sterren']; $i++) { ?>
                        <img src="img/ster.png" height="20px">
                      <?php }
                      $months = array(
                        "januari",
                        "februari",
                        "maart",
                        "april",
                        "mei",
                        "juni",
                        "juli",
                        "augustus",
                        "septemper",
                        "oktober",
                        "november",
                        "december"
                      );

                      $time = strtotime($recensie['datum']);
                      $day = date("d", $time);
                      $month = $months[date("m", $time) - 1];
                      $year = date("Y", $time);
                      
                      ?>
                      <p id="datum"><?php echo $day." ".$month." ".$year ?></p>
                    </div>
                  </div>

                  <p id="bericht"><?php echo $recensie['bericht']; ?></p> 
                </div>
              <?php } ?>
            </div>
          </div>
        <?php }
      } else {
        if(isset($_GET['search'])) {
          $search = "%".$_GET['search']."%";
          $sql = "SELECT * FROM reizen WHERE land LIKE :search1 OR titel LIKE :search2 OR beschrijving LIKE :search3";
          $stmt = $connect->prepare($sql);
          $stmt->bindParam(":search1", $search);
          $stmt->bindParam(":search2", $search);
          $stmt->bindParam(":search3", $search);
          $stmt->execute();
          $result = $stmt->fetchAll();
        } else {
          $sql = "SELECT * FROM reizen";
          $stmt = $connect->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll();
        }

        foreach ($result as $res) { ?>
          <div class="bestemming">
            <p><?php echo ucfirst($res['titel']);?> <a href="reizen.php?titel=<?php echo $res['titel']; ?>"> <button class="leesmeer" >Lees meer</button></a></p>
            <img src="<?php echo $res['img'] ?>" alt="plaatje van de bestemming" height="230px">
          </div>
      <?php }
      } ?>
    </div>
  </main>


  <!-- Scripts -->
  <script src="js/main.js"></script>
</body>

</html>