<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- OPMAAK VAN DE WEBSITE-->
    <style>
          margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  text-align: left;
  } 
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
  .grid-container{
  margin: 15px 4px 4px 4px;
  text-align: center;
}
  .content{
    margin: 100px;
  }
  .wrapper{
   width: 600px;
   margin: 0 auto;
   }
   table tr td:last-child{
   width: 120px;
   }

    </style>
    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    </head>
    <body>
      <!--NAVIGATIEBAR -->
    <img src="logo.png" style="width:170px; height:150px;">        
    <div class="navbar">
    <div class="welkomm">
          <h1 style="color: white"> Handmatig beheren</h1>  
    </div> 
    
    <a class="active"  href="home.php">Home</a>
    <a href="speler.php">Spelergegevens beheren</a>
    <a href="beheer.php">Spelers handmatig beheren</a>
    <a href="aanmeldingen.php">Aanmeldingen importeren</a>
    <a href="beheer-aan.php" style="margin-left: 970px;">Aanmeldingen handmatig beheren</a>
    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Aanmeldingen handmatig beheren</h2>
                        <a href="create-1.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Meld aan</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM aanmelding";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                    
                                        echo "<th>Naam</th>";
                                        echo "<th>School</th>";
                                        echo "<th>Toernooi</th>";
                                    
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                       // LAAT DE DATA WEERGEVEN
                                        echo "<td>" . $row['Naam'] . "</td>";
                                        echo "<td>" . $row['School'] . "</td>";
                                        echo "<td>" . $row['Toernooi'] . "</td>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
  </body>
</html>