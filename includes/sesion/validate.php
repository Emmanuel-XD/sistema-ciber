<?php 
   include("../db.php");
extract($_POST);

if(isset($_POST['accion'])){
    switch(isset($_POST['accion'])){
        case 'login':
                loginUser();
            break;
    }
}
function loginUser(){
    extract($_POST);
    global $conexion;
    $user = $conexion->real_escape_string($_POST['user']);
    $password = $conexion->real_escape_string($_POST['pass']);


    $sql = "SELECT * FROM  usuarios WHERE usuario = '$user'";
    $resultado = mysqli_query($conexion, $sql);
    $filas = mysqli_fetch_assoc($resultado);
    $rows = mysqli_num_rows($resultado);
    if ($rows > 0){
    $user_data = [
        'password' => $filas['password'],
        'usuario' => $filas['usuario']
    ];
}
else{
    echo json_encode("login_error");
    die();
}
if($user_data['usuario'] && password_verify($password, $user_data['password'])){
        session_start();
        $_SESSION['user'] = $user_data['usuario'];
        echo json_encode("login_success");

}
else{
        echo json_encode("login_error");
}


}
?>