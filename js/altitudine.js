/**
Calcola il vantaggio dato dall'altitudine.
Tadv = c * (log10(alt))^b
Dove il parametri c dipende dalla distanza, determinato dai papers citati
 */

function calcolaAltitudine(dist, altVal) {
    if (altVal <= 0) return 0;

    let c = 0;
    const b = 5.59;

    if (dist === '100m') {
        c = 0.00011; 
    } else if (dist === '200m') {
        c = 0.00023; 
    } else if (dist === '400m') {
        c = 0.00035; 
    }

    const logAlt = Math.log10(altVal);
    const Tadvantage = c * Math.pow(logAlt, b);
    
    return Tadvantage;
}