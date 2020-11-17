<?php
session_start();

session_destroy();

header("Location: ../prax3/index.php");
