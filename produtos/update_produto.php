<?php
require '../template/header.php';
require '../crud/conexao.php';

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM produtos WHERE id_produto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Pega cada registro e coloca no variavel $row
        while ($row = $result->fetch_assoc()) {
            $id_produto = $row['id_produto'];
            $nome = $row['nome'];
            $descricao = $row['descricao'];
            $validade = $row['validade'];
            $ativo = $row['ativo'];
            $valor_unitario = $row['valor_unitario'];
            $estoque_atual = $row['estoque_atual'];
            $estoque_minimo = $row['estoque_minimo'];
        }
    }
} else {
    header("Location: http://localhost/teste/produtos");
}
$conn->close();
?>

<div class="row mb-4">
    <div class="col-sm-10">
        <h1 class="text-warning">Cadastrar Produto</h1>
    </div>
    <div class="col-sm-2 d-flex justify-content-end">
        <a href="create_produto.php" class="btn btn-warning py-3" type="button">
            <i class="bi bi-check-lg"></i> Salvar
        </a>
    </div>
</div>

<div class="card text-bg-light mb-3">
    <div class="card-body">
        <form action="../crud/crud_produtos.php" method="post" class="row">
            <input type="hidden" name="operacao" value="UPDATE">
            <input type="hidden" name="id_produto" value="">
            <div class="mb-3 col-md-7">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome do produto...">
            </div>
            <div class="col-md-2">
                <label for="origem" class="form-label">Origem</label>
                <select class="form-select" id="origem" name="origem">
                    <option value="N" selected>Nacional</option>
                    <option value="I">Importado</option>
                </select>
            </div>
            <div class="mb-3 col-md-2">
                <label for="validade" class="form-label">Validade</label>
                <input type="date" class="form-control text-center" id="validade" name="validade" placeholder="00/00/0000">
            </div>
            <div class="col-md-1">
                <label for="ativo" class="form-label">Ativo</label>
                <div class="form-check form-switch mt-1">
                    <input class="form-check-input" type="checkbox" role="switch" name="ativo" id="ativo" checked>
                </div>
            </div>
            <div class="mb-3 col-md-12">
                <label for="descricao" class="form-label">Descrição do Produto</label>
                <textarea class="form-control" id="descricao" rows="3" name="descricao"></textarea>
            </div>
            <div class="mb-3 col-md-4">
                <label for="estoque_minimo" class="form-label">Estoque Mínimo</label>
                <input type="number" step="0.01" class="form-control text-end" id="estoque_minimo" placeholder="0.00" name="estoque_minimo">
            </div>
            <div class="mb-3 col-md-4">
                <label for="estoque_atual" class="form-label">Estoque Atual</label>
                <input type="number" step="0.01" class="form-control text-end" id="estoque_atual" placeholder="0.00" name="estoque_atual">
            </div>
            <div class="mb-3 col-md-4">
                <label for="valor_unitario" class="form-label">Valor Unitário</label>
                <input type="number" step="0.01" class="form-control text-end" id="valor_unitario" placeholder="0.00" name="valor_unitario">
            </div>

            <div class=" d-flex justify-content-between">
                <a href="http://localhost/teste/produtos" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-90deg-left"></i>
                    Voltar
                </a>

                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-eraser"></i> Limpar
                </button>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-check-lg"></i> Atualizar
                </button>
            </div>
        </form>
    </div>
</div>

<?php
require '../template/footer.php';
?>