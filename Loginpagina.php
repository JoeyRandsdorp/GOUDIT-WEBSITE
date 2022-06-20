<?php
session_start();                    //start session
/** @var mysqli $db */

require_once "connect.php";
$login = false;                         //zet de default value voor $login

if (isset($_SESSION['loggedInUser'])) {                 //als je ingelogd bent wordt je doorgestuurd naar adminpagina
    header("Location: Adminpagina.php");
    exit;
}
if (isset($_POST['submit'])) {
        $userName = mysqli_escape_string($db, $_POST['username']); //beveilig username
        $password = $_POST['password'];

        $query = "SELECT * FROM account WHERE Username='$userName'";        //selecteer de Username en wachtwoord vanaf de database
        $result= mysqli_query($db, $query) or die('Error: ' . $query);     //ter vergelijking
        $user = mysqli_fetch_assoc($result);

        $errors = [];                                   //maak een array aan
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedInUser'] = [                           //start een session
                    'username' => $user['username'],                    //wat ervoor zorgt dat hij herkenbaar blijft
                    'Customer_ID' => $user['Customer_ID']
                ];

                header("Location: Adminpagina.php");               //met succes stuur door naar de adminpagina
                exit;
            } else {
                $errors[] = 'Helaas, uw inloggegevens zijn niet juist'; //error messages
            }
        } else {
            $errors[] = 'Helaas, uw inloggegevens zijn niet juist';
        }

        if(mysqli_num_rows($result) == 1){                      //controleer het wachtwoord
           $user = mysqli_fetch_assoc($result);
           if(password_verify($password, $user['password'])){
                $login = true;
           }else{

           }
        }else{

        }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Loginpagina</title>
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

   <?php if ($login) {?>                    //message voor als inloggen gelukt is
                  <p>Inloggen gelukt</p>
   <?php } else { ?>
            <form class="loginForm" action="login.php" method= "post">
                <div class="loginBox">
                <p>Inloggen:</p>

 <?php if (isset($_GET['error'])) { ?>                                  //error message
 <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
                <label>Gebruikersnaam</label>
                <input type="text" name="username" placeholder="Gebruikersnaam">

                <label>Wachtwoord</label>
                <input type="password" name="password" placeholder="Wachtwoord">
                <input class="loginSubmit" value="Login" type="submit"></input>
                </div>
                <div class= "goRegister" >
                     <a class= "registerGo" href = Registerpagina.php>Hier registeren!</a>
                </div>
            </form>
  <?php } ?>

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

