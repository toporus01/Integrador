// Desplazamiento suave para los enlaces de navegación
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});


// Filtrar productos en la tabla según el texto ingresado
function filterTable() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const rows = document.querySelectorAll('#productTable tbody tr');

    rows.forEach(row => {
        const text = Array.from(row.cells).map(cell => cell.textContent.toLowerCase()).join(" ");
        row.style.display = text.includes(filter) ? '' : 'none';
    });
}

// Ordenar productos por precio en la tabla
function sortTable() {
    const table = document.getElementById("productTable");
    const rows = Array.from(table.rows).slice(1); // Exclude header row

    rows.sort((a, b) => {
        const priceA = parseFloat(a.cells[2].textContent.replace(/[^0-9.-]+/g, ''));
        const priceB = parseFloat(b.cells[2].textContent.replace(/[^0-9.-]+/g, ''));
        return priceA - priceB;
    });

    rows.forEach(row => table.appendChild(row));
}

// Manejo de envío de formulario de contacto
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();
    const successMessage = document.getElementById('successMessage');

    if (!name || !email || !message) {
        alert("Por favor, complete todos los campos.");
    } else {
        successMessage.style.display = 'block';
        setTimeout(() => { successMessage.style.display = 'none'; }, 5000); // Oculta el mensaje de éxito después de 5 segundos
        this.reset();
    }
});

// Efecto de aparición al desplazarse
const sections = document.querySelectorAll('section');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target); // Evita la animación cada vez que aparece la sección
        }
    });
}, { threshold: 0.2 }); // Ajusta el valor según el nivel de visibilidad requerido

sections.forEach(section => observer.observe(section));

// Botón "Volver Arriba"
const scrollTopBtn = document.getElementById('scrollTopBtn');
window.addEventListener('scroll', () => {
    scrollTopBtn.style.display = (window.scrollY > 100) ? 'block' : 'none';
});

scrollTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
