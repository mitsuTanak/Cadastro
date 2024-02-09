<?php

include_once "conexao.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_usuario = "DELETE FROM usuarios WHERE id=:id";
    $del_usuario = $conn->prepare($query_usuario);
    $del_usuario->bindParam(':id', $id);
    
    if ($del_usuario->execute()) {
        
        $query_endereco = "DELETE FROM enderecos WHERE usuario_id=:usuario_id";
        $del_endereco = $conn->prepare($query_usuario);
        $del_endereco->bindParam(':usuario_id', $id);

        if ($del_usuario->execute()) {
            
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Usuário apagado com sucesso!</div>"];

        }else {
        
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário apagado, endereço não apagado com sucesso!</div>"];
        }
    } else {

        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro:Nenhum usuário encontrado!</div>"];
    }
}

// Retornar o resultado em formato JSON
echo json_encode($retorna);

?>