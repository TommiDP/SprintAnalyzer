function simula() {
    
    const inTempo = document.getElementById('tempoBaseSim');
    const inAlt = document.getElementById('altitudineSim');
    const inVento = document.getElementById('ventoSim');
    const dist = document.getElementById('distanzaSim').value;

    if (!inTempo.checkValidity() || !inAlt.checkValidity() || (!inVento.disabled && !inVento.checkValidity())) {
        return; 
    }

    const tempoBase = parseFloat(inTempo.value);
    const alt = parseInt(inAlt.value);
    const vento = inVento.disabled ? 0 : parseFloat(inVento.value);

    const risultato = tempoBase - calcolaVento(dist, vento) - calcolaAltitudine(dist, alt);

    document.getElementById('txtRisultatoSim').textContent = `${risultato.toFixed(2)} s`;
    document.getElementById('boxRisultatoSim').style.display = 'block';
}

function gestisciInputSim() {
    toggleVentoByDistanza('distanzaSim', 'boxVentoSim', 'ventoSim');
}

function inizializzaSim() {
    const selectDistanza = document.getElementById("distanzaSim");
    
    if (selectDistanza) {
        selectDistanza.addEventListener('change', gestisciInputSim);
    }
    
    const btnSimula = document.getElementById('btnSimulaSim');
    if (btnSimula) {
        btnSimula.addEventListener('click', simula);
    }

    gestisciInputSim();
}

document.addEventListener("DOMContentLoaded", inizializzaSim);