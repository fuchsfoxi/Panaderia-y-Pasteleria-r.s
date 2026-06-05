document.addEventListener('DOMContentLoaded', () => {

    // ===== FILTROS =====
    const botones  = document.querySelectorAll('.btn-filtro');
    const tarjetas = document.querySelectorAll('.card-producto');

    botones.forEach(btn => {
        btn.addEventListener('click', () => {
            botones.forEach(b => b.classList.remove('activo'));
            btn.classList.add('activo');
            const tipo = btn.dataset.tipo;
            tarjetas.forEach(card => {
                card.style.display = (tipo === 'todos' || card.dataset.tipo === tipo) ? 'flex' : 'none';
            });
        });
    });

    // ===== MODAL NUEVO =====
    const overlay   = document.getElementById('modal-overlay');
    const btnAbrir  = document.getElementById('btn-abrir-modal');
    const btnCerrar = document.getElementById('btn-cerrar-modal');
    const btnCancel = document.getElementById('btn-cancelar');

    btnAbrir.addEventListener('click',  () => overlay.classList.add('activo'));
    btnCerrar.addEventListener('click', () => overlay.classList.remove('activo'));
    btnCancel.addEventListener('click', () => overlay.classList.remove('activo'));
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.classList.remove('activo');
    });

    // ===== MODAL EDITAR =====
    const overlayEditar   = document.getElementById('modal-editar-overlay');
    const btnCerrarEditar = document.getElementById('btn-cerrar-editar');
    const btnCancelEditar = document.getElementById('btn-cancelar-editar');
    const formEditar      = document.getElementById('form-editar');

    document.querySelectorAll('.btn-editar-card').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('nombre-editar').value = btn.dataset.nombre;
            document.getElementById('tipo-editar').value   = btn.dataset.tipo;
            formEditar.action = btn.getAttribute('href');
            overlayEditar.classList.add('activo');
        });
    });

    btnCerrarEditar.addEventListener('click', () => overlayEditar.classList.remove('activo'));
    btnCancelEditar.addEventListener('click', () => overlayEditar.classList.remove('activo'));
    overlayEditar.addEventListener('click', (e) => {
        if (e.target === overlayEditar) overlayEditar.classList.remove('activo');
    });

    // ===== ELIMINAR CON CONFIRMACIÓN =====
    document.querySelectorAll('.btn-eliminar-card').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                window.location.href = btn.getAttribute('href');
            }
        });
    });

});