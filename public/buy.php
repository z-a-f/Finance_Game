<?php
    // configuration
    require("../includes/config.php");
    
    // Get the current cash information:
    $cash = query("SELECT cash FROM `users` WHERE id = ?", $_SESSION["id"]);
    if ($cash === false) {
        apologize ("Cannot retrieve cash information");
    }
    
    // Check if form was submitted:
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate submission
        if (empty($_POST["symbol"])){
            apologize("Quote cannot be empty");
        }
        if (empty($_POST["shares"])) {
            apologize("Shares value cannot be empty");
        }

        // Get the quote:
        $quote = lookup($_POST["symbol"]);
        
        // Check if not found:
        if (empty($quote)) {
            apologize("Quote Symbol \"" . $_POST["symbol"] . "\" not found");
        }
        
        // Check if enough money to buy the shares:
        if ($cash[0]["cash"] < $quote["price"]*$_POST["shares"]) {
            apologize (
                "Not enough cash to buy " 
                . number_format($_POST["shares"], 0) . "@$" . number_format($quote["price"], 2) 
                . " (CASH: $" . number_format($cash[0]["cash"], 2)
                . " NEED: $"  . number_format($quote["price"]*$_POST["shares"], 2) .")"
            );
        } else {
            // Buy the shares:
            if ( (query("INSERT INTO `portfolio` (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"]) === false) ||
                 (query("UPDATE `users` SET cash = cash - ? where id = ?", $quote["price"]*$_POST["shares"], $_SESSION["id"]) === false) ) {
                apologize("Something went wrong. CANNOT BUY SHARES OR CANNOT UPDATE CASH!!!");
            }
            // Create a history item:
            query("INSERT INTO `history` (id, transaction, datetime, symbol, shares, price) " .
                "VALUES(?, 'BUY', NOW(), ?, ?, ?)", 
                $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $quote["price"]);
            redirect(HOME);
        }
            
        
        
    } else { // Request the form
        // dump($names);
        render("buy_form.php", array("title" => "Buy"));
    }


?>
