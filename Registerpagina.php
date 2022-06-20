<!DOCTYPE html>
<html>
    <head>
        <title>Registreerpagina</title>
        <link rel="stylesheet" href="mainStyle.css">
    </head>
    <body>
        <header>                                                                                     <!--start menubar code-->
                 <a href="Homepage.php"><img class="logo" src="images/logo.png"></a> 
            <nav class="Menubar">
                <ul class="nav-links">
                    <li>
                        <a href="Homepage.php" class="Homer">Home</a>
                    </li>
                    <li>
                       <a href="Webshop.php">Domeinen</a>                              <!--Link naar Placeholder webshop -->
                    </li>
                    <li>
                        <a href="Webshop.php">Services</a>                             <!--Link naar Placeholder webshop -->
                    </li>
                    <li>
                        <a href="Webshop.php">Websites</a>                               <!--Link naar Placeholder webshop -->  
                    </li>
                    <li>
                        <a href="Bedrijfspagina.html">Over ons</a>
                    </li>
                    <li>
                        <a href="Hulppagina.php">Hulp nodig?</a>
                    </li>
                    <li>
                        <a href="Contactpagina.php">Contact</a>
                    </li>  
                </ul>
            </nav>
        </header> 
                                                                                    <!-- start forum code -->
        <main>

            <form class="registerForm" action="register.php" method= "post">
                <div class="registerBox">
                        <p>Registreren:</p>

                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                
                <label>Gebruikersnaam</label>
                <input type="text" name="username" placeholder="Gebruikersnaam">

                <label>Wachtwoord</label>
                <input type="password" name="password" placeholder="Wachtwoord">

                <label>Wachtwoord controle</label>
                <input type="password" name="re_password" placeholder="Wachtwoord">

                <button class="registerSubmit" type="submit">Registreren</button>
                </div>
                <div class= "goLogin" >
                        <a href="Loginpagina.php" class="loginGo">Terug naar inloggen!</a>
                </div>
            </form>
           
        </main>

                                                                                     <!-- start Footer code -->
        <footer>
            <div class="Contact">
                    <p>contactgegevens</p>
            </div>
            <div class= "Official"> 
                <p>Terms of Use</p>
                <p>Privacy Policy</p>
                <img src="https://via.placeholder.com/150x75" alt="Linkedin Placeholder">
                <img src="https://via.placeholder.com/150x75" alt="Facebook Placeholder">
            </div>
        </footer>
      </body>
</html>