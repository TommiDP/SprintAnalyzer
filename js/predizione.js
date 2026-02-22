function predici() {
    const form = document.getElementById('formPredizione');
    const selectDistanza = form ? form.querySelector('select[name="distanza"]') : null;
    
    const boxErrori = document.getElementById('errorContainer');
    const boxRisultati = document.getElementById('resultContainer');

    const lblDistanza = document.getElementById('lblDistanza');
    const valOttimistico = document.getElementById('valOttimistico');
    const valRealistico = document.getElementById('valRealistico');
    const valPessimistico = document.getElementById('valPessimistico');

    if (!form || !selectDistanza) return;

    const gestisciReset = () => {
        if(boxErrori) {
            boxErrori.style.display = 'none';
            while (boxErrori.firstChild) boxErrori.removeChild(boxErrori.firstChild);
        }
        if(boxRisultati) {
            boxRisultati.style.display = 'none';
        }
    };

    //calcolo statistiche
    const calcolaStatistiche = (tempi, distanza) => {
        
        const sommaGrezza = tempi.reduce((a, b) => a + b, 0);
        const mediaGrezza = sommaGrezza / tempi.length;

        //filtro dati(scarto tempi a più di 5s di differenza dall avg)
        const tempiPuliti = tempi.filter(t => Math.abs(t - mediaGrezza) <= 5);
        //se filtrando tolgo (improbabile), uso i dati originali
        const dataset = tempiPuliti.length > 0 ? tempiPuliti : tempi;

        const best = Math.min(...dataset);
        const somma = dataset.reduce((a, b) => a + b, 0);
        const media = somma / dataset.length;

        //previsione basata su margine teorico e distanza
        let fattoreScala = 1; //default 100m
        if (distanza === '200m') fattoreScala = 1.6;
        if (distanza === '400m') fattoreScala = 2.8;

        const gap = media - best;
        
        const margineTeorico = 0.13; 
    
        const maxBonus = margineTeorico * fattoreScala;

        const penalita = gap / (3 * fattoreScala);

        let bonus = maxBonus - penalita;
        if (bonus < 0) bonus = 0;

        const predictionBest = best - bonus;
        const predictionWorst = media + gap;

        return {
            min: predictionBest, 
            real: media,         
            max: predictionWorst 
        };
    };


    const mostraErrore = (messaggio) => {
        if (!boxErrori) return;

        const pMessaggio = document.createElement('div');
        pMessaggio.textContent = messaggio;
        pMessaggio.style.marginBottom = '10px';

        const linkAggiungi = document.createElement('a');
        linkAggiungi.href = 'area_atleta.php';
        linkAggiungi.textContent = 'Inserisci nuova gara';
        linkAggiungi.className = 'btn-submit'; 

        boxErrori.appendChild(pMessaggio);
        boxErrori.appendChild(linkAggiungi);
        boxErrori.style.display = 'block';
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        gestisciReset();

        const distanza = selectDistanza.value;
        if (!distanza) return;

        try {
            const response = await fetch(`api_predizione.php?distanza=${distanza}`);
            
            if (!response.ok) throw new Error("Errore di comunicazione col server.");

            const tempi = await response.json();

            if (!Array.isArray(tempi) || tempi.length < 2) {
                throw new Error("Dati insufficienti: servono almeno 2 gare recenti.");
            }

            const stats = calcolaStatistiche(tempi, distanza);

            if (boxRisultati) {
                lblDistanza.textContent = distanza;
                valOttimistico.textContent  = stats.min.toFixed(2) + "s";
                valRealistico.textContent   = stats.real.toFixed(2) + "s";
                valPessimistico.textContent = stats.max.toFixed(2) + "s";
                
                boxRisultati.style.display = 'block';
            }

        } catch (errore) {
            mostraErrore(errore.message);
        }
    });

    gestisciReset();
}

document.addEventListener('DOMContentLoaded', predici);