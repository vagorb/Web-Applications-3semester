document.addEventListener("DOMContentLoaded", topPlayers);

class Die {
    constructor(num_sides) {
        this.num_sides = num_sides;
        this.value = null;
    }

    roll() {
        this.value =  Math.floor(Math.random() * (this.num_sides) + 1);
    }

    html(i) {
        let elem = document.createElement("div");
        elem.className = "die";
        elem.classList.add("d" + this.value);
        elem.id = i;
        return elem;
    }
}

function gid(elem) {
    return document.getElementById(elem);
}

function topPlayers() {
    fetch('http://turing.cs.ttu.ee:6139/topResults', {
        method: 'get',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(res => res.json()).then(json => showTop10(json)).then(json => {startGame()});
}

function showTop10(json) {
    let table = gid("results")
    for (let i = Object.keys(json).length; i >  0; i--) {
        let row = table.insertRow(0);
        let cell0 = row.insertCell(0);
        let cell1 = row.insertCell(1);
        let cell2 = row.insertCell(2);
        cell0.innerHTML = (i).toString();
        cell1.innerHTML = json[i - 1].playerName;
        cell2.innerHTML = json[i - 1].playerScore;
    }
    let row = table.insertRow(0);
    let cell0 = row.insertCell(0);
    let cell1 = row.insertCell(1);
    let cell2 = row.insertCell(2);
    cell0.innerHTML = "Place";
    cell1.innerHTML = "Player";
    cell2.innerHTML = "Score";
}

function startGame() {
    gid("startModal").style.display = "block";



        gid("threeTurns").onclick = function() {
            const text = gid("name").value;
           if (text.length > 0) {
            return game(3, text)}};
        gid("sevenTurns").onclick = function() {
            const text = gid("name").value;
            if (text.length > 0) {
            const text = gid("name").value;
            return game(7, text)}};
        gid("thirteenTurns").onclick = function() {
            const text = gid("name").value;
            if (text.length > 0) {
            const text = gid("name").value;
            return game(13, text)}};
}


function game(value, name) {
    gid("startModal").style.display = "none";

    let body = {
        name: name,
        numOfTurns: value
    };

    fetch('http://turing.cs.ttu.ee:6139/players', {
        method: 'post',
        body: JSON.stringify(body),
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(res =>  res.json()).then(json => {if (json.state == 0) {

        gid("waitModal").style.display = "block";
        enemyTurn(value, name, json.id, json.gameId, -1);
    } else {

        yourTurn(value, name, json.id, json.gameId, 0);
    }
    });

}


function yourTurn(total, name, id, gameId, curTurn) {
    const totalTurns = total;

    const player = name;
    const TotalScore = gid("TotalScore");
    let rolls = 0;
    const gameTurns = gid("Turn");
    let turn = curTurn;
    gameTurns.innerHTML = "Turn " + (turn + 1) + "/" + totalTurns;
    let currentRolls = gid("rolls");



    function rollDice() {
        if (rolls < 3) {
            let die = new Die(6)
            let roll, elem;

            let table = gid("dice");
            table.textContent = "";

            for (let i = 0; i < 5; i++) {
                roll = die.roll();
                elem = die.html(i)
                table.appendChild(elem);
            }
            rolls++;
            currentRolls.textContent = "";
            currentRolls.innerHTML = "Roll " + (rolls) + "/3";
        }
    }

    gid("roll").onclick = rollDice;
    gid("ones").onclick = saveScoreToDatabase("ones", 1);
    gid("twos").onclick = saveScoreToDatabase("twos", 2);
    gid("threes").onclick = saveScoreToDatabase("threes", 3);
    gid("fours").onclick = saveScoreToDatabase("fours", 4);
    gid("fives").onclick = saveScoreToDatabase("fives", 5);
    gid("sixes").onclick = saveScoreToDatabase("sixes", 6);
    gid("jokker").onclick = saveScoreToDatabase("jokker", 0);

    gid("TK").onclick = sumCombo("TK");
    gid("FK").onclick = sumCombo("FK");
    gid("SS").onclick = sumCombo("SS");
    gid("LS").onclick = sumCombo("LS");
    gid("FH").onclick = sumCombo("FH");
    gid("yahtzee").onclick = sumCombo("yahtzee");


    function saveScoreToDatabase(name, value) {

        function save() {
            if (rolls > 0 && !gid(name).classList.contains("used")) {
                cellScore(name, sumOfSameDiceValues(value));
            }
        }
        return save;
    }

    function sumOfSameDiceValues(value) {
        let score = 0;
        for (let i = 0; i < 5; i++) {
            let num = parseInt(gid(i).classList.value.charAt(5));
            if (value === 0) {
                score += num;
            } else if (value === num) {
                score += num;
            }
        }
        return score;
    }

    function sumCombo(name) {
        function saveCombo() {
            if (rolls > 0 && !gid(name).classList.contains("used")) {
                if (name ==="TK") {
                    let array1 = [parseInt(gid(0).classList.value.charAt(5))];
                    let array2 = [];
                    let array3 = [];
                    let sum = parseInt(gid(0).classList.value.charAt(5));
                    for (let i = 1; i < 5; i++) {
                        let num = parseInt(gid(i).classList.value.charAt(5));
                        if (num == array1[0]) {
                            sum += num
                            array1.push(num);
                        } else if (array2.length == 0) {
                            array2.push(num);
                            sum += num
                        } else if (num == array2[0]) {
                            array2.push(num);
                            sum += num
                        } else if (array3.length == 0) {
                            array3.push(num);
                            sum += num
                        } else if (num == array3[0]) {
                            array3.push(num);
                            sum += num
                        }
                    }
                    if (array2.length == 3 || array1.length == 3 || array3.length == 3) {
                        cellScore(name, sum);
                    }
                    else {
                        cellScore(name, 0);
                    }
                } else if (name === "FK") {
                    let array1 = [parseInt(gid(0).classList.value.charAt(5))];
                    let array2 = [];
                    let sum = parseInt(gid(0).classList.value.charAt(5));
                    for (let i = 1; i < 5; i++) {
                        let num = parseInt(gid(i).classList.value.charAt(5));
                        if (num == array1[0]) {
                            sum += num
                            array1.push(num);
                        } else if (array2.length == 0 && num != array1[0]) {
                            array2.push(num);
                            sum += num
                        } else if (num == array2[0]) {
                            array2.push(num);
                            sum += num
                        }
                    }
                    if (array2.length == 4 || array1.length == 4) {
                        cellScore(name, sum);
                    } else {
                        cellScore(name, 0);
                    }
                } else if (name === "SS") {
                    let array = [];
                    for (let i = 0; i < 5; i++) {
                        let num = parseInt(gid(i).classList.value.charAt(5));
                        array.push(num);
                    }
                    if (array.includes(1) && array.includes(2) && array.includes(3) && array.includes(4)) {
                        cellScore(name, 30);
                    } else if (array.includes(2) && array.includes(3) && array.includes(4) && array.includes(5)) {
                        cellScore(name, 30);
                    } else if (array.includes(6) && array.includes(3) && array.includes(4) && array.includes(5)) {
                        cellScore(name, 30);
                    } else {
                        cellScore(name, 0);
                    }
                } else if (name === "LS") {
                    let array = [];
                    for (let i = 0; i < 5; i++) {
                        let num = parseInt(gid(i).classList.value.charAt(5));
                        array.push(num);
                    }
                    if (array.includes(1) && array.includes(2) && array.includes(3) && array.includes(4) && array.includes(5)) {
                        cellScore(name, 40);
                    } else if (array.includes(6) && array.includes(2) && array.includes(3) && array.includes(4) && array.includes(5)) {
                        cellScore(name, 40);
                    } else {
                        cellScore(name, 0);
                    }
                } else if (name === "FH") {
                    let array1 = [parseInt(gid(0).classList.value.charAt(5))];
                    let array2 = [];
                    for (let i = 1; i < 5; i++) {
                        let num = parseInt(gid(i).classList.value.charAt(5));
                        if (num == array1[0]) {
                            array1.push(num);
                        } else if (array2.length == 0 && num != array1[0]) {
                            array2.push(num);
                        } else if (num == array2[0]) {
                            array2.push(num);
                        }
                    }
                    if (array2.length + array1.length == 5) {
                        cellScore(name, 25);
                    } else {
                        cellScore(name, 0);
                    }
                } else if (name ==="yahtzee") {
                    let array = [];
                    for (let i = 0; i < 5; i++) {
                        let num = parseInt(gid(i).classList.value.charAt(5));
                        array.push(num);
                    }
                    if (array[0] == array[1] && array[0] == array[2] && array[0] == array[3] && array[0] == array[4]) {
                        cellScore(name, 50);
                    } else {
                        cellScore(name, 0);
                    }
                }
            }
        }
        return saveCombo;
    }

    function cellScore(name, value) {
        gid(name + "Score").innerHTML = value;
        disable(name, value);

    }

    function disable(name, value) {
        let elm = gid(name);
        elm.classList.add("used");
        elm.classList.remove("cell");
        elm.onclick = undefined;
        TotalScore.innerHTML = Number(TotalScore.innerHTML) + value;
        sendTurnResults(name, value, TotalScore.innerText);
    }

    function sendTurnResults(name, value, totalScore) {
        rolls = 0;
        currentRolls.textContent = "";
        currentRolls.innerHTML = "Roll " + (rolls) + "/3";

        let body = {
            gameId: gameId,
            [name] : value,
            total: parseInt(totalScore)
        };


        fetch('http://turing.cs.ttu.ee:6139/turn/' + id + "/" + name + "/" + value, {
            method: 'put',
            body: JSON.stringify(body),
            headers: {
                'Content-Type': 'application/json'
            },
            mode: 'cors'
        })
            .then(res =>  res.json()).then(json =>  {
            gid("waitModal").style.display = "block";
            enemyTurn(total, player, id, gameId, curTurn);
        });


    }

}

function enemyTurn(totalTurns, name, id, gameId, curTurn) {

    fetch('http://turing.cs.ttu.ee:6139/states/' + id, {
        method: 'get',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(res =>  res.json()).then(json => {if (json.state == 0) {

        setTimeout(function () { return enemyTurn(totalTurns, name, id, gameId, curTurn)},2000);
    } else if (json.state == 2) {
            deletePlayers(id, gameId);
    } else {
        getResultsForTurn(totalTurns, name, id, gameId, curTurn);
    }
    });

}



function getResultsForTurn(totalTurns, name, id, gameId, curTurn) {
    gid("waitModal").style.display = "none";

        let one = gid("enemyonesScore").innerText;
        let two = gid("enemytwosScore").innerText;
        let three = gid("enemythreesScore").innerText;
        let four = gid("enemyfoursScore").innerText;
        let five = gid("enemyfivesScore").innerText;
        let six = gid("enemysixesScore").innerText;
        let jokker = gid("enemyjokkerScore").innerText;
        let TK = gid("enemyTKScore").innerText;
        let FK = gid("enemyFKScore").innerText;
        let SS =  gid("enemySSScore").innerText;
        let LS =  gid("enemyLSScore").innerText;
        let FH = gid("enemyFHScore").innerText;
        let jahtzee = gid("enemyyahtzeeScore").innerText;
        const TotalScore = gid("enemyTotalScore");


        fetch('http://turing.cs.ttu.ee:6139/turnResults/' + id + "/" + gameId, {
            method: 'get',

            headers: {
                'Content-Type': 'application/json'
            },
            mode: 'cors'
        })
            .then(res => res.json()).then(json => {
            if (json.ones != null && json.ones !== 0 && one == 0) {
                gid("enemyonesScore").innerHTML = json.ones;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.ones;
            } else if (json.twos != null && json.twos !== 0 && two == 0) {
                gid("enemytwosScore").innerHTML = json.twos;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.twos;
            } else if (json.threes != null && json.threes !== 0 && three == 0) {
                gid("enemythreesScore").innerHTML = json.threes;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.threes;
            } else if (json.fours != null && json.fours !== 0 && four == 0) {
                gid("enemyfoursScore").innerHTML = json.fours;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.fours;
            } else if (json.fives != null && json.fives !== 0 && five == 0) {
                gid("enemyfivesScore").innerHTML = json.fives;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.fives;
            } else if (json.sixes != null && json.sixes !== 0 && six == 0) {
                gid("enemysixesScore").innerText = json.sixes;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.sixes;
            } else if (json.jokker != null && json.jokker !== 0 && jokker == 0) {
                gid("enemyjokkerScore").innerHTML = json.jokker;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.jokker;
            } else if (json.TK != null && json.TK !== 0 && TK == 0) {
                gid("enemyTKScore").innerHTML = json.TK;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.TK;
            } else if (json.FK != null && json.FK !== 0 && FK == 0) {
                gid("enemyFKScore").innerHTML = json.FK;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.FK;
            } else if (json.SS != null && json.SS !== 0 && SS == 0) {
                gid("enemySSScore").innerHTML = json.SS;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.SS;
            } else if (json.LS != null && json.LS !== 0 && LS == 0) {
                gid("enemyLSScore").innerHTML = json.LS;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.LS;
            } else if (json.FH != null && json.FH !== 0 && FH == 0) {
                gid("enemyFHScore").innerHTML = json.FH;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.FH;
            } else if (json.yahtzee != null && json.yahtzee !== 0 && yahtzee == 0) {
                gid("enemyyahtzeeScore").innerHTML = json.yahtzee;
                TotalScore.innerHTML = Number(TotalScore.innerHTML) + json.yahtzee;
            }

            if ((totalTurns - 1) <= curTurn) {
               return endGame(totalTurns, name, id, gameId)
            } else {
                curTurn += 1;
                return yourTurn(totalTurns, name, id, gameId, curTurn);
            }
        });

}

function deletePlayers(id, gameId) {
    fetch('http://turing.cs.ttu.ee:6139/delete/' + gameId, {
        method: 'DELETE',
        mode: 'cors'
    })
        .then(res => {getWinner(id, gameId)})
}

function endGame(totalTurns, name, id, gameId) {

    let total;
    let winner;
    if (parseInt(gid("TotalScore").innerHTML) >= parseInt(gid("enemyTotalScore").innerHTML)){
        total = (parseInt(gid("TotalScore").innerHTML));
        winner = name;
    } else {
        total = (parseInt(gid("enemyTotalScore").innerHTML));
        winner = null;
    }
    let body = {
        name: winner,
        id: id,
        gameId : gameId,
        total: total
    };

    fetch('http://turing.cs.ttu.ee:6139/endGame', {
        method: 'post',
        body: JSON.stringify(body),
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(res =>  res.json()).then(json =>  {showWinner(json.playerName, json.playerScore)});
}

function showWinner(name, score) {
    gid("waitModal").style.display = "none";
    let modal = gid("endModal");
    modal.style.display = "block";
    gid("finalScore").innerHTML = "Winner of this game is " + name + " with " + score + " points. Click anywhere to play again!";
    modal.onclick =  function() {return location.reload()};
}


function getWinner(id, gameId) {

    fetch('http://turing.cs.ttu.ee:6139/winner/' + gameId, {
        method: 'get',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(res =>  res.json()).then(json => { showWinner(json.playerName, json.playerScore) });
}