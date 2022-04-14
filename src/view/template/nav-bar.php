<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <span class="navbar-brand">Projeto Titan</span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php if($pagina == "lista"){echo "active";} else {echo "";};?>" href="<?php $_SERVER['DOCUMENT_ROOT']?>/ProjetoTitan/src/view/lista-de-produtos">Lista de Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($pagina == "novo"){echo "active";} else {echo "";};?>" href="<?php $_SERVER['DOCUMENT_ROOT']?>/ProjetoTitan/src/view/novo-produto">Adicionar Novo Produto</a>
        </li>
      </ul>
    </div>
  </div>
</nav>