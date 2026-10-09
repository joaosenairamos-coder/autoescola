<?php

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

require "config.php";

$rota = $_GET["rota"] ?? "teste";

function teste() {
    echo json_encode([
        "mensagem" => "Back-end respondendo"
    ]);
}

function listarAlunos($con) {
    $stmt = $con->query("SELECT * FROM Alunos");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC),
        JSON_UNESCAPED_UNICODE
    );
}

function cadastrarAluno($con) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];

    $stmt = $con->prepare("INSERT INTO Alunos (nome, email, telefone, data_nascimento) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $data_nascimento]);

    echo json_encode(
        ["mensagem" => "Aluno cadastrado com sucesso!"],
        JSON_UNESCAPED_UNICODE
    );
}
function listarinstrutor($con) {
    $stmt = $con->query("SELECT * FROM Instrutores");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC),
        JSON_UNESCAPED_UNICODE
    );
}

function cadastrarInstrutor($con) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $categoria_cnh = $_POST["categoria_cnh"];
    $data_cadastro = $_POST["data_cadastro"];

    $stmt = $con->prepare("INSERT INTO Alunos (nome, email, telefone, categoria_cnh, data_cadastro) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $categoria_cnh, $data_cadastro]);

    echo json_encode(
        ["mensagem" => "Aluno cadastrado com sucesso!"],
        JSON_UNESCAPED_UNICODE
    );
}
    switch ($rota) {
    case "alunos":
        listarAlunos($con);
        break;
    case "alunos/create":
        cadastrarAluno($con);
        break;
    case "instrutores":
        listarinstrutor($con);
        break;
    case "instrutores/create":
        cadastrarInstrutor($con);
        break;
    default:
        teste();
        break;
}   