<?php
session_start();
require_once "dbaccess.php"; 

//verifica login
if(!isset($_SESSION['id_atleta'])) { header("Location: login.php"); exit; }
$id = $_SESSION['id_atleta'];

//gestione eliminazione 
if(isset($_POST['del'])) {
    $stmt = $connection->prepare("DELETE FROM risultati WHERE id=? AND id_atleta=?");
    $stmt->bind_param("ii", $_POST['del'], $id);
    $stmt->execute();
    header("Location: statistiche.php"); 
    exit;
}

//recupero dati
$query = "SELECT id, data_gara, distanza, tempo, vento, altitudine 
          FROM risultati 
          WHERE id_atleta=? 
          ORDER BY FIELD(distanza, '100m', '200m', '400m'), data_gara DESC";

$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafici e Storico - SprintAnalyzer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/sprintanalyzer.ico" type="image/ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script src="../js/grafici.js"></script>
</head>

<body>

    <?php 
        $p = "../"; 
        include "navbar.php"; 
    ?>

    <main class="container-dashboard">
        
        <div class="welcome-msg">
            <h1>I Tuoi <span>Risultati</span></h1>
        </div>

        <div class="stats-container">
            <?php if(empty($data)): ?>
                <p>Nessuna gara inserita.</p>
            <?php else: ?>
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Gara</th>
                            <th>Tempo</th>
                            <th>Vento</th>
                            <th>Altitudine</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars(date("d/m/Y", strtotime($row['data_gara'])), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['distanza'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars(number_format($row['tempo'], 2), ENT_QUOTES, 'UTF-8') ?> s</td>
                            
                            <?php 
                                $is_windy = ($row['vento'] > 2.0);
                                $css_vento = $is_windy ? 'vento-outrange' : '';
                                $display_vento = ($row['vento'] > 0 ? '+' : '') . $row['vento'];
                            ?>
                            <td class="<?= htmlspecialchars($css_vento, ENT_QUOTES, 'UTF-8') ?>">
                                <?= ($row['distanza'] === '400m') ? '' : htmlspecialchars($display_vento, ENT_QUOTES, 'UTF-8') ?>
                            </td>

                            <td><?= htmlspecialchars($row['altitudine'], ENT_QUOTES, 'UTF-8') ?>m</td>

                            <td>
                                <form method="POST" onsubmit="return confirm('Vuoi davvero eliminare questo risultato?');">
                                    <input type="hidden" name="del" value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button class="btn-delete">Elimina</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div class="charts-grid">
            <?php 
            
            $distanze_presenti = [];
            if (!empty($data)) {
                $distanze_presenti = array_unique(array_column($data, 'distanza'));
            }
            ?>

            <?php foreach(['100m', '200m', '400m'] as $d): ?>
                
                <?php if(in_array($d, $distanze_presenti)): ?>
                    <div class="chart-card dist-<?= htmlspecialchars($d, ENT_QUOTES, 'UTF-8') ?>">
                        <h2 class="chart-title"><?= htmlspecialchars($d, ENT_QUOTES, 'UTF-8') ?></h2>
                        <div class="chart-wrapper">
                            <canvas class="sprint-chart" data-target="<?= $d ?>"></canvas>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>

    </main>

</body>
</html>