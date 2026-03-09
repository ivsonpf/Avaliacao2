<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH .'/src/usuario_crud.php';

$id = $_GET['id'];

$usuario = buscarUsuarioSenha($conexao, $id);

if (isset($_GET['confirmar'])) {
    if(excluirUsuario($conexao,$id)){    
    header("Location: listar.php?msg=exluido");
    exit;
    }
}

$titulo = "Excluir Usuário |";
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Usuário</h3>

    <div class="alert alert-danger w-50 text-center mx-auto">
        <p>Deseja realmente excluir o usuário <b>Fulano de Tal</b>?</p>
        <a href="listar.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Não</a>
        <a href="?id=<?= $id ?>&confirmar-exclusao" class="btn btn-danger"><i class="bi bi-check-circle"></i> Sim</a>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>