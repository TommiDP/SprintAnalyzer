<?php
session_start();
require_once "dbaccess.php"; 

header('Content-Type: application/json');

//non loggato, array vuoto
if(!isset($_SESSION['id_atleta'])) {
    echo json_encode([]); 
    exit();
}

$id_atleta = $_SESSION['id_atleta'];

$query = "SELECT data_gara, distanza, tempo 
          FROM risultati 
          WHERE id_atleta = ? 
          ORDER BY data_gara ASC";

$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id_atleta);
$stmt->execute();
$result = $stmt->get_result();

//fetch
$data = $result->fetch_all(MYSQLI_ASSOC);

//output json
echo json_encode($data);
exit();
?>