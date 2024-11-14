<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Repuestos</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Rodamientos Integral</h1>
        <p>Gran variedad de respuestos para el automotor, contamos con variante de respuestos para el agro y diferentes modelos de acoplados.</p>
    </header>

    <nav>
        <ul>
            <li><a href="#catalogos">Catálogos</a></li>
            <li><a href="#nuestra">Nuestra Historia</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#tabla">Tabla de Productos</a></li>
            <li><a href="#formulario">Formulario de Contacto</a></li>
            <li><a href="#testimonios">Reseñas</a></li>
        </ul>
    </nav>

    <main>
        <section id="catalogos">
            <h2 style="text-align: center;">Catálogos de Repuestos</h2>
            <h4></h4>
            <div class="flex-container">
                <a href="autos.php" class="catalogo">
                    <h3>Repuestos para Autos</h3>
                    <img src="imagenes/autos1.jpg" alt="Catálogo de Repuestos para Autos" >
                </a>
                <a href="tractores.php" class="catalogo">
                    <h3>Repuestos para Tractores</h3>
                    <img src="imagenes/Repuestos-para-Komatsu-y-Cummins.png" alt="Catálogo de Repuestos para el Agro" >
                </a>
                <a href="acoplados.php" class="catalogo">
                    <h3>Acoplados</h3>
                    <img src="imagenes/acoplados1.jpg" alt="Catálogo de Acoplados">
                </a>
            </div>
        </section>

        <section id="nuestra" class="historia">
            <h1>Nuestra Historia</h1>
            <p>Somos un negocio de repuestos que lleva funcionando desde 1993,todo comenzo con una simple tienda de rulemanes y retenes. Con el tiempo, fueron agregando repuestos para el agro y gran catalogo de respuestos para el automotor. Hoy en el presente contamos con repuestos hidráulicos, acoplados, respuestos para el agro, respuestos para el automotor  y hacemos mangueras hidraulicas. Esto ya no es simplemente un negocio, ya es un lugar en donde todos son familia. Hoy en día, llevamos 32 años al servicio de nuestra gente, ofreciendo lo mejor en calidad y precio.</p>
        </section>

        <section class="historias-imagenes">
            <div class="historia-item">
                <h3>Como comenzo</h3>
            <img src="imagenes/viejo.jpeg" alt="Imagen del pasado" >
            </div>
            <div class="historia-item">
                <h3>Hoy en el presente</h3>
            <img src="imagenes/nuevo.jpeg" alt="Imagen actual" >
            </div>
            
        </section>



        <section id="formulario" class="contact-forms">
            <h2>Formulario de Contacto</h2>
            <form id="contactForm" method="POST" action="guardar_testimonio.php">
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" placeholder="Mensaje" rows="5" required></textarea>
                <button type="submit">Enviar</button>
            </form>
        </section>

        <section>
    <h2 id="contacto" class="contacto">Dónde contactarnos</h2>
    <div class="contactos-container">
        <!-- Ubicación -->
        <div class="contactos">
            <a href="https://maps.app.goo.gl/eQp2re1nWwRvf3hG7" class="contacto-enlace" target="_blank">
                <img src="imagenes/ubic3.jpg" alt="Ubicación">
                <span>Ubicación</span>
            </a>
        </div>

        <!-- WhatsApp -->
        <div class="contacto-item">
            <a href="https://wa.link/itv5w4" class="contacto-enlace" target="_blank">
                <img src="imagenes/whatsapp.png" alt="WhatsApp">
                <span>WhatsApp</span>
            </a>
        </div>

        <!-- Instagram -->
        <div class="contacto-item">
            <a href="hhttps://www.instagram.com/rodamientosintegral/" class="contacto-enlace" target="_blank">
                <img src="imagenes/instagram.png" alt="Instagram">
                <span>Instagram</span>
            </a>
        </div>

        <!-- Facebook -->
        <div class="contacto-item">
            <a href="https://www.facebook.com/p/Rodamientos-integral-100072448986187/" class="contacto-enlace" target="_blank">
                <img src="imagenes/facebook.png" alt="Facebook">
                <span>Facebook</span>
            </a>
        </div>
    </div>
</section>

    <footer>
        <p>&copy; 2024 Rodamientos Integral. Todos los derechos reservados.</p>
    </footer>

    <script href="script.js"></script>

</body>
</html>


