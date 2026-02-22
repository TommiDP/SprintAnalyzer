<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentazione - SprintAnalyzer</title> 
    <link rel="icon" href="../images/sprintanalyzer.ico" type="image/ico">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    
    <?php 
        $p = "../"; 
        include "navbar.php"; 
    ?>

    <main>
        <section>
            <h2>Omologazione dei tempi</h2>
            <p>
                Per quanto riguarda il <strong>Vento:</strong> la <a href="https://worldathletics.org/" target="_blank">World Athletics</a> stabilisce che: 
                affinchè una prestazione sia considerata valida per record ufficiali, il vento a favore deve essere pari o inferiore a +2.0 m/s.
                Un vento superiore a questa soglia rende il risultato comunque valido per vincere la gara, ma il tempo non può essere riconosciuto come record 
                (mondiale, continentale o nazionale) né inserito nelle liste ufficiali per il conseguimento di minimi, se non con la dicitura "wind-aided".
            </p>

            <p>
                Per quanto riguarda l'<strong>Altitudine:</strong> non esiste un limite massimo restrittivo che renda invalida una gara di atletica leggera.
                Le prestazioni ottenute ad altitudini superiori a 1000 metri sul livello del mare sono semplicemente considerate "altitude-assisted" (aiutate dall'altitudine),
                ma restano comunque valide per eventuali record. 
            </p>
                
            <ul>
                <li> Per leggere gli articoli ufficiali worldathletics, cliccare su questo <a href="https://worldathletics.org/about-iaaf/documents/book-of-rules" target="_blank">link</a></li>
            </ul>
        </section>

        <section>
            <h2>Algoritmi e Studi usati</h2>
            <p>
                Articoli scientifici e studi accademici sono stati utilizzati per sviluppare gli algoritmi di normalizzazione e predizione dei tempi.
                Ecco i 'Papers' usati:
            </p>
                <ul>
                    <li><a href="https://onlinelibrary.wiley.com/doi/10.1080/17461391.2018.1480062" target="_blank">Data-driven quantification of the effect of wind on athletics performance</a> </li>
                    <li><a href="https://www.researchgate.net/figure/Effect-of-altitude-on-running-performance-for-men-and-women-in-distances-from-100-m-to_fig1_272842345 " target="_blank">Effects of Altitude on Performance of Elite Track-and-Field Athletes</a></li>
                    <li><a href="https://commons.nmu.edu/cgi/viewcontent.cgi?article=1277&context=isbs" target="_blank">Effect of altitude on 100-M sprint times</a></li>
                    <li><a href="https://ww2.amstat.org/mam/2010/essays/AldayFrantzWind.pdf" target="_blank">The  Effects of Wind and Altitude in the 400m Sprint</a></li>
                    <li><a href="https://www.researchgate.net/publication/297869849_The_Effects_of_Wind_and_Altitude_in_the_200-m_Sprint" target="_blank">The Effects of Wind and Altitude in the 200m Sprint</a></li>
                </ul>

        </section>

    </main>

    <footer>
        <p>&copy; 2026 - Progetto di Progettazione Web - Realizzato da Tommaso Di Pede</p>
    </footer>

</body>
</html>