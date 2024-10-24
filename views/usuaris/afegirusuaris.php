<?php
    include_once '../controllers/GestorUsuarisController.php';

    $controller = new GestorUsuarisController();
    $roles = $controller->obtenirRol();
    $tipus = $controller->obtenirTipus();
?>

<div class="contenedor_usuaris">
    <div class="menu_top">
        <div>
            <a class="btn_tornar" href="../public/index.php?action=dashboard"><i class="fa-solid fa-angle-left"></i></a>
            <h2>Afegir usuari</h2>
        </div>
    </div>
    
    <div class="contenedor_formU">
        <form action="../controllers/GestorUsuarisController.php?action=afegirUsuaris" method="POST" enctype="multipart/form-data">
            <div class="formU">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div class="formU">
                <label for="cognoms">Cognoms</label>
                <input type="text" name="cognoms" id="cognoms" required>
            </div>
            <div class="formU">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="formU">
                <label for="password">Contrasenya</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" required>
                    <button type="button" id="togglePassword" class="toggle-password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="formU">
                <label for="rol">Rol</label>
                <select name="rol" id="rol" required>
                    <?php if (isset($roles)): ?>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= $rol ?>"><?= ucfirst($rol) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="formU">
                <label for="tipus">Tipus</label>
                <select name="tipus" id="tipus" required>
                    <?php if (isset($tipus)): ?>
                        <?php foreach ($tipus as $tip): ?>
                            <option value="<?= $tip['id_tipus_incidencia'] ?>"><?= ucfirst($tip['nom']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="formU">
                <label for="imatge">Imatge</label>
                <input type="file" name="imatge" id="imatge" required>
            </div>
            <div class="bttn_afegir">
                <button type="submit">Afegir Usuari</button>
            </div>

            
        </form>
    </div>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function (e) {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>