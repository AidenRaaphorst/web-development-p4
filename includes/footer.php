<footer>
  <h1>Vragen?</h1>
  <div id="container1">
    <!-- Footer Left side -->
    <div id="footerleft">
    <form id="contactform" name="contactform" action="php/contactbackend.php" method="post">
        <label >naam</label>
        <input type="text" maxlength="32" name="naam" required>

        <label >email</label>
        <input type="text" maxlength="32" name="email" required>

        <label >bericht</label>
        <textarea type="text" name="bericht" maxlength="255" required></textarea>

        <input type="submit" name="berichtsubmit" value="verstuur">
      </form>
    </div>

    <!-- Footer Right side -->
    <div id="footerright">
      <h1> Meer vragen? Neem gerust contact met ons op via:</h1>
      <br>
      <h2>Mail</h2>
      <p>mail.mail.com</p>
      <br>
      <h2>telefoon</h2>
      <p>123456678</p>
    </div>
  </div>

</footer>