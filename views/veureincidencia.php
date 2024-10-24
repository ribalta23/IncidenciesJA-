<?php

if(isset($_GET['idIncidencia'])){
    include_once '../controllers/IncidenciaController.php';
    $controller = new IncidenciaController();
    $incidencia = $controller->obtenir_per_id($_GET['idIncidencia']);
    $tipus = $controller->obtenir_tipus_incidencia();
    $usuaris = $controller->obtenir_usuaris();
} else {
    header('Location: ../public/index.php?action=incidencies');
    exit();
}
?>
<div class="contenedor_incidencies">
    <div class="menu_top">
        <div>
            <a class="btn_tornar" href="../public/index.php?action=incidencies"><i class="fa-solid fa-angle-left"></i></a>
            <h2>Veure incidencia #<?= $incidencia['id_incidencia'] ?></h2>
        </div>
    </div>
    <h3>Creada per <?= $incidencia['NomCreacio'] ?></h3>
    <form action="../controllers/IncidenciaController.php" method="POST">
        <input type="hidden" name="id_incidencia" value="<?= $incidencia['id_incidencia'] ?>">
        <div class="form_element">
            <label for="titol">Titol</label>
            <input type="text" name="titol" id="titol" value="<?= $incidencia['titol'] ?>">
        </div>
        <div class="form_element">
            <label for="id_tipo_incidencia">Tipus d'incidencia</label>
            <select name="id_tipo_incidencia" id="">
                <?php
                    while ($row = $tipus->fetch_assoc()) {
                        echo "<option value='".$row['id_tipus_incidencia']."'>".$row['nom']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form_element">
            <label for="id_usuari">Asignar tecnic</label>
            <select name="id_usuari" id="">
                <?php
                    while ($row = $usuaris->fetch_assoc()) {
                        echo "<option value='".$row['id_usuari']."'>".$row['nom']."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form_element">
            <label for="prioritat">Prioritat</label>
            <div class="radio_group">
                <input <?php if($incidencia['prioritat'] == 'baixa') echo 'checked' ?> type="radio" name="prioritat" value="baixa" id="prioritat_1" required>
                <label for="prioritat_1">Baixa</label>
                <input <?php if($incidencia['prioritat'] == 'mitjana') echo 'checked' ?> type="radio" name="prioritat" value="mitjana" id="prioritat_2" required>
                <label for="prioritat_2">Moderada</label>
                <input <?php if($incidencia['prioritat'] == 'alta') echo 'checked' ?> type="radio" name="prioritat" value="alta" id="prioritat_3" required>
                <label for="prioritat_3">Alta</label>
            </div>
        </div>
        <div class="form_element">
            <label for="estat">Estat</label>
            <div class="radio_group">
                <input <?php if($incidencia['estat'] == 'pendent') echo 'checked' ?> type="radio" name="estat" value="pendent" id="estat_1" required>
                <label for="estat_1">Pendent</label>
                <input <?php if($incidencia['estat'] == 'enproces') echo 'checked' ?> type="radio" name="estat" value="enproces" id="estat_2" required>
                <label for="estat_2">EnProces</label>
                <input <?php if($incidencia['estat'] == 'resolta') echo 'checked' ?> type="radio" name="estat" value="resolta" id="estat_3" required>
                <label for="estat_3">Resolta</label>
            </div>
        </div>
        <div class="form_element">
            <label for="descripcio">Descripcio</label>
            <textarea name="descripcio" id="descripcio" cols="30" rows="10"><?= $incidencia['descripcio'] ?></textarea>
        </div>
        <div class="form_element">
            <button type="submit" name="action" value="actualitzar">Actualitzar</button>
            <button type="submit" name="action" value="eliminar">Eliminar</button>
        </div>
    </form>
</div>