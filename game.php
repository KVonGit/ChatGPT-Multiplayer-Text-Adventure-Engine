<?php
// game.php - Main game interface
session_start();
if (!isset($_SESSION["player_name"])) {
    header("Location: index.php");
    exit;
}
$playerName = $_SESSION["player_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Interface</title>
    <script>
        function sendCommand() {
            const command = document.getElementById("commandInput").value;
            fetch("command.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ player: "<?php echo $playerName; ?>", command: command })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("gameOutput").innerText += "\n" + data.message;
            });
            document.getElementById("commandInput").value = "";
        }
    </script>
</head>
<body>
    <h1>Welcome, <?php echo $playerName; ?>!</h1>
    <pre id="gameOutput">You find yourself in a strange world...</pre>
    <input type="text" id="commandInput" placeholder="Enter command...">
    <button onclick="sendCommand()">Send</button>
</body>
</html>
