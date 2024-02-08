<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listar duas tabelas</title>

    <!-- Link para (Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <!-- Container principal -->
    <div class="container">
        <!-- Barra de título -->
        <div class="row mt-4 mb-2">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h4>Listar Usuários</h4>
                <!-- Botão para abrir a tela de cadastro (Novo usuário) -->
                <div>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">Cadastrar</button>
                </div>
            </div>
        </div>

        <!-- Local para exibir mensagens de alerta -->
        <span id="msgAlerta"></span>

        <!-- Lista de usuários -->
        <div class="row">
            <div class="col-lg-12">
                <span class="listar-usuarios"></span>
            </div>
        </div>
    </div>

    <!-- _________________________________________________________________________ -->
    <!-- Tela de cadastro de usuário -->

    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <!-- Conteúdo da tela -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel">Cadastrar Usuário</h5>
                    <!-- Botão para fechar o modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Local para exibir mensagens de alerta -->
                    <span id="msgAlertaErro"></span>
                    <!-- Formulário de cadastro de usuário -->
                    <form class="row g-3" id="cad-usuario-form">
                        <!-- Campos do formulário -->
                        <div class="col-12">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome completo">
                        </div>

                        <!-- Outros campos do formulário (e-mail, logradouro, número) -->
                        
                        <div class="col-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Melhor e-mail">
                        </div>

                        <div class="col-12">
                            <label for="logradouro" class="form-label">Logradouro</label>
                            <input type="text" name="logradouro" class="form-control" id="logradouro" placeholder="Endereço do usuário">
                        </div>

                        <div class="col-12">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" name="numero" class="form-control" id="numero" placeholder="Número">
                        </div>

                        <div class="col-12">
                            <input type="submit" class="btn btn-outline-success btn-sm" id="cad-usaurio-btn" value="Cadastrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Tela cadastrar usuario -->

    <!-- _________________________________________________________________________ -->
    <!-- Tela de visualização de usuário -->

    <div class="modal fade" id="visUsuarioModal" tabindex="-1" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visUsuarioModalLabel">Visualizar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertaErroVis"></span>
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-9"><span id="idUsuario"></span></dd>

                        <dt class="col-sm-3">Nome</dt>
                        <dd class="col-sm-9"><span id="nomeUsuario"></span></dd>

                        <dt class="col-sm-3">E-mail</dt>
                        <dd class="col-sm-9"><span id="emailUsuario"></span></dd>

                        <dt class="col-sm-3">Logradouro</dt>
                        <dd class="col-sm-9"><span id="logradouroUsuario"></span></dd>

                        <dt class="col-sm-3">Número</dt>
                        <dd class="col-sm-9"><span id="numeroUsuario"></span></dd>

                    </dl>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Modal visualizar usuario -->

    <!-- _________________________________________________________________________ -->
    <!-- Tela editar usuario -->

    <div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsuarioModalLabel">Editar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span id="msgAlertaErroEdit"></span>

                    <form class="row g-3" id="edit-usuario-form">
                        <input type="hidden" name="id" id="editid">

                        <div class="col-12">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" id="editnome" placeholder="Nome completo">
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" id="editemail" placeholder="Melhor e-mail">
                        </div>

                        <div class="col-12">
                            <label for="logradouro" class="form-label">Logradouro</label>
                            <input type="text" name="logradouro" class="form-control" id="editlogradouro" placeholder="Endereço do usuário">
                        </div>

                        <div class="col-12">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" name="numero" class="form-control" id="editnumero" placeholder="Número">
                        </div>

                        <div class="col-12">
                            <input type="submit" class="btn btn-outline-warning btn-sm" id="edit-usuario-btn" value="Salvar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Tela editar usuario -->

    <!-- _________________________________________________________________________ -->
    <!-- Link JS (Bootstrap) -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Link JS -->
    <script src="js/custom.js"></script>
</body>

</html>