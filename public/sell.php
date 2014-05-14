<?php
    // configuration
    require("../includes/config.php");
    
    // Get the shares information:
    $names = query("SELECT symbol FROM  `portfolio` WHERE id = ?", $_SESSION["id"]);
    //dump($names);
    
    // Check if form was submitted:
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["symbol"])) {
            apologize("You must select a stock to sell");
        }
        if (empty($_POST["shares"]) || $_POST["shares"] <= 0){
            apologize("Shares set incorrectly");
        }
        
        // Get how many shares owned of the selected type:
	$getShares = query("SELECT shares FROM `portfolio` WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        $owned = $getShares[0]["shares"];
        // $owned = query("SELECT shares FROM `portfolio` WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"])[0]["shares"]; // This might not work in the older PHP version
        
        // DEBUG:
        // dump($owned);
        
        if ($_POST["shares"] > $owned) { // Check if trying to sell more shares than owing:
            apologize("Cannot sell " . $_POST["shares"] . " shares of " . $_POST["symbol"] . ". Currently have only " . $owned);
        } else {
            // SELL THE SHARES:
            // Get the current cash value:
            $userData = query("SELECT * FROM `users` WHERE id = ?", $_SESSION["id"]);
            // Get the current price per share:
	    $currentSymbol = lookup($_POST["symbol"]);
	    $price = $currentSymbol["price"];
            // $price = lookup($_POST["symbol"])["price"];
            // compute cash to be added:
            $cash = $price * $_POST["shares"];
            
            if ( (query("UPDATE `users` SET cash = cash + ? WHERE id = ?", $cash, $_SESSION["id"]) === false) || 
                 (query("UPDATE `portfolio` SET shares = shares - ? WHERE id = ? AND symbol = ?", $_POST["shares"], $_SESSION["id"], $_POST["symbol"]) === false) ){
                apologize("Something went wrong! Please report (CANNOT ADD CASH or CANNOT SUBTRACT SHARES)!!!");
            } elseif ($_POST["shares"] == $owned) {
                // Check if sold all the owned stocks:
                if (query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]) === false) { 
                    apologize("Something went wrong! Please report (CANNOT DELETE ROW FROM PORTFOLIO WHEN EVERYTHIG IS SOLD)!!!");
                }
                
            }
            // Create a history item:
            query("INSERT INTO `history` (id, transaction, datetime, symbol, shares, price) " .
                "VALUES(?, 'SELL', NOW(), ?, ?, ?)", 
                $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $price);
                
            redirect(HOME);
            
        }        
    
    } else { // Request the form
        // dump($names);
        render("sell_form.php", array("title" => "Sell", "names" => $names));
    }


?>
