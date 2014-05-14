<?php


    // configuration
    require("../includes/config.php"); 

    // Get the cash:
    $cash = query("SELECT cash FROM  `users` WHERE id = ?", $_SESSION["id"]);
    
    // Get the rest of the data:
    $positions = array();
    $rows = query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = array(
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
				"target" => $stock["target"],
				"change" => $stock["change"]
            );
        }
    }
    // dump($positions);
    // dump($cash[0]["cash"]);
    // render portfolio
    render("portfolio.php", 
        array("title" => "Portfolio",
         "positions" => $positions,
         "cash" => $cash[0]["cash"]));

?>
