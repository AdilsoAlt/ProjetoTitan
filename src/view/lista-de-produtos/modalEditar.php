<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/controller/Produtos.php';
$controllerProdutos = new Produtos();
if (isset($_POST["id"])) {
    $produto = $controllerProdutos->buscarProduto($_POST["id"]);
}

if(isset($_POST["idProdutoEdit"])){
    $controllerProdutos->editarProduto($_POST["idProdutoEdit"], $_POST["inputNomeEdit"], $_POST["inputPrecoEdit"]);
}
?>
<form class="row" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/ProjetoTitan/src/view/lista-de-produtos/modalEditar.php" method="POST">
    <input type="hidden" name="idProdutoEdit" value="<?php echo $produto["IDPROD"]?>">
    <div class="col-md-12">
        <label for="inputNomeEdit" class="form-label">Nome</label>
        <input type="text" class="form-control" id="inputNomeEdit" name="inputNomeEdit" value="<?php echo $produto["NOME"]?>" required>
    </div>
    <div class="col-md-12 mt-2">
        <label for="inputCorEdit" class="form-label">Cor</label>
        <select id="inputCorEdit" class="form-select" name="inputCorEdit" required disabled>
            <option value=""></option>
            <option <?php if($produto["COR"] == "Azul"){echo "selected";}?> value="Azul">Azul</option>
            <option <?php if($produto["COR"] == "Amarelo"){echo "selected";}?> value="Amarelo">Amarelo</option>
            <option <?php if($produto["COR"] == "Vermelho"){echo "selected";}?> value="Vermelho">Vermelho</option>
        </select>
    </div>
    <div class="col-md-12 mt-2">
        <label for="inputPrecoEdit" class="form-label">Preço</label>
        <input type="text" class="form-control dinheiro" id="inputPrecoEdit" name="inputPrecoEdit" required value="<?php echo $produto["PRECO"]?>">
    </div>
    <div class="col-12 text-center mt-5">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
<script>
    $('.dinheiro').mask('#.##0,00', {
        reverse: true
    });
</script>