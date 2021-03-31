<?php 
    $cons_usuario="root";
    $cons_contra="";
    $cons_base_datos="agenda_covid";
    $cons_equipo="localhost";
    
    $obj_conexion = mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);

    if(!$obj_conexion){

        echo '<script>alert("No se ha podido conectar PHP - MySQL, Intetelo mas tarde.")</script>';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agenda Covid</title>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <header id="head" class="header">

        <div class="containerHeader">
            <img id="imgHeader" src="./images/headerImage.png" alt="">
            <nav>

                <label for="touch"><span>MENU</span></label>               
                <input type="checkbox" id="touch"> 
                <ul class="slide">
                   <li><a href="schedule.php">Agendar</a></li> 
                    <li><a href="consult.php">Consultar</a></li>
                    <li><a href="delete.php">Borrar</a></li>
                    <li><a href="consultGroups.php">Consultar Grupos</a></li>
                </ul>

            </nav> 
        </div>

    </header>
    <!-- /header -->

    <form action="#" method="POST" accept-charset="utf-8">
        <div id="contentHome" class="container">
            <div id="tle" class="tittle">
            <h1>AGENDA COVID</h1>
        </div>

        <div id="conslt" class="consult-ci">
            <h2>CONSULTAR AGENDA</h2>
            <input type="number" name="cedula" value="" placeholder="C.I">
        </div>
        <button type="submit" name="consult"  > CONSULTAR</button>
        </div>
        
    </form>
</body>
</html>

<?php 
    if (isset($_POST['consult'])){

        $ci = $_POST['cedula'];

        $var_consulta= "SELECT * FROM agenda WHERE idUser = $ci;";

        $var_resultado = mysqli_query($obj_conexion, $var_consulta);
        $var_filas = mysqli_fetch_array($var_resultado);

        if ($var_resultado->num_rows>0) {
                echo '<div class="info-date" id="dateInfo">
            <h2 class="text" id="textWelDates">Bienvenido, su fecha de vacunacion sera: </h2>
            <a class="textDates" id="textDateOne">'.$var_filas[2].'</a> - <a class="textDates" id="textDateTwo">'.$var_filas[3].'</a>
        </div>';
            }else {
             echo '<script>
                alert("Hubo un error al ingresar o recibir los datos, porfavor intentelo mas tarde.")
                </script>
                ';
        }}
        
 ?>