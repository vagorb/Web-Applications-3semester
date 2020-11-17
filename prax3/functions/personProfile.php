<?php
include_once("includes/db.php");

    $st = db()->prepare("SELECT * FROM users WHERE id = ?");
    $st->bind_param("i", $person_id);
    $st->execute();
    $res = $st->get_result();
    $row = $res->fetch_assoc();
    $st->close();

    $person_first_name = $row['name'];
    $person_last_name = $row['surname'];
    $person_describe_user = $row['description'];
    $person_user_country = $row['town'];

    $person_register_date = $row['created_at'];

    echo"
                <h2><strong>Profile</strong></h2>
                <h4><strong>$person_first_name $person_last_name</strong></h4>
                <h3><strong>About me</strong></h3><br>
                ";
    $text = substr($person_describe_user, 0, 80);
    $text1 = substr($person_describe_user, 80, 160);
    $text2= substr($person_describe_user, 160, 250);
    echo" 
                <strong>$text</strong><br>
                <strong>$text1</strong><br>
                <strong>$text2</strong><br>
                <p><strong>Lives In: </strong> $person_user_country</p><br>
                <p><strong>Member Since: </strong> $person_register_date</p><br>
            ";