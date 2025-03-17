<?php
// save_game.php - Saves game state to JSON
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["message" => "Invalid request."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(["message" => "No data received."]);
    exit;
}

$stateFile = "game_state.json";
file_put_contents($stateFile, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["message" => "Game state saved successfully."]);
?>
