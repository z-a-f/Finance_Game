<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]) || empty($_POST["password"])){
            apologize("Username/Password cannot be empty");
        }elseif ($_POST["password"] !== $_POST["confirmation"]) {
            apologize("The passwords do not match");
        }else {
            if (query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", 
                    $_POST["username"], 
                    crypt($_POST["password"])) !== false) { // Add the user
                // If succeed:                    
                    
                // Get the user that was just created:
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                
                // Create a login session:
                $_SESSION["id"] = $id;
                
                // Redirect:
                redirect(HOME);
               
            } else {
                apologize("Error! Maybe user \"" . $_POST["username"] ."\" already exist" );
            }
        }
    }
    else
    {
        // else render form
        render("register_form.php", array("title" => "Register"));
    }

?>
