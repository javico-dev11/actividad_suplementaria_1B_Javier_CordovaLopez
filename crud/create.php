<?php
// Incluir el archivo de configuración
require_once "../config/config.php";
 
// Inicializar variables
$name = $address = $email = "";
$name_err = $address_err = $email_err = "";
 
// Procesar información del formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validación del nombre
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese un nombre.";
    }  else{
        $name = $input_name;
    }
    
    // Validación de la dirección
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Por favor ingrese una dirección.";     
    } else{
        $address = $input_address;
    }
    
    // Validación email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Por favor ingrese un email.";     
    
    } else{
        $email = $input_email;
    }
    
    // Verificar errores antes del INSERT
    if(empty($name_err) && empty($address_err) && empty($email_err)){
        
        $sql = "INSERT INTO alumnos (name, address, email) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_email);
            
            $param_name = $name;
            $param_address = $address;
            $param_email = $email;
            
            
            if(mysqli_stmt_execute($stmt)){
                // Se ejecuto correctamente. 
                header("location: ../index.php");
                exit();
            } else{
                echo "Ocurrión un error, intente nuevamente!.";
            }
        }
         
        // Cerrar conexión db
        mysqli_stmt_close($stmt);
    }
    
    // Cerrar conexión
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear nuevo alumno</title>
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
                    <h2 class="mt-5">Crear nuevo registro</h2>
                    <hr>
                    <p>Por favor ingrese todos los campos.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                            <input type="email" name="email" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <hr>
                        <input type="submit" class="btn btn-primary" value="Crear">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>