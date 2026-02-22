<?php
session_start();

if(!isset($_SESSION['id_atleta'])) {
    header("Location: login.php");
    exit();
}

require_once "dbaccess.php"; 

$messaggio = "";
$tipo_messaggio = ""; 

if(isset($_POST['salva_risultato'])) {
    
    $id_atleta = $_SESSION['id_atleta'];
    $tempo      = trim($_POST['tempo']);
    $distanza   = trim($_POST['distanza']);
    $vento = isset($_POST['vento']) ? trim($_POST['vento']) : 0;
    $altitudine = trim($_POST['altitudine']);
    $data_gara  = trim($_POST['data_gara']);

    $query = "INSERT INTO risultati (id_atleta, tempo, distanza, vento, altitudine, data_gara) VALUES (?, ?, ?, ?, ?, ?)";
    

    if ($stmt = mysqli_prepare($connection, $query)) {
        
        mysqli_stmt_bind_param($stmt, 'idsdis', $id_atleta, $tempo, $distanza, $vento, $altitudine, $data_gara);
        
        if(mysqli_stmt_execute($stmt)) {
            $messaggio = "Prestazione registrata con successo!";
            $tipo_messaggio = "successo";
        } else {
            $messaggio = "Errore durante il salvataggio: " . mysqli_stmt_error($stmt);
            $tipo_messaggio = "errore";
        }
        mysqli_stmt_close($stmt);
    } else {
        
        $messaggio = "Errore tecnico: " . mysqli_error($connection);
        $tipo_messaggio = "errore";
    }
}
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Atleta-SprintAnalyzer</title>
    <link rel="icon" href="../images/sprintanalyzer.ico" type="image/ico">
    <link rel="stylesheet" href="../css/style.css" >
    <script src="../js/checkvento.js"></script>
    <script src="../js/area_atleta.js"></script>
</head>
<body>

    <?php 
    $p = "../";
    include "navbar.php"; 
    ?>

    <div class="container-dashboard">
        <a href="logout.php" class="btn-logout">Logout </a>

    <div class="welcome-msg">
        <h1>Bentornato, <span><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></span>!</h1>
        <p>Inserisci i dati della tua ultima gara per analizzare la prestazione</p>
    </div>

    <?php if($messaggio != ""): ?>
        <div class="alert <?php echo htmlspecialchars($tipo_messaggio, ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($messaggio, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <form action="area_atleta.php" method="POST">

            <label>Distanza (metri):</label>
            <select name="distanza" id="distanzaAtleta" required>   
                <option value="">seleziona distanza</option>         
                <option value="100m">100 metri</option>
                <option value="200m">200 metri</option>
                <option value="400m">400 metri</option>
            </select>

            <label>Tempo (secondi):</label>
            <input type="number" step="0.01" name="tempo" placeholder="es. 11.25" min="0" max="999" required>

            <div id="boxVentoAtleta"> 
                <label>Vento (m/s):</label>
                <input type="number" step="0.1" name="vento" id="ventoAtleta" min="-10" max="10" placeholder="es. 1.2" required>
            </div>

            <label>Altitudine (metri):</label>
            <input type="number" name="altitudine" min="0" max="3000" placeholder="es. 0" required>

            <label>Data della gara:</label> 
            <input type="date" name="data_gara" required max="<?php echo date('Y-m-d'); ?>" >
            

            <button type="submit" name="salva_risultato" class="btn-submit">
                Registra Prestazione
            </button>

        </form>
    </div>

</body>
</html>