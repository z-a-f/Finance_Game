<?php

    // Configure:
    require("../includes/config.php");
    
    // Check if form was submitted:
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate submission
        if (empty($_POST["symbol"])){
            apologize("Quote cannot be empty");
        }
        
        // Show the quote:
        $quote = lookup($_POST["symbol"]);
        
        // Check if not found:
        if (empty($quote)) {
            apologize("Quote Symbol \"" . $_POST["symbol"] . "\" not found");
        } else {
            render("quote_table.php", array("title" => "Quote", "quote" => $quote));
        }
    
    } else {
        // else render form
        render("quote_form.php", array("title" => "Quote"));
    }


?>
