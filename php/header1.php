<?php

function afficheHeader() {

    /* Le eader est différent selon la page sur laquelle on se trouve */
    /* On récupère donc le nom de la page et on affiche différemment seon ce nom */

    $path = $_SERVER['PHP_SELF'];
    $file = basename($path);

    if (strcmp($file , 'home.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li class="active"><a href="home.php">Home</a></li>
                            <li><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    
    if (strcmp($file, 'agenda.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li class="active"><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    
    if (strcmp($file , 'contact.php')==0 || strcmp($file , 'contactnew.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li ><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li class="active"><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    
    if (strcmp($file ,'info.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li ><a href="agenda.php">Agenda</a></li>
                            <li class="active"><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    
    if (strcmp($file , 'verif1.php') == 0 || strcmp($file , 'verif3.php') == 0 || strcmp($file , 'verif2.php') == 0 || strcmp($file , 'inscription.php') == 0 || strcmp($file, 'inscription2.php' )==0 || strcmp($file , 'inscription3.php')==0 || strcmp($file , 'inscriptionnew2.php')==0 || strcmp($file , 'inscriptionnew3.php')==0 || strcmp($file , 'inscriptionnew.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="home.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="home.php">Home</a></li>
                            <li ><a href="agenda.php">Agenda</a></li>
                            <li><a href="info.php">Informations pratiques</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li class="active" align="right"><a href="inscription.php" style="font-weight:bold; align :right"><FONT size="4pt">Connexion/Inscription</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
}

afficheHeader();
?>
