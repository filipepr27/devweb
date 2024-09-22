<?php
require_once 'conexao.inc.php';
require_once '../classes/produto.inc.php';

class FabricanteDao
{

    private $con;

    function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    function obterNomeFabricante(int $id)
    {
        $sql = $this->con->prepare("SELECT nome FROM fabricantes WHERE codigo =:id ");
        $sql->bindParam(':id', $id);
        $sql->execute();

        $fabricante = $sql->fetch(PDO::FETCH_OBJ);

        return $fabricante->nome;
    }

    function obterTodosFabricantes()
    {
        $sql = $this->con->query("SELECT * FROM fabricantes");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // function excluirProduto($id)
    // {
    //     $sql = $this->con->prepare("DELETE FROM produtos WHERE produto_id = :id");
    //     $sql->bindValue(':id', $id);
    //     $sql->execute();
    // }

    // function obterProduto($id)
    // {
    //     $sql = $this->con->prepare("SELECT * FROM produtos WHERE produto_id = :id");
    //     $sql->bindValue(':id', $id);
    //     $sql->execute();

    //     $produto = null;
    //     if ($sql->rowCount() >= 0) {
    //         $produto = $sql->fetch(PDO::FETCH_ASSOC);
    //     }
    //     return $produto;
    // }
}
