<?php

function afficheHeader() {

    /* Le eader est différent selon la page sur laquelle on se trouve */
    /* On récupère donc le nom de la page et on affiche différemment seon ce nom */

    $path = $_SERVER['PHP_SELF'];
    $file = basename($path);

    if (strcmp($file , 'homeC.php')==0 || strcmp($file , 'verif3.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="homeC.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li class="active"><a href="homeC.php">Home</a></li>
                            <li><a href="agendaC.php">Agenda</a></li>
                            <li><a href="infoC.php">Informations pratiques</a></li>
                            <li><a href="contactC.php">Contact</a></li>
                            <li><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Panier</FONT></a></li>
                            <li ><a href="moncompte.php" style="font-weight:bold; align :right"><FONT size="4pt"> Mon compte</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    
    if (strcmp($file, 'agendaC.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="homeC.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="homeC.php">Home</a></li>
                            <li class="active"><a href="agendaC.php">Agenda</a></li>
                            <li><a href="infoC.php">Informations pratiques</a></li>
                            <li><a href="contactC.php">Contact</a></li>
                            <li ><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Panier</FONT></a></li>
                            <li ><a href="moncompte.php" style="font-weight:bold; align :right"><FONT size="4pt"> Mon compte</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    
    if (strcmp($file , 'contactC.php')==0 || strcmp($file , 'contactnewC.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="homeC.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="homeC.php">Home</a></li>
                            <li ><a href="agendaC.php">Agenda</a></li>
                            <li><a href="infoC.php">Informations pratiques</a></li>
                            <li class="active"><a href="contactC.php">Contact</a></li>
                            <li ><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Panier</FONT></a></li>
                            <li ><a href="moncompte.php" style="font-weight:bold; align :right"><FONT size="4pt"> Mon compte</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    
    if (strcmp($file ,'infoC.php')==0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="homeC.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="homeC.php">Home</a></li>
                            <li ><a href="agendaC.php">Agenda</a></li>
                            <li class="active"><a href="infoC.php">Informations pratiques</a></li>
                            <li><a href="contactC.php">Contact</a></li>
                            <li><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Panier</FONT></a></li>
                            <li ><a href="moncompte.php" style="font-weight:bold; align :right"><FONT size="4pt"> Mon compte</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    
    if (strcmp($file , 'panier.php') == 0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="homeC.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="homeC.php">Home</a></li>
                            <li ><a href="agendaC.php">Agenda</a></li>
                            <li><a href="infoC.php">Informations pratiques</a></li>
                            <li><a href="contactC.php">Contact</a></li>
                            <li class="active"><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Panier</FONT></a></li>
                            <li ><a href="moncompte.php" style="font-weight:bold; align :right"><FONT size="4pt"> Mon compte</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
    }
    if (strcmp($file , 'moncompte.php') == 0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="homeC.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="homeC.php">Home</a></li>
                            <li ><a href="agendaC.php">Agenda</a></li>
                            <li><a href="infoC.php">Informations pratiques</a></li>
                            <li><a href="contactC.php">Contact</a></li>
                            <li ><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Panier</FONT></a></li>
                            <li class="active"><a href="moncompte.php" style="font-weight:bold; align :right"><FONT size="4pt"> Mon compte</FONT></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </header>
       
    </html>';
        
    }if (strcmp($file , 'paiement.php') == 0) {
        echo' 
    <html>
         <header class="mobile">

            <div class="row">

                <div class="col full">

                    <div class="logo">
                        <a href="homeC.php" style="top : 4px"><img alt="" src="images/logo.png" style="height:  50px; width: 55px; top: 4px"></a>
                    </div>

                    <nav id="nav-wrap" >

                        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
                        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

                        <ul id="nav" class="nav">
                            <li ><a href="homeC.php">Home</a></li>
                            <li ><a href="agendaC.php">Agenda</a></li>
                            <li><a href="infoC.php">Informations pratiques</a></li>
                            <li><a href="contactC.php">Contact</a></li>
                            <li ><a href="panier.php" style="font-weight:bold; align :right"><FONT size="4pt"> Panier</FONT></a></li>
                            <li ><a href="moncompte.php" style="font-weight:bold; align :right"><FONT size="4pt"> Mon compte</FONT></a></li>
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
