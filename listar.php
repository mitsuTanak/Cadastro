<?php

// Incluir a conexão com o banco de dados
include_once "conexao.php";

// Receber a página atual via método GET
$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

// Verificar se a página não está vazia
if (!empty($pagina)) {

    // Calcular o inicio da visualizacao
    $qnt_result_pg = 40; // Quantidade de registro por pagina
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    // Criar a QUERY para recuperar os registros do BD
    $query_usuarios = "SELECT usr.id, usr.nome, usr.email,
                    ende.logradouro, ende.numero
                    FROM usuarios AS usr 
                    LEFT JOIN enderecos AS ende ON ende.usuario_id=usr.id
                    ORDER BY usr.id DESC
                    LIMIT $inicio, $qnt_result_pg";
    $result_usuarios = $conn->prepare($query_usuarios);
    $result_usuarios->execute();

    // Verificar se há registros e se a consulta foi bem-sucedida
    if (($result_usuarios) and ($result_usuarios->rowCount() != 0)) {

        // Construir a tabela HTML com os resultados
        $dados = "<table class='table table-striped table-bordered table-hover'>";
        $dados .= "<thead>";
        $dados .= "<tr>";
        $dados .= "<th>ID</th>";
        $dados .= "<th>Nome</th>";
        $dados .= "<th>E-mail</th>";
        $dados .= "<th>Logradouro</th>";
        $dados .= "<th>Número</th>";
        $dados .= "<th>Ações</th>";
        $dados .= "</tr>";
        $dados .= "</thead>";
        $dados .= "<tbody>";
        while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
            extract($row_usuario);

            $dados .= "<tr>";
            $dados .= "<td>$id</td>";
            $dados .= "<td>$nome</td>";
            $dados .= "<td>$email</td>";
            $dados .= "<td>$logradouro</td>";
            $dados .= "<td>$numero</td>";
            $dados .= "<td><a href='#' class='btn btn-outline-primary btn-sm' onclick='visUsuario($id)'>Visualizar</a> <a href='#' class='btn btn-outline-warning btn-sm' onclick='editUsuarioDados($id)'>Editar</a>  <a href='#' class='btn btn-outline-danger btn-sm' onclick='apagarUsuarioDados($id)'>Apagar</a></td>";
            $dados .= "</tr>";
        }
        $dados .= "</tbody>";
        $dados .= "</table>";

        // Paginacao - Somar a quantidade de registros que ha BD
        $query_pg = "SELECT COUNT(id) AS num_result FROM usuarios";
        $result_pg = $conn->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        // Calcular a quantidade de páginas
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        $max_links = 2;

        // Construir a navegação da página
        $dados .= "<nav aria-label='Page navigation example'>";
        $dados .= "<ul class='pagination pagination-sm justify-content-center'>";

        $dados .= "<li class='page-item'><a class='page-link' href='#'  onclick='listarUsuarios(1)'>Primeira</a></li>";

        // Loop para links das páginas anteriores
        for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
            if ($pag_ant >= 1) {
                $dados .= "<li class='page-item'><a class='page-link' href='#'  onclick='listarUsuarios($pag_ant)'>$pag_ant</a></li>";
            }
        }

        // Página atual destacada
        $dados .= "<li class='page-item active' aria-current='page'>";
        $dados .= "<a class='page-link' href='#'>$pagina</a>";
        $dados .= "</li>";

        // Loop para links das páginas seguintes
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if ($pag_dep <= $quantidade_pg) {
                $dados .= "<li class='page-item'><a class='page-link' href='#'  onclick='listarUsuarios($pag_dep)'>$pag_dep</a></li>";
            }
        }

        $dados .= "<li class='page-item'><a class='page-link' href='#'  onclick='listarUsuarios($quantidade_pg)'>Última</a></li>";

        $dados .= "</ul>";
        $dados .= "</nav>";

        $retorna = ['status' => true, 'dados' => $dados, 'quantidade_pg' => $quantidade_pg];
    } else {
        $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>"];
    }
} else {
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>"];
}

// Retornar o resultado em formato JSON
echo json_encode($retorna);

// Um arquivo JSON (JavaScript Object Notation) é um formato leve de troca de dados que utiliza uma sintaxe fácil de ler e escrever. Ele é frequentemente usado para representar estruturas de dados simples, como pares chave-valor, arrays e objetos, e é comumente usado em comunicações entre servidores web e clientes, sendo fácil de entender tanto por humanos quanto por máquinas.