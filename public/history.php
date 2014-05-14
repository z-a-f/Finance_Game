<?php

    // Configure:
    require("../includes/config.php");
    
    // Get the history of the user:
	$history = query("SELECT * FROM `history` WHERE id = ? ORDER BY `history`.`datetime` ASC", $_SESSION["id"]);
    // $history = query("SELECT * FROM `history` WHERE id = ?", $_SESSION["id"]);
    if(empty($history) || $history === false) {
        apologize("The user does not have a BUY/SELL history, or cannot open database");
    }
    // dump($history);
    // Show the history of the user:
    render("history_table.php", array("title" => "History", "history" => $history));
?>
