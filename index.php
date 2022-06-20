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
  <link rel="stylesheet" href="css/slideshow.css">
  <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
</head>

<body>
  <!-- Navbar -->
  <?php include_once("includes/navbar.php"); ?>

  <!-- Main -->
  <main>

    <div id="row1">

      <p>
        Welkom bij Ria's, een persoonlijke en eigenwijze reisorganisatie. Voor ons is reizen het mooiste dat er is. We laten je de highlights zien, maar ook de onbekende plekken. Wij reizen veelvuldig de wereld over en creëren onze eigen routes en ervaringen. Dit doen we samen met onze partners ter plaatse zodat we jou écht het land kunnen laten zien. Het liefst zo ver mogelijk van de platgetrapte paden, dichtbij de natuur en veel in contact met de bevolking en cultuur van een land, waardoor de bevolking maximaal mee profiteert. Onze hotels zijn handpicked, kleinschalig en liggen veelal op unieke plekken. Zo brengen we je dichterbij je bestemming én zo ook dichterbij een mooiere wereld. Want als je met Ria's reist ben je ervan verzekerd dat je verantwoord reist en positief bijdraagt.
      </p>

    </div>
    <div id="row2">
      <div class="slideshow-container">
        <h2>Best beoordeelde reizen</h2>
        <?php
        $sql = "SELECT * FROM reizen WHERE sterren = 5";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $res) { ?>
          <div class="mySlides fade">
            <h1><?php echo $res['titel']; ?></h1>
            <p><img src="img/ster.png" height="15px"><?php echo $res['sterren']; ?></p>
            <p><?php echo $res['beschrijving']; ?></p>
          </div>
        <?php } ?>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

      </div>
      <div id="frankrijk">
          <a class="button"  href="reizen.php?land=frankrijk">Ontdek Frankrijk</a>
      </div>

    </div>
  </main>

  <!-- Footer -->
  <?php include_once("includes/footer.php"); ?>

  <!-- Scripts -->
  <script src="js/main.js"></script>
  <script src="js/slideshow.js"></script>
</body>

</html>