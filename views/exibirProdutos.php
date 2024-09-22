<?php
require_once '../utils/funcoesUteis.php';
require_once '../classes/produto.inc.php';
require_once 'includes/cabecalho.inc.php';
?>
<p>
<h1 class="text-center">Produtos do estoque</h1>
<p>
<div class="table-responsive">
      <table class="table table-light table-hover">
            <thead class="table-primary">
                  <tr class="align-middle" style="text-align: center">
                        <th witdh="10%">ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data de Fabricação</th>
                        <th>Preço unitário</th>
                        <th>Em Estoque</th>
                        <th>Fabricante</th>
                        <th>Operação</th>
                  </tr>
            </thead>
            <tbody class="table-group-divider">
                  <?php

                  $produtos = $_SESSION['produtos'];

                  foreach ($produtos as $produto) {
                        echo "<tr align='center'>";
                        echo "<td>" . $produto->id . "</td>";
                        echo "<td><strong>" . $produto->nome . "</strong></td>";
                        echo "<td>" . $produto->descricao . "</td>";
                        echo "<td>" . formatarData($produto->data_fabricacao) . "</td>";
                        echo "<td>" . $produto->preco . "</td>";
                        echo "<td>" . $produto->estoque . "</td>";
                        echo "<td>" . $produto->nome_fabricante . "</td>";
                        echo "<td><a href='../controlers/controllerProduto.php?opcao=4&id=" . $produto->id . "&fab=false' class='btn btn-success btn-sm'>A</a> ";
                        echo "<a href='../controlers/controllerProduto.php?opcao=3&id=" . $produto->id . "' class='btn btn-danger btn-sm'>X</a></td>";
                        echo "</tr>";
                  }

                  ?>
            </tbody>
      </table>
</div>

<?php
require_once 'includes/rodape.inc.php';
?>