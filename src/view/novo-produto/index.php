<!DOCTYPE html>
<html lang="pt-br">
<?php
$title = "Novo Produto";
$pagina = "novo";
include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/view/template/header.php';

if (isset($_POST["inputNome"])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/controller/Produtos.php';
    $controllerProdutos = new Produtos();
    $controllerProdutos->novoProduto($_POST["inputNome"], $_POST["inputCor"], $_POST["inputPreco"]);
}

?>

<body>
    <div class="container">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/view/template/nav-bar.php' ?>
        <h3 class="text-center mb-5">Novo Produto</h3>

        <form class="row g-3" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/ProjetoTitan/src/view/novo-produto/index.php" method="POST">
            <div class="col-md-5">
                <label for="inputNome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="inputNome" name="inputNome" required>
            </div>
            <div class="col-md-4">
                <label for="inputCor" class="form-label">Cor</label>
                <select id="inputCor" class="form-select" name="inputCor" required>
                    <option value=""></option>
                    <option value="Azul">Azul</option>
                    <option value="Amarelo">Amarelo</option>
                    <option value="Vermelho">Vermelho</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="inputPreco" class="form-label">Preço</label>
                <input type="text" class="form-control dinheiro" id="inputPreco" name="inputPreco" required>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/view/template/footer.php' ?>
    
</body>

</html>