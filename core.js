// core.js - Main Game Engine (JSON-based state storage)
class Game {
  constructor() {
      this.players = {};
      this.locations = {};
      this.stateFile = "game_state.json";
  }
  
  loadState() {
      fetch(this.stateFile)
          .then(response => response.json())
          .then(data => {
              this.players = data.players || {};
              this.locations = data.locations || {};
          })
          .catch(() => console.log("No previous state found, starting fresh."));
  }
  
  saveState() {
      const gameState = {
          players: this.players,
          locations: this.locations
      };
      fetch("save_game.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(gameState)
      });
  }
  
  addPlayer(player) {
      this.players[player.name] = player;
      this.saveState();
  }
  
  processCommand(player, command) {
      console.log(`${player.name} executed command: ${command}`);
      this.saveState();
  }
}

class Player {
  constructor(name) {
      this.name = name;
      this.inventory = [];
  }
  
  pickUp(item) {
      this.inventory.push(item);
  }
}

// Example usage:
const game = new Game();
game.loadState();
const player = new Player("Alice");
game.addPlayer(player);
game.processCommand(player, "pickup Shiny Key");
