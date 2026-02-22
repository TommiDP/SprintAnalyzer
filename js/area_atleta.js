function aggiornaVentoAtleta() {
    toggleVentoByDistanza('distanzaAtleta', 'boxVentoAtleta', 'ventoAtleta');
}

function inizializzaAreaAtleta() {
    const selectDist = document.getElementById("distanzaAtleta");
    
    if (selectDist) {
        selectDist.addEventListener('change', aggiornaVentoAtleta);
        
        aggiornaVentoAtleta();
    }
}

document.addEventListener("DOMContentLoaded", inizializzaAreaAtleta);