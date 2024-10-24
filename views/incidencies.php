<?php
    include_once '../controllers/IncidenciaController.php';
    $controller = new IncidenciaController();
    $incidencies = $controller->obtenir_totes();
?>
<div class="contenedor_incidencies">
    <div class="menu_top">
        <div>
            <a class="btn_tornar" href="../public/index.php?action=dashboard"><i class="fa-solid fa-angle-left"></i></a>
            <h2>Incidencies</h2>
        </div>
        <div>
            <button>Filtres <i class="fa-solid fa-chevron-down"></i></button>
            <a class="btn_afegir" href="../public/index.php?action=crearIncidencia"><button><i class="fa-solid fa-plus"></i></button></a>
        </div>
    </div>
    <div class="container_incidencies">
        <?php if ($incidencies && $incidencies->num_rows > 0) : ?>
            <?php while ($incidencia = $incidencies->fetch_assoc()) : ?>
                <a class="incidencia" href="../public/index.php?action=veureIncidencia&idIncidencia=<?= $incidencia['id_incidencia'] ?>">
                    <div class="esquerra">
                        <div class="prioritat p_<?= $incidencia['prioritat'] ?>"><?= $incidencia['prioritat'] ?></div>
                        <p><?= $controller->contadorTasques($incidencia['id_incidencia'])?></p>
                    </div>
                    <div class="dreta">
                        <p><?= $incidencia['tipus_incidencia']?></p>
                        <h3><?= $incidencia['titol']?></h3>
                        <p><?= $incidencia['data_creacio']?></p>
                        <p><?= $incidencia['nom_usuari_supervisor']?></p>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no_incidencies">No hi ha incidències disponibles.</p>
        <?php endif; ?>
    </div>
</div>