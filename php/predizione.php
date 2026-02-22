<?php
session_start();

if(!isset($_SESSION['id_atleta'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predizione Performance - SprintAnalyzer</title>
    <link rel="icon" href="../images/sprintanalyzer.ico" type="image/ico">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/predizione.js"></script>
</head>

<body>
    
    <?php 
    $p = "../"; 
    include "navbar.php"; 
    ?>

    <div class="container-dashboard">
        <div class="welcome-msg">
            <h1>Algoritmo <span>Predittivo</span></h1>
            <h2>Analisi statistica in tempo reale</h2>
            <p>Predizione basata sulle prestazioni dell' ultimo anno</p>
        </div>

        <div class="card">
            <form id="formPredizione">
                
                <label>Seleziona la distanza da analizzare:</label>
                <select name="distanza" required>
                    <option value="" disabled selected>-- Scegli Distanza --</option>
                    <option value="100m">100 metri</option>
                    <option value="200m">200 metri</option>
                    <option value="400m">400 metri</option>
                </select>

                <button type="submit" class="btn-submit">Genera Predizione</button>
            </form>

            <div id="errorContainer" class="alert errore"></div>

            <div id="resultContainer">
                
                <h3>Range Previsto: <span id="lblDistanza"></span></h3>
                
                <div class="predizione-container">
                    <div class="pred-box box-best">
                        <h4 id="valOttimistico">--</h4>
                        <p>Ottimistica<br></p>
                    </div>

                    <div class="pred-box box-avg">
                        <h4 id="valRealistico">--</h4>
                        <p>Realistica</p>
                    </div>

                    <div class="pred-box box-worst">
                        <h4 id="valPessimistico">--</h4>
                        <p>Pessimistica</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>