<?php
require_once '../classes/item.inc.php';
require_once 'includes/cabecalho.inc.php';

$carrinho = null;

if (isset($_SESSION['carrinho'])) {
      $carrinho = $_SESSION['carrinho'];
}
?>

<h1 class="text-center">Carrinho de compra</h1>
<p>
      <?php
      if (isset($_REQUEST['status'])) {
            include_once "../views/includes/carrinhoVazio.inc.php";
      } else {
      ?>
<div class="table-responsive">
      <table class="table table-ligth table-striped">
            <thead class="table-danger">
                  <tr class="align-middle" style="text-align: center">
                        <th witdh="10%">Item No</th>
                        <th>Ref.</th>
                        <th>Nome</th>
                        <th>Fabricante</th>
                        <th>Preço</th>
                        <th>Qde.</th>
                        <th>Total</th>
                        <th width="10%">Adicionar</th>
                        <th>Remover</th>
                  </tr>
            </thead>
            <tbody class="table-group-divider">
                  <?php
                  $cont = 0;
                  $soma = 0;

                  foreach ($carrinho as $item) {

                        $cont++;
                  ?>
                        <tr class="align-middle" style="text-align: center">
                              <td><?= $item->getProduto()->id ?></td>
                              <td><?= $item->getProduto()->referencia ?></td>
                              <td><?= $item->getProduto()->nome ?></td>
                              <td><?= $item->getProduto()->nome_fabricante ?></td>
                              <td><?= $item->getProduto()->preco ?></td>
                              <td><?= $item->getQuantidade() ?></td>
                              <td>R$ <?= $item->getValorItem() ?></td>
                              <td>
                                    <form action="../controlers/controllerCarrinho.php" method="post">
                                          <div class="d-flex align-items-center justify-content-center">
                                                <input type="number" name="qtdItem" min="0" class="form-control form-control-sm me-2" style="width: 60px;" value="0">
                                                <input type="submit" class="btn btn-info btn-sm" value="+">
                                          </div>
                                          <input type="hidden" name='opcao' value='6'>
                                          <input type="hidden" name='idItemAdd' value="<?= $item->getProduto()->id ?>">
                                    </form>
                              </td>
                              <td><a href="../controlers/controllerCarrinho.php?opcao=2" class='btn btn-danger btn-sm'>X</a></td>
                        </tr>
                  <?php

                        $soma += $item->getValorItem();
                  }
                  $_SESSION['total'] = $soma;
                  ?>

                  <tr align="right">
                        <td colspan="8">
                              <font face="Verdana" size="4" color="red"><b>Valor Total = R$ <?= number_format($soma, 2, ',', '.') ?></b></font>
                        </td>
                  </tr>
      </table>
      <div class="container text-center">
            <div class="row">
                  <div class="col">
                        <a class="btn btn-warning" role="button" href="../controlers/controllerProduto.php?opcao=7"><b>Continuar comprando</b></a>
                  </div>
                  <div class="col">
                        <a class="btn btn-danger" role="button" href="../controlers/controllerCarrinho.php?opcao=3"><b>Esvaziar carrinho</b></a>
                  </div>
                  <div class="col">
                        <a class="btn btn-success" role="button" href="../controlers/controllerCarrinho.php?opcao=5"><b>Finalizar compra</b></a>
                  </div>
            </div>
      </div>

<?php
      }
      require_once 'includes/rodape.inc.php';
?>