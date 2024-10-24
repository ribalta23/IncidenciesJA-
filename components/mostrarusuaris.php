<?php
    include_once '../controllers/GestorUsuarisController.php';
    $controller = new GestorUsuarisController();
    $usuaris = $controller->mostrarUsuaris();

?>
<div class="menu_top">
    <div class="menu_top_left">
        <i class="fa-solid fa-chevron-left"></i>
        <h1>Usuaris</h1>
    </div>
    <div class="menu_top_right">
        <i class="fa-solid fa-user-plus"></i>

    </div>
</div>
<div class="buscador">
    <input type="text" placeholder="Buscar...">
    <i class="fa-solid fa-search"></i>
</div>