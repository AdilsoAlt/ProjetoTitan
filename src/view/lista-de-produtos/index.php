<!DOCTYPE html>
<html lang="pt-br">
<?php
$title = "Lista de Produtos";
$pagina = "lista";
include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/view/template/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/controller/Produtos.php';
$controllerProdutos = new Produtos();
if (isset($_POST["id"])) {
    $controllerProdutos->excluirProduto($_POST["id"]);
    $listaProdutos = $controllerProdutos->todosProdutos();
} else if (isset($_POST["buscaNome"])) {
    $listaProdutos = $controllerProdutos->buscarPorNome($_POST["buscaNome"]);
} else if (isset($_POST["buscaCor"])) {
    $listaProdutos = $controllerProdutos->buscarCor($_POST["buscaCor"]);
} else if (isset($_POST["tipoComparacao"])) {
    $listaProdutos = $controllerProdutos->bucarPorValor($_POST["tipoComparacao"], $_POST["valor"]);
} else {
    $listaProdutos = $controllerProdutos->todosProdutos();
}

?>

<body>
    <div class="container">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/view/template/nav-bar.php' ?>
        <h3 class="text-center mb-5">Lista de Produtos</h3>
        <div class="row">
            <form class="col-md-4 d-flex" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/ProjetoTitan/src/view/lista-de-produtos/index.php" method="POST">
                <div>
                    <input type="text" class="form-control" id="buscaNome" placeholder="Nome" name="buscaNome">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mb-3">Buscar</button>
                </div>
            </form>

            <form class="col-md-2" id="formCor" style="justify-content: center;" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/ProjetoTitan/src/view/lista-de-produtos/index.php" method="POST">
                <select id="buscaCor" class="form-select" name="buscaCor" onchange="this.form.submit()">
                    <option value="">Cor</option>
                    <option value="Azul">Azul</option>
                    <option value="Amarelo">Amarelo</option>
                    <option value="Vermelho">Vermelho</option>
                </select>
            </form>

            <form class="col-md-6 d-flex" style="justify-content: center;" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/ProjetoTitan/src/view/lista-de-produtos/index.php" method="POST">
                <div>
                    <select id="tipoComparacao" class="form-select" name="tipoComparacao">
                        <option value=""></option>
                        <option value="maior">Maior que</option>
                        <option value="menor">Menor que</option>
                        <option value="igual">Igual a</option>
                    </select>
                </div>
                <div>
                    <input type="text" class="form-control dinheiro" id="buscaValor" placeholder="Preço" name="valor" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mb-3">Buscar</button>
                </div>
            </form>

        </div>

        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Cor</td>
                    <td>Preco Original</td>
                    <td>Preco Desconto</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($listaProdutos)) {
                    echo ('<h5>Sem Produtos Cadastrados</h5>');
                } else {
                    foreach ($listaProdutos as $produto) {
                        $precoDesconto = $controllerProdutos->calculoDesconto($produto["COR"], $produto["PRECO"]);
                ?>
                        <tr>
                            <td><?php echo $produto["IDPROD"] ?></td>
                            <td><?php echo $produto["NOME"] ?></td>
                            <td><?php echo $produto["COR"] ?></td>
                            <td>R$ <?php echo number_format($produto["PRECO"], 2, ",", ".") ?></td>
                            <td>R$ <?php echo number_format($precoDesconto, 2, ",", ".") ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPadrao" onclick="editar(<?php echo $produto['IDPROD']; ?>)">Editar</button>
                                <button type="button" class="btn btn-danger" onclick="excluir(<?php echo $produto['IDPROD']; ?>)">Excluir</button>
                            </td>
                        </tr>
                <?php
                    };
                };
                ?>
            </tbody>
        </table>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/view/template/modal.php' ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/view/template/footer.php' ?>
    <script type="text/javascript" src="./scripts.js"></script>
</body>

</html>