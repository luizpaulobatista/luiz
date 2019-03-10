<?php 

$username='root';
$password ='';
$dbname='crud';
/// banco 
    $conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    $conn->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);

    // $query = "SELECT * FROM tab_cursos";

    // $stmt = $conn->prepare($query);

    // if(!$stmt->execute()){
    //   echo 'erro';
    // }

    // $dados = $stmt->fetch(PDO::FETCH_OBJ);
    // PRINT_R($dados );

include ("path.php");

include ("api.php");

