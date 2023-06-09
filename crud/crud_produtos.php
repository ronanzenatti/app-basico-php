<?php
require 'conexao.php';
/*
echo '<pre>';
print_r($_POST);
exit();
*/

// Sanitiza e valida os dados recebidos do formulário
$operacao = isset($_POST['operacao']) ? $_POST['operacao'] : '';
$id_produto = isset($_POST['id_produto']) ? validateNumber($_POST['id_produto']) : 0;
$nome = isset($_POST['nome']) ? sanitizeInput($_POST['nome']) : '';
$descricao = isset($_POST['descricao']) ? sanitizeInput($_POST['descricao']) : '';
$origem =  isset($_POST['origem']) ? sanitizeInput($_POST['origem']) : '';
$validade =  isset($_POST['validade']) ? sanitizeInput($_POST['validade']) : null;
$estoque_atual =  isset($_POST['estoque_atual']) ? validateFloat($_POST['estoque_atual']) : 0;
$estoque_minimo =  isset($_POST['estoque_minimo']) ? validateFloat($_POST['estoque_minimo']) : 0;
$valor_unitario =  isset($_POST['valor_unitario']) ? validateFloat($_POST['valor_unitario']) : 0;
$ativo = isset($_POST['ativo']) ? 1 : 0;

// Função para sanitizar os dados de entrada
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Função para validar um número inteiro
function validateNumber($data)
{
    if (empty($data)) {
        $data = 0;
    }
    if (!is_numeric($data)) {
        die("Valor inválido para estoque ou estoque mínimo.");
    }
    return (int) $data;
}

// Função para validar um número decimal (float)
function validateFloat($data)
{
    if (empty($data)) {
        $data = 0;
    }
    if (!is_numeric($data)) {
        die("Valor inválido para o valor unitário.");
    }
    return (float) $data;
}

// Realiza as operações de CRUD


if ($operacao == 'CREATE') {

    // Prepare a declaração SQL com os parâmetros marcados como ?
    $sql = "INSERT INTO produtos (nome, descricao, origem, validade, estoque_atual, estoque_minimo, valor_unitario, ativo)";
    $sql .= " VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

    // Preparação da consulta SQL
    $stmt = $conn->prepare($sql);

    // Atribuição de valores aos parâmetros
    $stmt->bind_param('ssssdddi', $nome, $descricao, $origem, $validade, $estoque_atual, $estoque_minimo, $valor_unitario, $ativo);

    // Execução da consulta preparada
    $stmt->execute();

    echo $stmt->insert_id;

    // Fecha as conexões para evitar erros.
    $stmt->close();
    $conn->close();
    header("Location: http://localhost/app-php/produtos");
} else if ($operacao == 'UPDATE') {

    // Prepare a declaração SQL com os parâmetros marcados como ?
    $sql = "UPDATE produtos SET";
    $sql .= " nome = ?,";
    $sql .= " descricao = ?,";
    $sql .= " origem = ?,";
    $sql .= " validade = ?,";
    $sql .= " estoque_atual = ?,";
    $sql .= " estoque_minimo = ?,";
    $sql .= " valor_unitario = ?,";
    $sql .= " ativo = ?";
    $sql .= " WHERE id_produto = ?";

    // Prepara a declaração
    $stmt = $conn->prepare($sql);

    // Vincula os parâmetros aos marcadores de posição (?)
    $stmt->bind_param('ssssdddii', $nome, $descricao, $origem, $validade, $estoque_atual, $estoque_minimo, $valor_unitario, $ativo, $id_produto);

    // Executa a declaração preparada
    if ($stmt->execute()) {
        header("Location: http://localhost/app-php/produtos");
    } else {
        echo "Erro ao atualizar o produto: " . $stmt->error;
    }

    // Fecha a declaração preparada
    $stmt->close();

    // Fecha a conexão com o banco de dados
    $conn->close();

} else if ($operacao == 'DELETE') {

    // Prepare a declaração SQL com o parâmetro marcado como ?
    $sql = "DELETE FROM produtos WHERE id_produto = ?";

    // Prepara a declaração
    $stmt = $conn->prepare($sql);

    // Vincula o parâmetro ao marcador de posição (?)
    $stmt->bind_param("i", $id_produto);

    // Executa a declaração preparada
    if ($stmt->execute()) {
        return true;
    } else {
        return $stmt->error;
    }

    // Fecha a declaração preparada
    $stmt->close();

    // Fecha a conexão com o banco de dados
    $conn->close();
    
} else {
    echo 'Não veio nada!';
}
