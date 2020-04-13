<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
require('clases/db.class.php');

echo "inicio";

$conn = new Operacion;

$result = $conn->execute("SELECT usr_user,AES_DECRYPT(usr_password,'uaciOpico2015') usr_password FROM tb_usuarios");
$var = mysqli_num_rows($result);
if ($var>0) {
    var_dump(mysqli_fetch_array($result));
}

/*if($conn){
    echo "se conecto correctamente a la DB";
}else{
    echo "no se conecto correctamente a la DB";
}

$conn->desconectar();
SELECT usr_user,AES_DECRYPT(usr_password,'uaciOpico2015') usr_password,usr_rol,usr_estado FROM tb_usuarios WHERE usr_user='$usen'
*/


?>