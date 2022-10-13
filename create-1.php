<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$Naam = $School = $Toernooi = "";
$Naam_err = $School_err = $Toernooi_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
     // Validate ID
  
    // Validate Naam
    $input_Naam = trim($_POST["Naam"]);
    if(empty($input_Naam)){
        $Naam_err = "Please enter a name.";
    } elseif(!filter_var($input_Naam, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Naam_err = "Please enter a valid name.";
    } else{
        $Naam = $input_Naam;
    }
      // Validate School
    $input_School = trim($_POST["School"]);
    if(empty($input_School)){
        $School_err = "Please enter a name.";
    } elseif(!filter_var($input_School, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $School_err = "Please enter a valid name.";
    } else{
        $School = $input_School;
    }

      $input_Toernooi = trim($_POST["Toernooi"]);
    if(empty($input_Toernooi)){
        $Toernooi_err = "Please enter a name.";
    } elseif(!filter_var($input_Toernooi, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Toernooi_err = "Please enter a valid name.";
    } else{
        $Toernooi = $input_Toernooi;
    }
   

    // Check input errors before inserting in database
    if(empty($Naam_err) && empty($School_err) && empty($Toernooi_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO aanmelding (Naam, School, Toernooi) VALUES (?, ?, ?)";

         if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_Naam, $param_School, $param_Toernooi);

            // Set parameters
          
            $param_Naam = $Naam;
            $param_School = $School;
            $param_Toernooi = $Toernooi;

             // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: beheer-aan.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voeg</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Voeg gegevens toe</h2>
                    <p>Schrijf hier de gegevens en het wordt toegevoegd in de database</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        
                        <div class="form-group">
                            <label>Naam</label>
                            <input type="text" name="Naam" class="form-control <?php echo (!empty($Naam_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Naam; ?>">
                            <span class="invalid-feedback"><?php echo $Naam_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>School</label>
                            <textarea name="School" class="form-control <?php echo (!empty($School_err)) ? 'is-invalid' : ''; ?>"><?php echo $School; ?></textarea>
                            <span class="invalid-feedback"><?php echo $School_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Toernooi</label>
                            <input type="text" name="Toernooi" class="form-control <?php echo (!empty($Toernooi_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Toernooi; ?>">
                            <span class="invalid-feedback"><?php echo $Toernooi_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Voeg">
                        <a href="beheer-aan.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>