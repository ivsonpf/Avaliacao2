<?php 
//usuario_crud.php

function buscarUsuario(PDO $conexao )
{

$sql = "SELECT id, nome, email FROM usuarios ORDER BY nome";

//$stmt
//$queery

$consulta = $conexao->prepare($sql);
$consulta->execute();

// fetch vetor que traz um unico registro do banco de dados
return $consulta->fetchAll(PDO::FETCH_ASSOC);      
} 

function inserirUsuario(PDO $conexao, $nome, $email, $senha) {
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(':nome', $nome);
    $consulta->bindValue(':email', $email);
    $consulta->bindValue(':senha', password_hash($senha, PASSWORD_DEFAULT));

    return $consulta->execute();
}

function buscarUsuarioSenha(PDO $conexao, $id){
    $sql = "SELECT id, nome, email FROM usuarios WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':id', $id);
    $consulta->execute();

    return $consulta->fetch(PDO::FETCH_ASSOC);
}

function atualizarUsuario(PDO $conexao, $id, $nome, $email, $senha) {
    if (empty($senha)) {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $consulta = $conexao->prepare($sql);
    } else {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':senha', password_hash($senha, PASSWORD_DEFAULT));
    }

    $consulta->bindValue(':nome', $nome);
    $consulta->bindValue(':email', $email);
    $consulta->bindValue(':id', $id);

    return $consulta->execute();
}

function excluirUsuario(PDO $conexao, $id) {
    $sql = " DELETE FROM  usuarios WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':id', $id);

    return $consulta->execute();
}