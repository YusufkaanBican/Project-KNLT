<?php 

  $conn = mysqli_connect('localhost','root','','mboopen'); // database connectie 

// Schrijf query van alle reserveringen
  $sql = 'SELECT * FROM `aanmelding`'; 

  // Maak query & krijg het overzicht
  $resultaat = mysqli_query($conn, $sql);

?>

<!-- HTML GEDEELTE -->
<!DOCTYPE html>
<html>
<head>
  <title>Overzicht</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

  table {  
   width: 75%;     
   position: absolute;  
   margin-left: 200px;
   margin-top: 10px;
   }  
    </style>
    </head>
    <body> 
    <!--NAVIGATIEBAR -->
   <a href="home.php"><img src="logo.png" style="width:170px; height:150px;"></a>        
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
    </div>
    <!--TABEL OVERZICHT IN HTML -->

    <div class="content">
      <table border="1" cellspacing="0" cellpadding="0">
        <t>
          <th>Naam</th>
          <th>School</th>
          <th>Toernooi</th>

        </t>

        <?php
         // FETCH RESULTAAT OM ALLE DETAILS VAN DEELNEMER TE LATEN ZIEN
          while ($rows = mysqli_fetch_assoc($resultaat))
          {
            ?>

            <tr>
              <td><?php echo $rows['Naam']; ?></td>
              <td><?php echo $rows['School']; ?></td>
              <td><?php echo $rows['Toernooi']; ?></td>
   

              </tr> 
                <?php
              }
            ?>
 <br/>
  <div class="container">
   <div class="row">
    <div class="col-md-9" style="margin-left: 200px;">
     <span id="message"></span>
     <form method="post" id="import_form" enctype="multipart/form-data">
      <div class="form-group">
       <label>Importeer gegevens vanuit XML bestand</label>
       <input type="file" name="file" id="file" />
      </div>
      <br />
      <div class="form-group">
       <input type="submit" name="submit" id="submit" class="btn btn-info" value="Import" />
      </div>
     </form>
    </div>
   </div>
  </div>

  </body>

</html>
<!-- AJAX FUNCTIE VOOR SUBMIT BUTTON -->
<script> 
$(document).ready(function(){
 $('#import_form').on('submit', function(event){
  event.preventDefault();

  $.ajax({
   url:"aanmeldingen-import.php",
   method:"POST",
   data: new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   beforeSend:function(){
    $('#submit').attr('disabled','disabled'),
    $('#submit').val('Importing...');
   },
   success:function(data)
   {
    $('#message').html(data);
    $('#import_form')[0].reset();
    $('#submit').attr('disabled', false);
    $('#submit').val('Import');
   }
  })

  setInterval(function(){
   $('#message').html('');
  }, 5000);

 });
});
</script>
