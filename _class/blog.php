<!DOCTYPE html>
<html lang="en">
<head>
<title>Meu CMS</title>
</head>
<body>

include_once(‘_class/CMS.php’);
$obj = new CMS();
/* CHANGE THESE SETTINGS FOR YOUR OWN DATABASE */
$obj->host = ‘localhost’;
$obj->usuario = ‘usuario’;
$obj->senha = ‘senha’;
$obj->bd = ‘bancodedados’;
$obj->conectar();

if ($_POST)
$obj->gravar($_POST);

echo ( $_GET[‘admin’] == 1 ) ? $obj->display_admin() : $obj->display_public();

?>

</body>
</html>
