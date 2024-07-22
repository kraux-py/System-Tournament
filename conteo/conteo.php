<?php
include('db_connection.php');
session_start();

// Verificar si el administrador está conectado
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Obtener configuración de cuenta regresiva
$query = "SELECT * FROM countdown_config WHERE id = 1";
$result = mysqli_query($conn, $query);
$config = mysqli_fetch_assoc($result);

$countdown_active = $config['active'];
$countdown_end_date = $config['end_date'];
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Count - Static</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/conteo/base.css">
    <link rel="stylesheet" href="../assets/css/conteo/vendor.css">
    <link rel="stylesheet" href="../assets/css/conteo/main.css">
    <script src="../assets/js/conteo/modernizr.js"></script>
    <script src="../assets/js/conteo/pace.min.js"></script>
</head>
<body>
    <?php if ($countdown_active): ?>
        <main class="s-home s-home--static">
            <div class="overlay"></div>
            <div class="home-content">
                <div class="home-logo">
                    <a href="index-static.html">
                        <img src="../assets/images/logo.svg" alt="Homepage">
                    </a>
                </div>
                <div class="row home-content__main">
                    <div class="col-four home-content__counter">
                        <h3>Comienza en</h3>
                        <div class="home-content__clock">
                            <div class="top">
                                <div class="time days" id="days">325<span>Dias</span></div>
                            </div>    
                            <div class="time hours" id="hours">09<span>H</span></div>
                            <div class="time minutes" id="minutes">54<span>M</span></div>
                            <div class="time seconds" id="seconds">30<span>S</span></div>
                        </div>  
                    </div> 
                    
                    <div class="col-eight home-content__text pull-right">
                        <h3>Pagina Oficial</h3>
                        <h1>
                        Juegos UCSI 2024 - EIDICION XII <br>
                        
                        </h1>
                        <p>
                        El equipo de UCSI ha trabajado arduamente para traerte esta página web dedicada a los Juegos UCSI 2024. Aquí encontrarás toda la información del torneo en un solo lugar, incluyendo los partidos, estadísticas y muchas cosas más. Nuestro objetivo es proporcionar una plataforma centralizada para que los participantes y aficionados puedan seguir de cerca cada detalle de este emocionante evento universitario. ¡Explora y mantente al día con todo lo relacionado con los Juegos UCSI 2024!
                        </p>
                        <div class="home-content__subscribe">
                            
                        </div>
                    </div>  
                     
                </div>  
                <ul class="home-social">
                    <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i><span>Facebook</span></a></li>
                    <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i><span>Twitter</span></a></li>
                    <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i><span>Instagram</span></a></li>
                    <li><a href="#0"><i class="fab fa-behance" aria-hidden="true"></i><span>Behance</span></a></li>
                    <li><a href="#0"><i class="fab fa-dribbble" aria-hidden="true"></i><span>Dribbble</span></a></li>
                </ul> 
                <div class="row home-copyright">
                    <span>Copyright Juegos UCSI 2024</span> 
                    <span>Design by <a href="https://www.krauxx-py.site">Creador</a></span>
                </div> 
                <div class="home-content__line"></div>
            </div> 
        </main> 
        <script>
            var endDate = new Date("<?php echo $countdown_end_date; ?>").getTime();
            var countdownTimer = setInterval(function() {
                var now = new Date().getTime();
                var distance = endDate - now;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById("days").innerHTML = days + "<span>Dias</span>";
                document.getElementById("hours").innerHTML = hours + "<span>H</span>";
                document.getElementById("minutes").innerHTML = minutes + "<span>M</span>";
                document.getElementById("seconds").innerHTML = seconds + "<span>S</span>";
                if (distance < 0) {
                    clearInterval(countdownTimer);
                    document.getElementById("days").innerHTML = "0<span>Dias</span>";
                    document.getElementById("hours").innerHTML = "0<span>H</span>";
                    document.getElementById("minutes").innerHTML = "0<span>M</span>";
                    document.getElementById("seconds").innerHTML = "0<span>S</span>";
                    window.location.href = "../index.html";
                }
            }, 1000);
        </script>
    <?php else: ?>
        <h1>Bienvenido a los Juegos UCSI 2024</h1>
        <p>El contenido normal del sitio va aquí...</p>
    <?php endif; ?>

    <?php if ($isAdmin): ?>
        <div>
            <a href="../dashboard/config_countdown.php">Configurar Cuenta Regresiva</a>
        </div>
    <?php endif; ?>
</body>
</html>
