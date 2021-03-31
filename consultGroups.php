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
            <button type="submit" name="consultGroup" > CONSULTAR USUARIOS POR <strong>GRUPO</strong></button>
            <button type="submit" name="consultAge"> CONSULTAR USUARIOS POR <strong>EDAD</strong></button>
        </div>
        <div class="consultGroups">
            <?php 
    if (isset($_POST['consultGroup'])){
       
       for ($i=1; $i <= 8 ; $i++) { 

            $var_consulta= "SELECT * FROM agenda WHERE idGroup = $i;";
            $var_consultaNames = "select name from groups where idGroup = $i;";

            $var_resultado = mysqli_query($obj_conexion, $var_consulta);
            $var_resultadoNames = mysqli_query($obj_conexion, $var_consultaNames);

            $num = $var_resultado->num_rows;

            while ($row =$var_resultadoNames->fetch_assoc()) {
                echo "<p> <strong>".$row['name']."</strong> tiene <strong> " .$num."</strong> usuarios agendados </p>";
            }
       }
            }elseif (isset($_POST['consultAge'])) {
                 
                $var_consultaAgendaId = "SELECT idUser FROM agenda;";
                $var_resultadosAgendaId = mysqli_query($obj_conexion, $var_consultaAgendaId);
                $var_grupo18 = 0;
                $var_grupo31 = 0;
                $var_grupo51 = 0;
              while ($row = mysqli_fetch_array($var_resultadosAgendaId)) {

                    $var_idUser = $row['idUser'];
                    $var_consultaUsersBirth= "SELECT birth FROM Users WHERE idUser = $var_idUser;";
                    $var_resultadosUsersBirth = mysqli_query($obj_conexion, $var_consultaUsersBirth);

                    while ($row2 = mysqli_fetch_array($var_resultadosUsersBirth)) {
                        
                        $var_fechaNacimiento = $row2['birth'];
                        $var_fechaActual = date("Y") .'-'. date("m") .'-'. date("d");
                        $var_edad = (int)$var_fechaActual - (int)$var_fechaNacimiento;
                        

                         if ($var_edad  >= 18 && $var_edad <= 30) {
                             $var_grupo18 = $var_grupo18 +1;
                         }elseif ($var_edad  >= 31 && $var_edad <= 50) {
                             $var_grupo31 = $var_grupo31 +1;
                         }elseif ($var_edad  >= 51 ) {
                             $var_grupo51 = $var_grupo51 +1;
                         }

                    }
                  

                }               
                echo "<p > De 18 a 30 años: ".$var_grupo18." usuarios agendados</p>";
                    echo "<p >De 31 a 50 años: ".$var_grupo31." usuarios agendados</p>";
                    echo "<p >De 51 o mas años: ".$var_grupo51." usuarios agendados</p>";
        }else {
        echo "<h2>Selecciona una opcion</h2>";
    }

 ?>
        </div>
    </form>
        <footer>
            
        </footer>

</body>
</html>

