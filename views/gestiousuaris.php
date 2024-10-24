<?php
    include_once '../controllers/GestorUsuarisController.php';
    $controller = new GestorUsuarisController();
    $usuaris = $controller->mostrarUsuaris();

?>
<div class="menu_top">
    <div class="menu_top_left">
    <a href="index.php?action=dashboard" class="icon-button">
    <i class="fa-solid fa-chevron-left"></i>
</a>
        <h1>Usuaris</h1>
    </div>
    <div class="menu_top_right">
        <button class="icon-button">
            <i class="fa-solid fa-user-plus"></i>
        </button>
    </div>
</div>
<div class="buscador">
    <input type="text" placeholder="Buscar...">
    <i class="fa-solid fa-search"></i>
</div>
<div class="usuaris_views">



</div>