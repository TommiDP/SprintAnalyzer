<?php
session_start();
require_once "dbaccess.php"; 

header('Content-Type: application/json');

//non loggato, array vuoto
if(!isset($_SESSION['id_atleta'])) {
    echo json_encode([]); 
    exit();
}

if(!isset($_GET['distanza'])) {
    echo json_encode(['error' => 'Distanza mancante']);
    exit();
}

$id_atleta = $_SESSION['id_atleta'];
$distanza = $_GET['distanza'];

$query = "SELECT tempo 
          FROM risultati 
          WHERE id_atleta = ? 
          AND distanza = ? 
          AND data_gara >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";

$stmt = $connection->prepare($query);
$stmt->bind_param("is", $id_atleta, $distanza);
$stmt->execute();
$result = $stmt->get_result();

//fetch 
$tempi = [];
while($row = $result->fetch_assoc()) {
    $tempi[] = floatval($row['tempo']);
}

//output json
echo json_encode($tempi);
exit();
?>