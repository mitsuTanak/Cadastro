<?php

// Incluir a conexao com o banco de dados
include_once "conexao.php";

// Receber os dados do formulário via método POST
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// validar o formulario
if (empty($dados['nome'])) {
    // Se o campo nome estiver vazio, retorna mensagem de erro
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];

} elseif (empty($dados['email'])) {
    // Se o campo email estiver vazio, retorna mensagem de erro
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>"];

} elseif (empty($dados['logradouro'])) {
    // Se o campo logradouro estiver vazio, retorna mensagem de erro
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo logradouro!</div>"];

} elseif (empty($dados['numero'])) {
    // Se o campo número estiver vazio, retorna mensagem de erro
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo número!</div>"];

} else {
    // Editar no banco de dados na primeira tabela (usuarios)
    $query_usuario = "UPDATE usuarios SET nome=:nome, email=:email WHERE id=:id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':nome', $dados['nome']);
    $edit_usuario->bindParam(':email', $dados['email']);
    $edit_usuario->bindParam(':id', $dados['id']);

    // Verificar se editou o usuario
    if ($edit_usuario->execute()) {

        // Editar no banco de dados na segunda tabela (enderecos)
        $query_endereco = "UPDATE enderecos SET logradouro=:logradouro, numero=:numero WHERE usuario_id=:usuario_id";
        $edit_endereco = $conn->prepare($query_endereco);
        $edit_endereco->bindParam(':logradouro', $dados['logradouro']);
        $edit_endereco->bindParam(':numero', $dados['numero']);
        $edit_endereco->bindParam(':usuario_id', $dados['id']);

        // Verificar se editou o endereco
        if ($edit_endereco->execute()) {
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Usuário editado com sucesso!</div>"];

        } else {
            // Se a edição do usuário foi bem-sucedida, mas a edição do endereço não foi
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não editado com sucesso!</div>"];
        }
    } else {
        // Se a edição do usuário não foi bem-sucedida
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não editado com sucesso!</div>"];
    }
}

// Retorna o resultado em formato JSON
echo json_encode($retorna);
