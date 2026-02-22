function caricaDati() {
    fetch('api_stats.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Errore nella risposta del server');
            }
            return response.json();
        })
        .then(tuttiIDati => {
            generaGrafici(tuttiIDati);
        })
        .catch(error => {
            console.error('Errore durante il fetch:', error);
        });
}


function generaGrafici(dati) {
    const charts = document.querySelectorAll('.sprint-chart');

    //opzioni comuni ai grafici
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { mode: 'index', intersect: false },
        plugins: { legend: { display: false } },
        scales: {
            x: { 
                grid: { display: false }, 
                offset: true 
            },
            y: { 
                title: { display: true, text: 'Secondi (s)' }, 
                grace: '10%' 
            }
        }
    };

    charts.forEach(canvas => {
        
        const targetDist = canvas.dataset.target;
        const datiDistanza = dati.filter(row => row.distanza === targetDist);

        if (datiDistanza.length === 0) return;


        const card = canvas.closest('.chart-card');
        const title = card.querySelector('.chart-title');
        const themeColor = getComputedStyle(title).color; 


        const labels = datiDistanza.map(item => 
            new Date(item.data_gara).toLocaleDateString('it-IT')
        );
        const values = datiDistanza.map(item => parseFloat(item.tempo));


        const dataset = {
            label: 'Tempo',
            data: values,
            borderColor: themeColor,
            backgroundColor: themeColor,
            pointBorderColor: themeColor,
            pointBackgroundColor: '#fff',
            borderWidth: 2,
            tension: 0,
            fill: false,
            pointRadius: 5,
            pointHoverRadius: 7
        };

        //creazione grafico effettivo
        new Chart(canvas.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [dataset]
            },
            options: chartOptions
        });
    });
}


document.addEventListener('DOMContentLoaded', caricaDati);