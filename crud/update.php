<?php

require_once "../config/config.php";
 

$name = $address = $salary = "";
$name_err = $address_err = $email_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese un nombre.";
    } else{
        $name = $input_name;
    }
    
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Por favor ingrese una dirección.";     
    } else{
        $address = $input_address;
    }
    
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Por favor ingrese un email";     
    } else{
        $email = $input_email;
    }
    
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        
        $sql = "UPDATE alumnos SET name=?, address=?, email=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_email, $param_id);
       
            $param_name = $name;
            $param_address = $address;
            $param_email = $email;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: ../index.php");
                exit();
            } else{
                echo "Ocurrió un error, por favor intente más tarde.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM alumnos WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $name = $row["name"];
                    $address = $row["address"];
                    $email = $row["email"];
                } else{
                    
                    header("location: ../error.php");
                    exit();
                }
                
            } else{
                echo "Ocurrió un error, por favor intente más tarde..";
            }
        }
        
        mysqli_stmt_close($stmt);
        
        mysqli_close($link);
    }  else{
        header("location: ../error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar alumno</title>
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
                    <h2 class="mt-5">Actualizar alumno</h2>
                    <hr>
                    <p>Por favor ingrese todos los valores antes de actualizar.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <hr>
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>