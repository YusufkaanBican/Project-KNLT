<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$ID = $Voornaam = $Achternaam = $SchoolID = "";
$ID_err =$Voornaam_err = $Achternaam_err = $SchoolID_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    // Get hidden input value
    $id = $_POST["ID"];
    
    // Validate ID
    $input_ID = trim($_POST["ID"]);
    if(empty($input_ID)){
        $ID_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_ID)){
        $ID_err = "Please enter a positive integer value.";
    } else{
        $ID = $input_ID;
    }
    // Validate Voornaam
    $input_Voornaam = trim($_POST["Voornaam"]);
    if(empty($input_Voornaam)){
        $Voornaam_err = "Please enter a name.";
    } elseif(!filter_var($input_Voornaam, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Voornaam_err = "Please enter a valid name.";
    } else{
        $Voornaam = $input_Voornaam;
    }
      // Validate Achternaam
    $input_Achternaam = trim($_POST["Achternaam"]);
    if(empty($input_Achternaam)){
        $Achternaam_err = "Please enter a name.";
    } elseif(!filter_var($input_Achternaam, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Achternaam_err = "Please enter a valid name.";
    } else{
        $Achternaam = $input_Achternaam;
    }
       // Validate ID
    $input_SchoolID = trim($_POST["SchoolID"]);
    if(empty($input_SchoolID)){
        $SchoolID_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_SchoolID)){
        $SchoolID_err = "Please enter a positive integer value.";
    } else{
        $SchoolID = $input_SchoolID;
    }

    // Check input errors before inserting in database
        if(empty($ID_err) && empty($Voornaam_err) && empty($Achternaam_err) && empty($SchoolID_err)){
        // Prepare an update statement
        $sql = "UPDATE spelers SET Voornaam=?, Achternaam=?, SchoolID=? WHERE ID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_ID, $param_Voornaam, $param_Achternaam, $param_SchoolID);
            
            // Set parameters
            $param_ID = $ID;
            $param_Voornaam = $Voornaam;
            $param_Achternaam = $Achternaam;
            $param_SchoolID = $SchoolID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: beheer.php");
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM spelers WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $ID = $row["ID"];
                    $Voornaam = $row["Voornaam"];
                    $Achternaam = $row["Achternaam"];
                     $SchoolID = $row["SchoolID"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="ID" class="form-control <?php echo (!empty($ID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ID; ?>">
                            <span class="invalid-feedback"><?php echo $ID_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Voornaam</label>
                            <input type="text" name="Voornaam" class="form-control <?php echo (!empty($Voornaam_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Voornaam; ?>">
                            <span class="invalid-feedback"><?php echo $Voornaam_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Achternaam</label>
                            <textarea name="Achternaam" class="form-control <?php echo (!empty($Achternaam_err)) ? 'is-invalid' : ''; ?>"><?php echo $Achternaam; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Achternaam_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>SchoolID</label>
                            <input type="text" name="SchoolID" class="form-control <?php echo (!empty($SchoolID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $SchoolID; ?>">
                            <span class="invalid-feedback"><?php echo $SchoolID_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="beheer.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>