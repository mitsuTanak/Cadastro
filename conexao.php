<?php

// $host = "localhost";
// $user = "root";
// $pass = "";
// $dbname = "cadastro";
// // $port = 3306;

// try{
//     //Conexão com a porta
//     // $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

//     //Conexão sem a porta
//     $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

//     //echo "Conexão com banco de dados realizado com sucesso!";
// }  catch(PDOException $err){
//     //echo "Erro: Conexão com banco de dados não realizado com sucesso. Erro gerado " . $err->getMessage();
// }


$host = "localhost";
$user = "postgres";
$pass = "123";
$dbname = "cadastro";
$port = 5432; // Porta padrão do PostgreSQL

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass");

    // Configurar o PDO para lançar exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Conexão com o banco de dados realizada com sucesso!";
} catch (PDOException $err) {
    //echo "Erro: Conexão com o banco de dados não realizada com sucesso. Erro gerado " . $err->getMessage();
}
