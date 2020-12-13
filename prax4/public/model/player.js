const sql = require("./db.js");

const Player = function(player) {
   this.name = player.name;
   this.numOfTurns = player.numOfTurns;
   this.gameId = player.gameId;
   this.state = player.state;
   this.ones = player.ones;
   this.twos = player.twos;
   this.threes = player.threes;
   this.fours = player.fours;
   this.fives = player.fives;
   this.sixes = player.sixes;
   this.jokker = player.jokker;
   this.total = player.total;
   this.yahtzee = player.yahtzee;
   this.FH = player.FH;
   this.LS = player.LS;
   this.SS = player.SS;
   this.FK = player.FK;
   this.TK = player.TK;
};

Player.create = async (newPlayer, result) => {
    sql.query(`SELECT * FROM games WHERE numOfTurns = ${newPlayer.numOfTurns} AND secondPlayerId IS null`, (err, res) => {

        if (err) {
            console.log("error: ", err);
            result(err, null);
            return;
        }

        if (res.length) {
            let respon = JSON.stringify(res);

            let pars = JSON.parse(respon);
            newPlayer.gameId = pars[0].gameId;
            newPlayer.state = 1;
            sql.query("INSERT INTO players SET ?", newPlayer, (err, resp) => {
                if (err) {
                    console.log("error: ", err);
                    result(err, null);
                    return;
                }

                sql.query(
                    `UPDATE games SET secondPlayerId = ?, secondPlayerName = ? WHERE gameId = ${newPlayer.gameId}`,
                    [resp.insertId, newPlayer.name],

                    (err, response) => {
                        if (err) {
                            console.log("error: ", err);
                            result(null, err);
                            return;
                        }
                    }
                );

                result(null, {id: resp.insertId, ...newPlayer});

            });
        } else {
            sql.query(`INSERT INTO games SET numOfTurns = ${newPlayer.numOfTurns}`, (err, response) => {
                if (err) {
                    console.log("error: ", err);
                    result(err, null);
                    return;
                }

                newPlayer.gameId = response.insertId;
                sql.query("INSERT INTO players SET ?", newPlayer, (err, res) => {
                    if (err) {
                        console.log("error: ", err);
                        result(err, null);
                        return;
                    }
                    sql.query(
                        `UPDATE games SET firstPlayerId = ?, firstPlayerName = ? WHERE gameId = ${newPlayer.gameId}`,
                        [res.insertId, newPlayer.name],

                        (err, response) => {
                            if (err) {
                                console.log("error: ", err);
                                result(null, err);
                                return;
                            }

                            result(null, {id: res.insertId, ...newPlayer});
                        }
                    );

                });
            });
        }

    });

};

Player.stateById = async (id, result) => {
    sql.query(
        `SELECT * FROM players WHERE playerId = ${id}`,
        (err, res) => {
            if (err) {
                console.log("error: ", err);
                result(err, null);
                return;
            }

            if (res.length) {
                result(null, res[0]);
                return;
            }

            result({ kind: "not_found" }, null);
        }
    );
};


Player.updateById = async (id, move, points, player, result) => {
    sql.query(
        `UPDATE players SET ${move} = ?, state = ?, total = ? WHERE playerId = ?`,
        [points, 0, player.total, id],
        (err, res) => {
            if (err) {
                console.log("error: ", err);
                result(null, err);
                return;
            }

            if (res.affectedRows == 0) {
                result({ kind: "not_found" }, null);
                return;
            }
            sql.query(`SELECT * FROM games WHERE gameId = ${player.gameId}`, (err, resp) => {

                if (err) {
                    console.log("error: ", err);
                    result(err, null);
                    return;
                }

                if (resp.length) {
                    let respon = JSON.stringify(resp);
                    let pars = JSON.parse(respon);
                    let firstPlayerId = pars[0].firstPlayerId;
                    let secondPlayerId = pars[0].secondPlayerId;
                    let playerId;
                    if (id == firstPlayerId) {
                        playerId = secondPlayerId;
                    } else {
                        playerId = firstPlayerId;
                    }

                    sql.query(
                        `UPDATE players SET state = 1 WHERE playerId = ${playerId}`,
                        (err, response) => {
                            if (err) {
                                console.log("error: ", err);
                                result(null, err);
                                return;
                            }

                            if (response.affectedRows == 0) {
                                result({ kind: "not_found" }, null);
                                return;
                            }

                        });


                }
            });
            result(null, { id: id, ...player});
            console.log("updated player: ", { id: id, ...player});
        }
    );
};

Player.topResults = async (result) => {
    sql.query(
        `SELECT * FROM highscores ORDER BY playerScore DESC  LIMIT 10;`,
        (err, res) => {
            if (err) {
                console.log("error: ", err);
                result(err, null);
                return;
            }
            if (res.length) {
                result(null, res);
                return;
            }

            result({ kind: "not_found" }, null);
        }
    );
};

