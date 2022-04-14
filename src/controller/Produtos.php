<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTitan/src/controller/DataBaseConnection.php';

//Classe de produtos responsavel pelas funcionaldades relacionadas aos produtos

class Produtos
{
    function todosProdutos() //Busca todos os produtos no banco de dados
    {

        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();

        $sql = "SELECT * FROM Produtos INNER JOIN Preco ON Produtos.IDPROD = Preco.IDPROD";

        $statement = $conn->prepare($sql);
        $statement->execute();

        $linhas = $statement->fetchAll();

        return ($linhas);
    }

    function calculoDesconto($cor, $preco)
    {
        if ($cor == "Azul") {
            return $preco * 0.8;
        } else if ($cor == "Amarelo") {
            return $preco * 0.9;
        } else {
            if ($preco > 50) {
                return $preco * 0.95;
            } else {
                return $preco * 0.8;
            }
        }
    }

    function novoProduto($nome, $cor, $preco)
    {
        //Adiciona Novo Produto
        $sqlProduto = "INSERT INTO Produtos (NOME, COR) VALUES ('" . $nome . "', '" . $cor . "')";
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        $statement = $conn->prepare($sqlProduto);
        $statement->execute();

        //Busca Id do ultimo registro de produtos
        $idAdicionado = $this->retornaUltimoIdProduto()["IDPROD"];

        //Adiciono o Preço
        $this->novoPreco($idAdicionado, $preco);

        //redireciona para pagina de listagem
        header("Location: /ProjetoTitan/src/view/lista-de-produtos/index.php");
        exit();
    }

    function retornaUltimoIdProduto()
    {
        $sql = "SELECT IDPROD FROM Produtos ORDER BY IDPROD DESC LIMIT 0,1";
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $idUltimoProduto = $statement->fetch();
        return $idUltimoProduto;
    }

    function novoPreco($idProduto, $preco)
    {
        $precoFormat = str_replace(".", "", $preco);
        $precoFormat = str_replace(",", ".", $precoFormat);

        $sqlPreco = "INSERT INTO Preco (PRECO, IDPROD) VALUES ($precoFormat, $idProduto)";

        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        $statement = $conn->prepare($sqlPreco);
        $statement->execute();
    }

    function excluirProduto($id)
    {
        //Exclui preco primeiro por conta da constraint criada no banco
        $this->excluirPreco($id);

        //Exclui Produto
        $sqlProduto = "DELETE FROM Produtos WHERE IDPROD = $id";
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        $statement = $conn->prepare($sqlProduto);
        $statement->execute();
    }

    function excluirPreco($id)
    {
        //Exclui Preco
        $sqlPreco = "DELETE FROM Preco WHERE IDPROD = $id";
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        $statement = $conn->prepare($sqlPreco);
        $statement->execute();
    }

    function buscarProduto($id)
    {
        $sql = "SELECT * FROM Produtos INNER JOIN Preco ON Produtos.IDPROD = Preco.IDPROD WHERE Produtos.IDPROD = $id";
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $produto = $statement->fetch();
        return $produto;
    }

    function editarProduto($id, $nome, $preco)
    {
        $sql = "UPDATE Produtos SET NOME = '$nome' WHERE IDPROD = $id";
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();

        $this->editarPreco($id, $preco);

        header("Location: /ProjetoTitan/src/view/lista-de-produtos/index.php");
        exit();
    }

    function editarPreco($id, $preco)
    {
        $precoFormat = str_replace(".", "", $preco);
        $precoFormat = str_replace(",", ".", $precoFormat);
        $sql = "UPDATE Preco SET PRECO = $precoFormat WHERE IDPROD = $id";

        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
    }

    function buscarPorNome($nome)
    {
        $sql = "SELECT * FROM Produtos INNER JOIN Preco ON Produtos.IDPROD = Preco.IDPROD WHERE Produtos.NOME LIKE '%$nome%'";

        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();

        $statement = $conn->prepare($sql);
        $statement->execute();

        $linhas = $statement->fetchAll();

        return ($linhas);
    }

    function bucarPorValor($param, $valor)
    {
        $precoFormat = str_replace(".", "", $valor);
        $precoFormat = str_replace(",", ".", $precoFormat);
        if ($param == "maior") {
            $sql = "SELECT * FROM Produtos INNER JOIN Preco ON Produtos.IDPROD = Preco.IDPROD WHERE Preco.PRECO > $precoFormat";
        } else if ($param == "menor") {
            $sql = "SELECT * FROM Produtos INNER JOIN Preco ON Produtos.IDPROD = Preco.IDPROD WHERE Preco.PRECO < $precoFormat";
        } else {
            $sql = "SELECT * FROM Produtos INNER JOIN Preco ON Produtos.IDPROD = Preco.IDPROD WHERE Preco.PRECO = $precoFormat";
        }

        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();

        $statement = $conn->prepare($sql);
        $statement->execute();

        $linhas = $statement->fetchAll();

        return ($linhas);
    }

    function buscarCor($cor)
    {
        $sql = "SELECT * FROM Produtos INNER JOIN Preco ON Produtos.IDPROD = Preco.IDPROD WHERE Produtos.COR LIKE '$cor'";
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();

        $statement = $conn->prepare($sql);
        $statement->execute();

        $linhas = $statement->fetchAll();

        return ($linhas);
    }
}
