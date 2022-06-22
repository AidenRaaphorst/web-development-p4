<div id="navbar">
  <a href="index.php"><img src="img/riasreizenlogo.png" height="150px"></a>
  <a class="navbutton" href="index.php">Home</a>
  <div class="dropdown navbutton">
    <p>Bestemmingen</p>
    <div class="dropdown-content">
      <div>
        <?php
        $sql = "SELECT DISTINCT land FROM reizen ORDER BY land ASC";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        foreach ($result as $res) { ?>
          <a class="navbutton" href="reizen.php?land=<?php echo $res['land']; ?>"><?php echo ucfirst($res['land']); ?></a>
        <?php } ?>
      </div>
    </div>
  </div>
  <a class="navbutton" href="over.php">Over ons</a>
  <a class="navbutton" href="contact.php">Contact</a>

  <?php
    if(!isset($_SESSION['userinfo'])) { ?>
      <a class="navbutton" href="login.php">Inloggen</a>
    <?php } else { ?>
      <p id="account-button" class="navbutton">Account</p>
      <div class="account-dropdown">
        <div class="account-dropdown-name">
          <h2><?php echo $_SESSION['userinfo']['naam']; ?></h2>
        </div>

        <div class="account-dropdown-boekingen">
          <h3>Boekingen:</h3>
          <ul>
            <?php
              $sql = "SELECT * FROM boekingen WHERE gebruikerID = :gebruikerID ORDER BY datum DESC";
              $stmt = $connect -> prepare($sql);
              $stmt -> bindParam(":gebruikerID", $_SESSION['userinfo']['gebruikerID']);
              $stmt -> execute();
              $boekingen = $stmt -> fetchAll();

              foreach($boekingen as $boeking) { 
                $sql = "SELECT * FROM reizen WHERE reisID = :reisID";
                $stmt = $connect -> prepare($sql);
                $stmt -> bindParam(":reisID", $boeking['reisID']);
                $stmt -> execute();
                $reis = $stmt -> fetch();

                if($reis) { ?>
                  <li>
                    <?php echo ucfirst($reis['land']).": ".ucfirst($reis['titel']); ?>
                    <a href="php/boekingAnnuleren.php?reisID=<?php echo $reis['reisID']; ?>"><b>(Annuleren)</b></a>
                  </li>
                <?php } ?>
              <?php } ?>
          </ul>
        </div>

        <div class="account-dropdown-misc">
          <a href="php/logout.php"><b>Uitloggen</b></a>
        </div>
      </div>
  <?php } ?>
  
  <div class="navbutton search">
    <form action="reizen.php" method="post">
      <label for="search">Search: </label>
      <input type="text" name="search" placeholder="Zoeken...">
    </form>
  </div>
</div>