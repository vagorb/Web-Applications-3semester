const Player= require("../model/player.js");


exports.create = (req, res) => {

    if (!req.body) {
        res.status(400).send({
            message: "Content can not be empty!"
        });
    }


    const player = new Player({
        name: req.body.name,
        numOfTurns: req.body.numOfTurns,
        gameId: null,
        state: 0,
        ones: null,
        twos: null,
        threes: null,
        fours: null,
        fives: null,
        sixes: null,
        jokker: null,
        total: null,
        yahtzee: null,
        FH: null,
        LS: null,
        SS: null,
        FK: null,
        TK: null
    });


    Player.create(player, (err, data) => {

        if (err)
            res.status(500).send({
                message:
                    err.message || "Some error occurred while creating the player."
            });
        else res.send(data);
    });
};




exports.states = (req, res) => {
    Player.stateById(req.params.id, (err, data) => {
        if (err) {
            if (err.kind === "not_found") {
                res.status(404).send({
                    message: `Not found player with id ${req.params.id}.`
                });
            } else {
                res.status(500).send({
                    message: "Error retrieving player with id " + req.params.id
                });
            }
        } else res.send(data);
    });
};


exports.turn = (req, res) => {

    if (!req.body) {
        res.status(400).send({
            message: "Content can not be empty!"
        });
    }

    Player.updateById(
        req.params.id,
        req.params.move,
        req.params.points,
        new Player(req.body),
        (err, data) => {
            if (err) {
                if (err.kind === "not_found") {
                    res.status(404).send({
                        message: `Not found player with id ${req.params.id}.`
                    });
                } else {
                    res.status(500).send({
                        message: "Error updating player with id " + req.params.id
                    });
                }
            } else res.send(data);
        }
    );
};

exports.topResults = (req, res) => {
    Player.topResults((err, data) => {
        if (err) {
            if (err.kind === "not_found") {
                res.status(404).send({
                    message: `Not found player with id ${req.params.id}.`
                });
            } else {
                res.status(500).send({
                    message: "Error retrieving player with id " + req.params.id
                });
            }
        } else res.send(data);
    });
};



exports.turnResults = (req, res) => {
    Player.turnResults(req.params.id, req.params.gameId, (err, data) => {
        if (err) {
            if (err.kind === "not_found") {
                res.status(404).send({
                    message: `Not found player with id ${req.params.id}.`
                });
            } else {
                res.status(500).send({
                    message: "Error retrieving player with id " + req.params.id
                });
            }
        } else res.send(data);
    });
};


exports.endGame = (req, res) => {

    if (!req.body) {
        res.status(400).send({
            message: "Content can not be empty!"
        });
    }


    const winner = new Player({
        name: req.body.name,
        numOfTurns: null,
        gameId: req.body.gameId,
        state: req.body.id,
        ones: null,
        twos: null,
        threes: null,
        fours: null,
        fives: null,
        sixes: null,
        jokker: null,
        total: req.body.total
    });


    Player.endGame(winner, (err, data) => {

        if (err)
            res.status(500).send({
                message:
                    err.message || "Some error occurred in end game."
            });
        else res.send(data);
    });
};

exports.winner = (req, res) => {
    Player.winner(req.params.gameId, (err, data) => {
        if (err) {
            if (err.kind === "not_found") {
                res.status(404).send({
                    message: `Not found game with id ${req.params.gameId}.`
                });
            } else {
                res.status(500).send({
                    message: "Error retrieving game with id " + req.params.gameId
                });
            }
        } else res.send(data);
    });
};

exports.delete = (req, res) => {
    Player.remove(req.params.gameId, (err, data) => {
        if (err) {
            if (err.kind === "not_found") {
                res.status(404).send({
                    message: `Not found game with id ${req.params.gameId}.`
                });
            } else {
                res.status(500).send({
                    message: "Could not delete game with id " + req.params.gameId
                });
            }
        } else res.send({ message: `Game and players were deleted successfully!` });
    });
};

