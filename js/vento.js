/*
Calcolo il vantaggio dato dal vento.
Tadv = a*wind + b*wind^2 
Dove i parametri a e b dipendono dalla distanza e sono stati determinati dai papers citati
*/

function calcolaVento(dist, ventoVal) {
    let corr = 0;
    let a = 0;
    let b = 0;

    if (dist === '100m') {
        a = 0.071; 
        b = 0.0042; 
    } else if (dist === '200m') {
        a = 0.090; 
        b = 0.010; 
    } else {
        // 400m non influisce il vento
        return 0;
    }

    Tadvantage = (a * ventoVal) + (b * Math.pow(ventoVal, 2) * Math.sign(ventoVal));

    return Tadvantage;
}