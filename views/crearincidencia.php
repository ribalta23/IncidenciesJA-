<?php
    include_once '../controllers/IncidenciaController.php';
    $controller = new IncidenciaController();
    $tipus = $controller->obtenir_tipus_incidencia();
    $usuaris = $controller->obtenir_usuaris();
?>
<div class="contenedor_incidencies">
    <div class="menu_top">
        <div>
            <a class="btn_tornar" href="../public/index.php?action=incidencies"><i class="fa-solid fa-angle-left"></i></a>
            <h2>Agregar incidencia</h2>
        </div>
    </div>
    <form action="../controllers/IncidenciaController.php?action=crear" method="POST">
        <input type="hidden" name="id_usuari_creacio" value="<?= $_SESSION['usuari']['id'] ?>">
        <div class="form_element">
            <label for="titol">Titol de la incidencia</label>
            <input type="text" name="titol" id="titol" placeholder="Titol" required>
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
                <input type="radio" name="prioritat" value="baixa" id="prioritat_1" required>
                <label for="prioritat_1">Baixa</label>
                <input type="radio" name="prioritat" value="mitjana" id="prioritat_2" required>
                <label for="prioritat_2">Moderada</label>
                <input type="radio" name="prioritat" value="alta" id="prioritat_3" required>
                <label for="prioritat_3">Alta</label>
            </div>
        </div>
        <div class="form_element">
            <label for="descripcio">Descripcio de la incidencia</label>
            <textarea name="descripcio" id="descripcio" cols="30" rows="10" required></textarea>
        </div>
        <div class="form_element">
            <button type="submit">Agregar incidencia</button>
        </div>
    </form>
</div>