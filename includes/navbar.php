<div id="navbar">
  <a href="index.php"><img src="img/riasreizenlogo.png" height="150px"></a>
  <a class="navbutton" href="index.php">home</a>
  <a class="navbutton" href="over.php">over</a>
  <div class="dropdown navbutton">
    <p>bestemmingen</p>
    <div class="dropdown-content">
      <div>
        <?php 
          $sql = "SELECT DISTINCT land FROM reizen ORDER BY land ASC";
          $stmt = $connect -> prepare($sql);
          $stmt -> execute();
          $result = $stmt -> fetchAll();

          foreach($result as $res) { ?>
            <a class="navbutton" href="reizen.php?land=<?php echo $res['land']; ?>"><?php echo $res['land']; ?></a>
          <?php } ?>

        <a class="navbutton" href="#">Link 1</a>
        <a class="navbutton" href="#">Link 2</a>
      </div>
    </div>
  </div>
  <a class="navbutton" href="contact.php">contact</a>
</div>