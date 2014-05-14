<?php


    // configuration
    require("../includes/config.php"); 
	
	// Get the information about all users (This might not be very efficient :( )
	$totals = array();
	// Get all the users:
	$users = query("SELECT id, username, cash FROM `users`");
	// Get portfolio information:
	foreach ($users as $user) {
		$totals[$user["username"]] = $user["cash"];
		// Find the user's portfolio:
		$portfolio = query("SELECT symbol, shares FROM `portfolio` WHERE id = ?", $user["id"]);
		if (empty($portfolio)) {
			continue;
		} else {
			// lookup the current price and calculate the total
			foreach ($portfolio as $row) {
				$stock = lookup($row["symbol"]);
				if ($stock !== false) {
					$totals[$user["username"]] += $stock["price"]*$row["shares"];
				}
			}
		}

	}
	arsort($totals);
	$keys = array_keys($totals);
	// dump($test);
	render("leaderboard_table.php",
		array("title" => "Leaderboard",
			"totals" => $totals,
			"keys" => $keys)
	);
	
?>
