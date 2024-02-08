<?php
// Incluir a conexão com o banco de dados
include_once "conexao.php";

// Receber o ID via método GET
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Verifica sw o ID não está vazio
if (empty($dados['nome'])) {

    $retorna =  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo NOME!</div>"];

}elseif (empty($dados['email'])) {
    $retorna =  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo E-MAIL!</div>"];
}elseif (empty($dados['logradouro'])) {
    $retorna =  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo LOGRADOURO!</div>"];
}elseif (empty($dados['numero'])) {
    $retorna =  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo NÚMERO!</div>"];
}else{
    
    $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
    $result_usuario = $conn-> prepare($query_usuario);
    $result_usuario->bindParam(':logradouro', $dados['logradouro']);
    $result_usuario->bindParam(':numero', $dados['numero']);
    $result_usuario->bindParam(':usuario_id', $dados_usuario);
    $result_usuario->execute();

    if ($result_usuario->rowCount() !=0){

    }
}