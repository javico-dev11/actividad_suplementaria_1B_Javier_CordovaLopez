<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actividad Suplementaria 1B</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Lista de alumnos</h2>
                        <a href="crud/create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo alumno</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM alumnos";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Dirección</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="crud/read.php?id='. $row['id'] .'" class="mr-3" title="Ver alumno" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="crud/update.php?id='. $row['id'] .'" class="mr-3" title="Actualizar alumno" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="crud/delete.php?id='. $row['id'] .'" title="Eliminar alumno" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No se obtuvieron resultados</em></div>';
                        }
                    } else{
                        echo "Ocurrió un error, por favor intente nuevamente!.";
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