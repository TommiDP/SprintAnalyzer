<?php
session_start();
if(!isset($_SESSION['id_atleta'])) { header("Location: login.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normalizzatore e Simulatore - SprintAnalyzer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/sprintanalyzer.ico" type="image/ico">
    <script src="../js/checkvento.js"></script>
    <script src="../js/vento.js"></script>
    <script src="../js/altitudine.js"></script>
    <script src="../js/normalizzatore.js"></script>
    <script src="../js/simulatore.js"></script>
</head>

<body>

    <?php 
    $p = "../";
    include "navbar.php"; 
    ?>

    <div class="container-dashboard">
        <div class="welcome-msg">
            <h1>Normalizzatore & <span>Simulatore</span></h1>
            <h2>Calcola il tuo tempo normalizzato o simula le tue prestazioni in nuove condizioni</h2>
        </div>

        <div class="flex">
            <div class="card">
                <h3>Normalizzatore</h3>
                <p>Calcolo istantaneo del tempo in condizioni nulle (vento=0, altitudine=0)</p>

                <label for="distanzaNorm">Distanza:</label>
                <select id="distanzaNorm">
                    <option value="100m">100 metri</option>
                    <option value="200m">200 metri</option>
                    <option value="400m">400 metri</option>
                </select>

                <label for="tempoNorm">Tempo (s):</label>
                <input type="number" step="0.01" id="tempoNorm" min="0" max="999" placeholder="es. 9.99 s" required>

                <label for="altitudineNorm">Altitudine (0-3000m):</label>
                <input type="number" id="altitudineNorm" min="0" max="3000" placeholder="es 1000" required>

                <div id="boxVentoNorm">
                    <label for="ventoNorm">Vento (-10, 10m/s):</label>
                    <input type="number" step="0.1" id="ventoNorm" min="-10" max="10" placeholder="es 1.2" required>
                </div>

                <button type="button" id="btnCalcolaNorm" class="btn-submit">Calcola Normalizzato</button>

                <div id="boxRisultatoNorm" class="box-risultato">
                    <span>TEMPO NORMALIZZATO</span>
                    <h2 id="txtRisultatoNorm">--</h2>
                </div>
            </div>

            <div class="card">
                <h3>Simulatore tempi</h3>
                <p>Inserisci il tuo tempo base e proiettalo in nuove condizioni</p>

                <label for="distanzaSim">Distanza:</label>
                <select id="distanzaSim">
                    <option value="100m">100 metri</option>
                    <option value="200m">200 metri</option>
                    <option value="400m">400 metri</option>
                </select>      
                
                <label for="tempoBaseSim">Tempo Base (s):</label>
                <input type="number" step="0.01" id="tempoBaseSim" min="0" max="999" placeholder="es. 10.20" required>

                <label for="altitudineSim">Target Altitudine (0-3000m):</label>
                <input type="number" id="altitudineSim" min="0" max="3000" placeholder="es. 2000" required>

                <div id="boxVentoSim">
                    <label for="ventoSim">Target Vento (0-2.0 m/s):</label>
                    <input type="number" step="0.1" id="ventoSim" min="0" max="2" placeholder="es. 2.0" required>
                </div>

                <button type="button" id="btnSimulaSim" class="btn-submit">Simula Tempo</button>

                <div id="boxRisultatoSim" class="box-risultato">
                    <span>TEMPO PREVISTO</span>
                    <h2 id="txtRisultatoSim">--</h2>
                </div>
            </div>
        </div> </div>
</body>
</html>