<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM spelers WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gegevens</title>
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
                    <h1 class="mt-5 mb-3">Gegevens</h1>
                    <div class="form-group">
                        <label>ID</label>
                        <p><b><?php echo $row["ID"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Voornaam</label>
                        <p><b><?php echo $row["Voornaam"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Achternaam</label>
                        <p><b><?php echo $row["Achternaam"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>SchoolID</label>
                        <p><b><?php echo $row["SchoolID"]; ?></b></p>
                    </div>
                    <p><a href="beheer.php" class="btn btn-primary">Terug</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>