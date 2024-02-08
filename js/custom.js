// CRUD (Funcoes de listar, visualizar, editar e apagar)

// Função para listar usuários com paginação
const listarUsuarios = async (pagina) => {
    const dados = await fetch("./listar.php?pagina=" + pagina);
    const resposta = await dados.json();
    //console.log(resposta);

    // Se não houver erro, exibe os dados na página
    if (!resposta['status']) {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        const conteudo = document.querySelector(".listar-usuarios");
        if (conteudo) {
            conteudo.innerHTML = resposta['dados'];
        }
    }
}

// Chama a função para listar usuários na página inicial
listarUsuarios(1);

// Cadastrar registro em duas tabelas no BD
const cadUsuarioForm = document.getElementById("cad-usuario-form");

// Receber o SELETOR da janela modal
const cadUsuarioMadal = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));

// Somente acessa o IF quando existir o SELETOR "cad-usuario-for"
if (cadUsuarioForm) {
    // Aguardar o usuario clicar no botao cadastrar
    cadUsuarioForm.addEventListener("submit", async (e) => {
        // Nao permitir a atualizacao da pagina
        e.preventDefault();
        //console.log("Acessou a funcao cadastrar!");

        const dadosForm = new FormData(cadUsuarioForm);

        document.getElementById("cad-usaurio-btn").value = "Salvando...";

        // Envia os dados para o arquivo "cadastrar.php" usando o método POST
        const dados = await fetch("cadastrar.php", {
            method: "POST",
            body: dadosForm
        });

        const resposta = await dados.json();
        //console.log(resposta);

        // Exibe mensagens de erro ou sucesso na página
        if (!resposta['status']) {
            document.getElementById("msgAlertaErro").innerHTML = resposta['msg'];
            document.getElementById("msgAlerta").innerHTML = "";
        } else {
            document.getElementById("msgAlertaErro").innerHTML = "";
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            cadUsuarioForm.reset();
            cadUsuarioMadal.hide();
            listarUsuarios(1);
        }
        document.getElementById("cad-usaurio-btn").value = "Cadastrar";
    })
}

// Visualizar os dados do registro
async function visUsuario(id) {
    //console.log(id);
    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);

    if (!resposta['status']) {
        document.getElementById('msgAlerta').innerHTML = resposta['msg'];
    } else {
        document.getElementById('msgAlerta').innerHTML = "";
        const visModal = new bootstrap.Modal(document.getElementById('visUsuarioModal'));
        visModal.show();

        // Preenche os dados do usuário na janela modal
        document.getElementById("idUsuario").innerHTML = resposta['dados'].id;
        document.getElementById("nomeUsuario").innerHTML = resposta['dados'].nome;
        document.getElementById("emailUsuario").innerHTML = resposta['dados'].email;
        document.getElementById("logradouroUsuario").innerHTML = resposta['dados'].logradouro;
        document.getElementById("numeroUsuario").innerHTML = resposta['dados'].numero;
    }
}

// Recuperar dados do registro para o formulario editar
async function editUsuarioDados(id) {
    document.getElementById("msgAlertaErroEdit").innerHTML = "";

    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();

    // Exibe os dados do usuário no formulário de edição
    if (!resposta['status']) {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editUsuarioModal"));
        editModal.show();
        document.getElementById("editid").value = resposta['dados'].id;
        document.getElementById("editnome").value = resposta['dados'].nome;
        document.getElementById("editemail").value = resposta['dados'].email;
        document.getElementById("editlogradouro").value = resposta['dados'].logradouro;
        document.getElementById("editnumero").value = resposta['dados'].numero;
    }
}

// Editar os dados do registro no BD
const editForm = document.getElementById("edit-usuario-form");
if (editForm) {
    editForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dadosForm = new FormData(editForm);

        document.getElementById("edit-usuario-btn").value = "Salvando...";

        // Envia os dados para o arquivo "editar.php" usando o método POST
        const dados = await fetch("editar.php", {
            method: "POST",
            body: dadosForm
        });

        const resposta = await dados.json();

        // Exibe mensagens de erro ou sucesso na página
        if (!resposta['status']) {
            document.getElementById("msgAlertaErroEdit").innerHTML = resposta['msg'];
        } else {
            document.getElementById("msgAlertaErroEdit").innerHTML = resposta['msg'];
            listarUsuarios(1);
        }

        document.getElementById("edit-usuario-btn").value = "Salvar";

    });
}

// Apagar o registro no BD
async function apagarUsuarioDados(id){

    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");
    
    if(confirmar == true){
        const dados = await fetch('apagar.php?id='+ id);
        const resposta = await dados.json();
    
        if(!resposta['status']){
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
        }else{
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            listarUsuarios(1);
        }
    }
    
}