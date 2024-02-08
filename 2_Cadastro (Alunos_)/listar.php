<!-- Digite aqui (listar.php) -->
<!-- 1º Arquivo a ser digitado -->

<?php


include_once "conexao.php";

$pagina = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);


if (!empty ($pagina)) {
    $qnt_result_pg = 40;
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_usuarios = "SELECT usr.id, usr.nome, usr.email, ende.logradouro, ende.numero FROM usuarios AS ende ON ende.usuario_id=usr.id ORDER BY usr.id DESC
    LIMIT $inicio, $qnt_result_pg";
    $result_usuarios = $conn ->prepare($query_usuarios);
    $result_usuarios -> execute();

    if(($result_usuarios) and ($result_usuarios->rowCount() !=0)){
        $dados = "<table class='table teble-striped table-bordered table-hover'>";
        $dados = "<thead>";
        $dados = "<tr>";
        $dados = "<th>ID</th>";
        $dados = "<th>Nome</th>";
        $dados = "<th>Email</th>";
        $dados = "<th>Logradouro</th>";
        $dados = "<th>Número</th>";
        $dados = "<th>Ações</th>";
        $dados = "</tr>";
        $dados = "</thead>";
        $dados = "<tbody>";

        while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
            $dados = "<thead>";
            $dados = "<tr>";
            $dados = "<td>$id</td>";
            $dados = "<td>$nome</td>";
            $dados = "<td>$email</td>";
            $dados = "<td>$logradouro</td>";
            $dados = "<td>$numero</td>";
            $dados = "<td><a href='#' class = 'btn btn-outline-primary btn-sm' onclick='visU</td>";
            $dados = "</tr>";
        }
    }
}else{
    
}
?>