<!-- JE MOET INGELOGD ZIJN OM DE PAGINA HOME.PHP TE KUNNEN BEZOEKEN  -->


<!-- HTML GEDEELTE -->
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Home</title>
  
  <!--OPMAAK VAN DE WEBSITE -->
	<style> 
body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: green;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 56px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
.welkom{
  margin-left: 10px;
}
</style>
</head>
<body> 
    <!--NAVIGATIEBAR -->
    <img src="logo.png" style="width:170px; height:150px;">        
    <div class="navbar">
    <div class="welkom">
          <h1 style="color: white"> Welkom</h1>  <!--LAAT GEBRUIKERSNAAM ZIEN OP HOME PAGE -->
    </div> 

    <div class="dropdown">
    <button class="dropbtn">Basisgegevens 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="speler.php">Spelers</a>
      <a href="#">Scholen</a>
      <a href="#">Toernooien</a>
    </div>
  </div>
   
   <div class="dropdown">
    <button class="dropbtn">Aanmelden 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="beheer.php">Handmatig spelers</a>
      <a href="beheer-aan.php">Handmatig aanmelden</a>
      <a href="aanmeldingen.php">Importeren</a>
      <a href="#">Sluiten</a>
    </div>
  </div> 

   <div class="dropdown">
    <button class="dropbtn">Wedstrijden 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Toernooioverzicht</a>
      <a href="#">Uitslagen beheren</a>
      <a href="#">Indelen volgende ronde</a>
    </div>
  </div> 
</div>

</div>

</div>

    <!-- Tekst -->
    <div class="content">
          <H3 style="margin: 100px;">Lorem</H3>
          <p style="margin: 100px; margin-top: -50px;">Lorem Ipsum – tas ir teksta salikums, kuru izmanto poligrāfijā un maketēšanas darbos. Lorem Ipsum ir kļuvis par vispārpieņemtu teksta aizvietotāju kopš 16. gadsimta sākuma. Tajā laikā kāds nezināms iespiedējs izveidoja teksta fragmentu, lai nodrukātu grāmatu ar burtu paraugiem. Tas ir ne tikai pārdzīvojis piecus gadsimtus, bet bez ievērojamām izmaiņām saglabājies arī mūsdienās, pārejot uz datorizētu teksta apstrādi u kopš 16. gadsimta sākuma. Tajā laikā kāds nezināms iespiedējs izveidoja teksta fragmentu, lai nodrukātu grāmatu ar burtu paraugiem. Tas ir ne tikai pārdzīvojis piecus gadsimtus, bet bez ievērojamām izmaiņām saglabājies arī mūsdienās, pārejot uz datorizētu teksta apstrādi</p>
    </div>

    <!--FOOTER VAN DE WEBSITE -->
    <footer>
    <div class="footer" style="text-align: center">
    </br>
      <h2 style="color: white;"> KNLTB</h2>
      <p4 style="color: white;">
      KNLTB B.V <br/>
      3243 AR Hilversum  <br/>
      KNLTB@tennis.nl  <br/> </p>
      Tel. 035 50 00 000
    </br> 
    </div>
    </footer>

    </div>
   </div>
  </body>
</html>