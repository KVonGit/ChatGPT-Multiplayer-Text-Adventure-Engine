<?php
// index.php - Main entry point for the game
session_start();

// Load existing game state or initialize a new one
$stateFile = "game_state.json";
if (!file_exists($stateFile)) {
    file_put_contents($stateFile, json_encode(["players" => [], "locations" => []]));
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["player_name"])) {
    $_SESSION["player_name"] = htmlspecialchars($_POST["player_name"]);
    header("Location: game.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplayer Text Adventure</title>
</head>
<body>
    <h1>Welcome to the Multiplayer Text Adventure</h1>
    <form method="POST">
        <label for="player_name">Enter your name:</label>
        <input type="text" id="player_name" name="player_name" required>
        <button type="submit">Start Game</button>
    </form>
</body>
</html>
