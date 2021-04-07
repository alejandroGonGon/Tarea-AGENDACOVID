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
            <h2>CEDULA</h2>
            <input type="number" name="cedula" value="" placeholder="C.I">
            <h2>TELEFONO</h2>
            <input type="number" name="telefono" value="" placeholder="Phone">
            <h2>GRUPO</h2>
           <select class="form-select" aria-label="Default select example" name="selectGroups">
                 <option selected>Selecciona un Grupo</option>
                <option value="1">Personal CTI</option>
                <option value="2">Hisopadores</option>
                <option value="3">Personal Salud General</option>
                <option value="4">Personal Educacion</option>
                <option value="5">Bomberos</option>
                <option value="6">Policia</option>
                <option value="7">Personal Residencia</option>
                <option value="8">Otros</option>
            </select>
        </div>
        <button type="submit" name="agendar" > AGENDAR</button>
        </div>
    </form>
        <footer>
            
        </footer>

</body>
</html>

<?php 
    if (isset($_POST['agendar'])){

        $ci = $_POST['cedula'];
        $phone = $_POST['telefono'];
        $idGroup = $_POST['selectGroups'];

        $fecha1 = date('Y-m-d', strtotime('+1 weeks'));
        $fecha2 = date('Y-m-d', strtotime('+1 month', strtotime($fecha1)));

        $var_consulta= "SELECT * FROM Users WHERE idUser = $ci";

        $var_resultado = mysqli_query($obj_conexion, $var_consulta);

        if ($var_resultado->num_rows>0) {

            $var_consulta_serchAgenda = "SELECT * FROM agenda WHERE idUser = $ci";
            
             $var_resultadoPhone = mysqli_query($obj_conexion, $var_consulta_serchAgenda);

             if ($var_resultadoPhone->num_rows>0) {
                echo '<script>
                alert("Ya tienes una fecha agendada.")
                </script>
                ';
                    } else {
                 
                $var_consulta_phones = "INSERT INTO phones VALUES ($ci, $phone)";
                $var_consulta_agenda = "INSERT INTO agenda VALUES ($ci, $idGroup, '$fecha1', '$fecha2')";

                $var_resultadoPhone = mysqli_query($obj_conexion, $var_consulta_phones);
                $var_resultadoAgenda = mysqli_query($obj_conexion, $var_consulta_agenda);

              echo '<script>
                alert("Registro exitoso!")
                </script>
                ';
             }
             
        } else {
             echo '<script>
                alert("Ingrese una Cedula valida.")
                </script>
                ';
        };
    }
 ?>