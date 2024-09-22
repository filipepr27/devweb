<?php

require_once 'includes/cabecalho.inc.php';
?>


<!-- CONTEUDO -->
<h1 class="text-center">Identifique-se</h1>

<div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
                <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body p-4 p-sm-5">
                <div class="d-grid mb-2">
                    <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" onclick="location.href='formLogin.php'">Login</button>
                </div>
                <div class="d-grid mb-2">
                    <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" onclick="location.href='formCadastro.php'">Cadastre-se</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Rodape -->

<?php require_once "includes/rodape.inc.php" ?>