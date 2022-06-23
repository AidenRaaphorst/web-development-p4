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
      $result = $stmt->fetchAll();

      foreach ($result as $res) { ?>
        <a class="navbutton" href="reizen.php?land=<?php echo $res['land']; ?>"><?php echo ucfirst($res['land']); ?></a>
      <?php } ?>
    </div>
    <div id="bestemmingcontainer">
      <?php

      if (isset($_GET['land'])) {
        $sql = "SELECT * FROM reizen WHERE land = :land";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":land", $_GET["land"]);
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
      } 
      else if (isset($_GET['titel'])) {
        $sql = "SELECT * FROM reizen WHERE titel = :titel";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":titel", $_GET["titel"]);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $res) { ?>
          <div class="bestemminggroot">
            <h1>
              <?php echo ucfirst($res['titel']); ?>
              <a href="php/boeken.php?reisID=<?php echo $res['reisID'] ?>"><button class="boeken">Boeken</button></a>
            </h1>
            <p id="datum"><?php echo "Van ".$res['beginDatum']." tot ".$res['eindDatum']; ?></p>
            <p><img src="img/ster.png" height="20px"><?php echo $res['sterren']; ?></p> 
            <p><?php echo "€".$res['prijs']; ?></p>
            <p id="beschrijving"><?php echo $res['beschrijving']; ?></p>
            <img class="bestemmingimg" src="<?php echo $res['img'] ?>" alt="plaatje van de bestemming" height="500px" width="auto">
          </div>
        <?php }
      }
      else {
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