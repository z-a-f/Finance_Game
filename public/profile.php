<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["password"]) || empty($_POST["passwordNew"]) || empty($_POST["confirmation"])){
            apologize("Fields cannot be empty");
        }elseif ($_POST["passwordNew"] !== $_POST["confirmation"]) {
            apologize("The new passwords do not match");
        }
        
        // query database for user
        $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

        // if we found user, check password
        if (count($rows) == 1){
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"]){
                // Change the password:
                query("UPDATE `users` SET hash = ? WHERE id = ?", crypt($_POST["passwordNew"]), $_SESSION["id"]);
            } else {
                apologize("The old password is incorrect");
            }
        }
        redirect (HOME);
    }
    else
    {
        // else render form
        render("profile_form.php", array("title" => "Profile"));
    }

?>
