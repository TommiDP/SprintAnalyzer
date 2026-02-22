function calcola() {
    
    const inTempo = document.getElementById('tempoNorm');
    const inAlt = document.getElementById('altitudineNorm');
    const inVento = document.getElementById('ventoNorm');
    const dist = document.getElementById('distanzaNorm').value;


    if (!inTempo.checkValidity() || !inAlt.checkValidity() || (!inVento.disabled && !inVento.checkValidity())) {
        return; 
    }

    const tempo = parseFloat(inTempo.value);
    const alt = parseInt(inAlt.value);
    const vento = inVento.disabled ? 0 : parseFloat(inVento.value);

    const risultato = tempo + calcolaVento(dist, vento) + calcolaAltitudine(dist, alt);

    document.getElementById('txtRisultatoNorm').textContent = `${risultato.toFixed(2)} s`;
    document.getElementById('boxRisultatoNorm').style.display = 'block';

}

function gestisciInput() {
    toggleVentoByDistanza('distanzaNorm', 'boxVentoNorm', 'ventoNorm');
}

function inizializzaNorm() {
    const selectDistanza = document.getElementById("distanzaNorm");
    
    if (selectDistanza) {
        selectDistanza.addEventListener('change', gestisciInput);
    }
    
    const btnCalcola = document.getElementById('btnCalcolaNorm');
    if (btnCalcola) {
        btnCalcola.addEventListener('click', calcola);
    }

    gestisciInput();
}

document.addEventListener("DOMContentLoaded", inizializzaNorm);