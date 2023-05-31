<?php
require '../template/header.php';
require '../crud/conexao.php';

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

?>
<div class="row mb-4">
    <div class="col-sm-10">
        <h1>Listar Produtos</h1>
    </div>
    <div class="col-sm-2 d-flex justify-content-end">
        <a href="create_produto.php" class="btn btn-success py-3" type="button">
            <i class="bi bi-plus-lg"></i> Adicionar
        </a>
    </div>
</div>
<div class="card text-bg-light mb-3">
    <div class="card-body">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Estoque</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result->num_rows > 0) {
                    // Pega cada registro e coloca no variavel $row
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <th scope="row"><?= $row['id_produto'] ?></th>
                            <td><?= $row['nome'] ?></td>
                            <td class="text-end"><?= $row['estoque_atual'] ?></td>
                            <td class="text-end">R$ <?= $row['valor_unitario'] ?></td>
                            <td class="text-center">
                                <a href="update_produto.php?id=<?= $row['id_produto'] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deletar(<?= $row['id_produto'] ?>)">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <th class="text-center" scope="row" colspan="5">Nenhum registro no Banco de Dados!</th>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

$conn->close();
require '../template/footer.php';
?>