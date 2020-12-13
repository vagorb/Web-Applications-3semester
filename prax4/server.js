const express = require('express')
const bodyParser = require('body-parser');
const app = express();
const path = require('path');

var cors = require('cors')


app.use(cors())

app.use(bodyParser.json());

app.use(bodyParser.urlencoded({ extended: true }));


app.use(express.static(path.join(__dirname, 'public')));




require("./public/routes/player.routes.js")(app);

const PORT = process.env.PORT || 3000;

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}.`);
});