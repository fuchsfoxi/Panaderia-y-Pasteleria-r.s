/* =========================================================
   dashboard.js — Panadería y Pastelería R.S SAC
   1. Toggle sidebar (hamburguesa)
   2. Fetch /dashboard/datos → cards + gráfico Chart.js
   ========================================================= */

document.addEventListener('DOMContentLoaded', () => {

    /* ─────────────────────────────────────────────────────
       1. TOGGLE SIDEBAR
    ───────────────────────────────────────────────────── */
    const hamburger = document.querySelector('.hamburger');
    const sidebar   = document.querySelector('.sidebar');
    const overlay   = document.querySelector('.overlay');

    function abrirSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('show');
    }

    function cerrarSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    }

    if (hamburger) hamburger.addEventListener('click', abrirSidebar);
    if (overlay)   overlay.addEventListener('click', cerrarSidebar);


    /* ─────────────────────────────────────────────────────
       2. FETCH DE DATOS  →  /dashboard/datos
    ───────────────────────────────────────────────────── */
    const BASE_URL = window.BASE_URL || '';   // definido en index.php

    async function cargarDatos() {
        try {
            const res  = await fetch(`${BASE_URL}/dashboard/datos`);
            const data = await res.json();

            llenarCards(data);
            renderGrafico(data);

        } catch (err) {
            console.error('Error al cargar datos del dashboard:', err);
        }
    }


    /* ─────────────────────────────────────────────────────
       3. LLENAR CARDS
    ───────────────────────────────────────────────────── */
    function llenarCards(data) {
        const hoy  = data.hoy  || {};
        const turno = data.ultimo_turno || '';

        setCard('content_panes',     hoy['Pan']      ?? null);
        setCard('content_tortas',    hoy['Torta']    ?? null);
        setCard('content_bocaditos', hoy['Bocadito'] ?? null);
        setCard('content_turno',     turno || null, true);
    }

    /**
     * @param {string}  id       — id del div .card_content
     * @param {*}       valor    — número o string; null = sin datos
     * @param {boolean} esTexto  — si true no agrega " und."
     */
    function setCard(id, valor, esTexto = false) {
        const el = document.getElementById(id);
        if (!el) return;

        if (valor === null || valor === '' || valor === 0 && !esTexto) {
            el.textContent = '';          // activa el ::after "¡Ups! Sin datos"
            return;
        }

        el.textContent = esTexto ? valor : `${valor} und.`;
    }


    /* ─────────────────────────────────────────────────────
       4. GRÁFICO DE BARRAS  (Chart.js)
    ───────────────────────────────────────────────────── */
    function renderGrafico(data) {
        const canvas = document.getElementById('grafico_barras');
        if (!canvas) return;

        const hoy  = data.hoy  || {};
        const ayer = data.ayer || {};

        const categorias = ['Panes', 'Tortas', 'Bocaditos'];
        const claves     = ['Pan',   'Torta',  'Bocadito'];

        const valoresHoy  = claves.map(k => hoy[k]  || 0);
        const valoresAyer = claves.map(k => ayer[k] || 0);

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: categorias,
                datasets: [
                    {
                        label: 'Ayer',
                        data: valoresAyer,
                        backgroundColor: '#7bbf8e',
                        borderRadius: 6,
                        barPercentage: 0.5,
                    },
                    {
                        label: 'Hoy',
                        data: valoresHoy,
                        backgroundColor: '#0B2B26',
                        borderRadius: 6,
                        barPercentage: 0.5,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },   // leyenda propia con los círculos del HTML
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.parsed.y} und.`
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Poppins', size: 12 },
                            color: '#0B2B26'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.06)' },
                        ticks: {
                            font: { family: 'Poppins', size: 11 },
                            color: '#3a6b4a',
                            stepSize: 250
                        }
                    }
                }
            }
        });
    }

    // Iniciar
    cargarDatos();
});