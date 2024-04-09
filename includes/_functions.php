<?php
   
require_once ("_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'editar_registro':
            editar_registro();
            break; 

            case 'eliminar_registro';
            eliminar_registro();
    
            break;

            case 'acceso_user';
            acceso_user();
            break;


		}

	}

    function editar_registro() {
		$conexion=mysqli_connect("db","mariadb","mariadb","mariadb");
		extract($_POST);
		$consulta="UPDATE user SET nombre = '$nombre', correo = '$correo', telefono = '$telefono',
		password ='$password', rol = '$rol' WHERE id = '$id' ";

		mysqli_query($conexion, $consulta);


        echo '<script>window.location="../views/user.php"</script>';
       

}

function eliminar_registro() {
    $conexion=mysqli_connect("db","mariadb","mariadb","mariadb");
    extract($_POST);
    $id= $_POST['id'];
    $consulta= "DELETE FROM user WHERE id= $id";

    mysqli_query($conexion, $consulta);


    echo '<script>window.location="../views/user.php"</script>';
    

}

function acceso_user() {
    $nombre=$_POST['nombre'];
    $password=md5($_POST['password']);
    session_start();
    $_SESSION['nombre']=$nombre;

    $conexion=mysqli_connect("db","mariadb","mariadb","mariadb");
    $consulta= "SELECT * FROM user WHERE nombre='$nombre' AND password='$password'";
    $resultado=mysqli_query($conexion, $consulta);
    $filas=mysqli_fetch_array($resultado);


    if($filas['rol'] == 1){ //admin

        echo '<script>window.location="../views/user.php"</script>';
     

    }else if($filas['rol'] == 2){//lector
        echo '<script>window.location="../views/lector.php"</script>';
     
    }
    
    
    else{

        
        echo '<script>window.location="./login.php"</script>';
        session_destroy();

    }

  
}