Player.turnResults = async (id, gameId, result) => {
    sql.query(
        `SELECT * FROM games WHERE gameId = ${gameId}`,
        (err, res) => {
            if (err) {
                console.log("error: ", err);
                result(err, null);
                return;
            }

            if (res.length) {
                let respon = JSON.stringify(res);
                let pars = JSON.parse(respon);
                let firstPlayerId = pars[0].firstPlayerId;
                let secondPlayerId = pars[0].secondPlayerId;
                let playerId;
                if (id == firstPlayerId) {
                    playerId = secondPlayerId;
                } else {
                    playerId = firstPlayerId;
                }

                sql.query(
                    `SELECT * FROM players WHERE playerId = ${playerId}`,
                    (err, response) => {
                        if (err) {
                            console.log("error: ", err);
                            result(err, null);
                            return;
                        }
                        if (response.length) {
                            let respon = JSON.stringify(response);
                            let parse = JSON.parse(respon);
                            const player = new Player({
                                name: parse[0].name,
                                numOfTurns: parse[0].numOfTurns,
                                gameId: parse[0].gameId,
                                state: parse[0].state,
                                ones: parse[0].ones,
                                twos: parse[0].twos,
                                threes: parse[0].threes,
                                fours: parse[0].fours,
                                fives: parse[0].fives,
                                sixes: parse[0].sixes,
                                jokker: parse[0].jokker,
                                yahtzee: parse[0].jokker,
                                FH: parse[0].FH,
                                LS: parse[0].LS,
                                SS: parse[0].SS,
                                FK: parse[0].FK,
                                TK: parse[0].TK,
                                total: parse[0].total


                            });
                            result(null, player);
                            return;
                        }
                    });
            }
        }
    );
};


Player.endGame = async (winner, result) => {
    sql.query(`SELECT * FROM games WHERE gameId = ${winner.gameId} `, (err, res) => {

        if (err) {
            console.log("error: ", err);
            result(err, null);
            return;
        }

        if (res.length) {
            let respon = JSON.stringify(res);
            let pars = JSON.parse(respon);
            let total = winner.total;
            let firstId = pars[0].firstPlayerId;
            let secondId = pars[0].secondPlayerId;
            let firstPlayerName = pars[0].firstPlayerName
            let secondPlayerName =  pars[0].secondPlayerName;
            let playerId;
            let updateId;
            let name;
            if (firstId == winner.state) {
                updateId = secondId;
            } else {
                updateId = firstId;
            }
            if (winner.name != null) {
                name = winner.name;
                playerId = winner.state;
            } else {
                if (winner.state == firstId) {
                    name = secondPlayerName;
                    playerId = secondId;
                } else {
                    name = firstPlayerName;
                    playerId = firstId;
                }
            }
            sql.query(
                `UPDATE players SET state = 2 WHERE playerId = ${updateId}`,
                (err, response) => {
                    if (err) {
                        console.log("error: ", err);
                        result(null, err);
                        return;
                    }
                }
            );
            sql.query("INSERT INTO highScores SET playerId = ?, playerName = ?, playerScore = ?, gameId = ? ", [playerId, name, total, winner.gameId], (err, resp) => {
                if (err) {
                    console.log("error: ", err);
                    result(err, null);
                    return;
                }

                sql.query(`SELECT * FROM highScores WHERE gameId = ${winner.gameId}`, (err, end) => {

                    if (err) {
                        console.log("error: ", err);
                        result(err, null);
                        return;
                    }

                    if (end.length) {

                        result(null, end[0]);
                    }
                });
            });
            }

    });
}
Player.winner = async (id, result) => {
    sql.query(
        `SELECT * FROM highscores WHERE gameId = ${id}`,
        (err, res) => {
            if (err) {
                console.log("error: ", err);
                result(err, null);
                return;
            }

            if (res.length) {
                result(null, res[0]);
                return;
            }

            result({ kind: "not_found" }, null);
        }
    );
};


Player.remove = (id, result) => {

    sql.query("DELETE FROM games WHERE gameId = ?", id, (err, res) => {
        if (err) {
            console.log("error: ", err);
            result(null, err);
            return;
        }

        if (res.affectedRows == 0) {
            result({ kind: "not_found" }, null);
            return;
        }

        sql.query("DELETE FROM players WHERE gameId = ?", id, (err, res) => {
            if (err) {
                console.log("error: ", err);
                result(null, err);
                return;
            }

            if (res.affectedRows == 0) {
                result({ kind: "not_found" }, null);
                return;
            }

        });

        result(null, res);
    });
};




module.exports = Player;