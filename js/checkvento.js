//gestisco abilitazione/disabilitazione del campo vento in base alla distanza

function toggleVentoByDistanza(distId, boxId, inputId) {
    const distElement = document.getElementById(distId);
    const boxVento = document.getElementById(boxId); 
    const inVento = document.getElementById(inputId);    

    if (!distElement || !inVento) return; 

    const dist = distElement.value;

    if (dist === '400m') {
        if (boxVento) boxVento.style.opacity = '0.5'; 
        inVento.value = 0;
        inVento.disabled = true;
    } else {
        if (boxVento) boxVento.style.opacity = '1';
        inVento.disabled = false;
    }
}