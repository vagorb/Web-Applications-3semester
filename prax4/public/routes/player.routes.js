module.exports = app => {
    const players = require("../controller/player.controller.js");


    app.post("/players" ,players.create);

    app.put("/turn/:id/:move/:points" ,players.turn);

    app.get("/states/:id", players.states);

    app.get("/topResults", players.topResults);

    app.get("/turnResults/:id/:gameId", players.turnResults);

    app.post("/endGame", players.endGame);

    app.get("/winner/:gameId", players.winner);

    app.delete("/delete/:gameId", players.delete);


};