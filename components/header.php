<header>
    <nav>
        <a class="img_logo" href="../public/index.php">
            <img src="../public/assets/brand/logo_simbol_white.png" alt="logo">
        </a>
        <label class="burger" for="btn_desplegable_menu">
            <input type="checkbox" id="btn_desplegable_menu">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </nav>
    <div class="desplegable" id="desplegable_menu">
        <div class="user_info">
            <div>
                <img src="../public/assets/profile/<?= $_SESSION['usuari']['imatge'] ?>" alt="user">
                <span>
                    <h3><?= $_SESSION['usuari']['nom'] ?></h3>
                    <p><?= $_SESSION['usuari']['rol'] ?></p>
                </span>
            </div>
            <a href=""><i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <ul>
            <a href=""><i class="fa-solid fa-chart-simple"></i><span>Dashboard</span></a>

            <div class="desplegable_options">
                <div class="desplegable_options_menu">
                    <a href="../public/index.php?action=incidencies"><i class="fa-solid fa-triangle-exclamation"></i><span>Incidencies</span></a>
                    <i class="fa-solid fa-angle-down" id="click_desplegable_incidencies"></i>
                </div>
                <div class="desplegable_options_content" id="desplegable_incidencies">
                    <a href="../public/index.php?action=incidencies">Veure incidències</a>
                    <a href="../public/index.php?action=incidencies&create">Crear incidència</a>
                </div>
            </div>

            <a href=""><i class="fa-solid fa-message"></i><span>Missatges</span></a>

            <div class="desplegable_options">
                <div class="desplegable_options_menu">
                    <a href="../public/index.php?action=mostrarUsuaris"><i class="fa-solid fa-users"></i><span>Gestio d'usuaris</span></a>
                    <i class="fa-solid fa-angle-down" id="click_desplegable_gestiousers"></i>
                </div>
                <div class="desplegable_options_content" id="desplegable_gestiousers">
                    <a href="">Veure usuaris</a>
                    <a href="">Crear usuari</a>
                </div>
            </div>

            <div class="desplegable_options">
                <div class="desplegable_options_menu">
                    <a href=""><i class="fa-solid fa-gear"></i><span>Configuració</span></a>
                    <i class="fa-solid fa-angle-down" id="click_desplegable_configuracio"></i>
                </div>
                <div class="desplegable_options_content" id="desplegable_configuracio">
                    <a href="">General</a>
                    <a href="">Accesibilitat</a>
                    <a href="">Privacitat</a>
                </div>
            </div>

            <a href="../controllers/UsuariController.php?action=logout"><i class="fa-solid fa-right-from-bracket"></i> <span>Tancar Sessió</span></a>
        </ul>
    </div>
</header>
<script>
    $(document).ready(function() {
        $('#desplegable_incidencies').hide();
        $('#desplegable_gestiousers').hide();
        $('#desplegable_configuracio').hide();


        $('#btn_desplegable_menu').click(function() {
            $('#desplegable_menu').slideToggle('active');
        });
        $('#click_desplegable_incidencies').click(function() {
            $('#desplegable_incidencies').slideToggle('active');
        });
        $('#click_desplegable_gestiousers').click(function() {
            $('#desplegable_gestiousers').slideToggle('active');
        });
        $('#click_desplegable_configuracio').click(function() {
            $('#desplegable_configuracio').slideToggle('active');
        });
    });
</script>
