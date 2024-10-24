<?php
    include_once '../controllers/GestorUsuarisController.php';
    $controller = new GestorUsuarisController();
    $usuaris = $controller->mostrarUsuaris();
?>
<div class="contenedor_usuaris">
    <div class="menu_top">
        <div>
            <a class="btn_tornar" href="../public/index.php?action=dashboard"><i class="fa-solid fa-angle-left"></i></a>
            <h2>Usuaris</h2>
        </div>
        <div>
            <button>Filtres <i class="fa-solid fa-chevron-down"></i></button>
            <a class="btn_afegir" href=""><i class="fa-solid fa-user-plus"></i></a>
        </div>
    </div>
<div class="buscador">
    <input type="text" placeholder="Buscar per nom..." class="input-buscador">
    <button class="btn-lupa">
        <i class="fa-solid fa-search"></i>
    </button>
</div>
    <div class="container_usuaris">
        <?php if ($usuaris && $usuaris->num_rows > 0) : ?>
            <?php while ($usuari = $usuaris->fetch_assoc()) : ?>
                <div class="usuaris">
                    <div class="imatge">
                        <img class="profile-img" src="../public/assets/profile/<?php echo $usuari['imatge']?>" alt="Usuari">
                    </div>
                    <div class="dreta">
                        <h3><?= $usuari['nom']?></h3>
                        <h4><?= $usuari['cognoms']?></h4>
                        <p><?= $usuari['rol']?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hi ha incidències disponibles.</p>
        <?php endif; ?>
    </div>
</div>