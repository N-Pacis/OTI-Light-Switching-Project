<?php
$host = 'sql.freedb.tech';
$port = 3306;
$user = 'freedb_oti_root';
$pass = 'Eaf9ff*UpQEH#$H';
$database = 'freedb_oti_light_switching';
$bulb_name = "Mavericks";

// Criando a conexão com o banco de dados
$link = mysqli_connect($host, $user, $pass, $database,$port);

// Verificando se a conexão foi estabelecida com sucesso
if (!$link) {
    die('Unable to connect to database due to : ' . mysqli_connect_error());
}

$query = "CREATE TABLE IF NOT EXISTS mavericks_oti_light(id INT PRIMARY KEY AUTO_INCREMENT,device_name varchar(100) UNIQUE NOT NULL, status varchar(50) NOT NULL)";
$link->execute_query($query);
header('Access-Control-Allow-Origin: *');
?>