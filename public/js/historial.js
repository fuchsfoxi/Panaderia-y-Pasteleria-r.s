const overlay    = document.getElementById('modalOverlay');
const cerrar     = document.getElementById('modalCerrar');
const form       = document.getElementById('modalForm');
const cantidad   = document.getElementById('modal_cantidad');
const turno      = document.getElementById('modal_turno');
const producto   = document.getElementById('modal_producto');
const fecha      = document.getElementById('modal_fecha');

document.querySelectorAll('.btn-editar-modal').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;

        form.action = `${BASE_URL}/produccion/editar/${id}`;
        cantidad.value = btn.dataset.cantidad;
        fecha.value    = btn.dataset.fecha;

        // seleccionar turno
        Array.from(turno.options).forEach(opt => {
            opt.selected = opt.value == btn.dataset.turno;
        });

        // seleccionar producto
        Array.from(producto.options).forEach(opt => {
            opt.selected = opt.value == btn.dataset.producto;
        });

        overlay.classList.add('show');
    });
});

cerrar.addEventListener('click', () => overlay.classList.remove('show'));
overlay.addEventListener('click', (e) => {
    if (e.target === overlay) overlay.classList.remove('show');
});