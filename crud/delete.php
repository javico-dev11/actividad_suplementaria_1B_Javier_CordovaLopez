<?php

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    require_once "../config/config.php";
    
    $sql = "DELETE FROM alumnos WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
     
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_POST["id"]);
    
        if(mysqli_stmt_execute($stmt)){
            
            header("location: ../index.php");
            exit();
        } else{
            echo "Ocurrió un error!.";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
} else{
    if(empty(trim($_GET["id"]))){
       
        header("location: ../error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrar alumno</title>
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
                    <h2 class="mt-5 mb-3">Eliminar alumno</h2>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Está seguro de querer eliminar el alumno seleccionado?</p>
                            <p>
                                <input type="submit" value="Sí" class="btn btn-danger">
                                <a href="../index.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>