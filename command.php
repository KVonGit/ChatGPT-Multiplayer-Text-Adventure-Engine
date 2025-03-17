<?php
// command.php - Handles player commands
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["message" => "Invalid request."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$playerName = $data["player"] ?? "Unknown";
$command = $data["command"] ?? "";

$stateFile = "game_state.json";
$gameState = json_decode(file_get_contents($stateFile), true);
if (!$gameState) {
    $gameState = ["players" => [], "locations" => []];
}

if (!isset($gameState["players"]["$playerName"])) {
    $gameState["players"]["$playerName"] = ["inventory" => []];
}

$responseMessage = "$playerName executed: $command";

// Basic command handling (expand as needed)
if (strpos($command, "pickup") === 0) {
    $item = trim(substr($command, 7));
    $gameState["players"]["$playerName"]["inventory"][] = $item;
    $responseMessage = "$playerName picked up a $item.";
}

file_put_contents($stateFile, json_encode($gameState, JSON_PRETTY_PRINT));

echo json_encode(["message" => $responseMessage]);
?>
