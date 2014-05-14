<div>
    <ul class="nav nav-pills">
        <li><a href="quote.php">Quote</a></li>
        <li><a href="buy.php">Buy</a></li>
        <li><a href="sell.php">Sell</a></li>
        <li><a href="history.php">History</a></li>
		<li><a href="leaderboard.php">Leaderboard</a></li>
        <li><a href="logout.php"><strong>Log Out</strong></a></li>
    </ul>
    <!-- <img alt="Under Construction" src="/img/construction.gif"/> -->
</div>

<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Symbol</th>
                <th>Name</th>
                <th>Shares</th>
                <th>Current Price</th>
				<th>Change from 200day Mean</th>
				<th>1yr Target</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
<?php
	$string = ""; // Saves the value for chart request later
	$total = 0; // Saves the value for calculating the absolute (running) total
    foreach ($positions as $position) {
		$string = $string . $position["symbol"] . ","; 
        print("<tr>");
        print("<td>" . $position["symbol"] . "</td>");
        print("<td>" . $position["name"] . "</td>");
        print("<td>" . $position["shares"] . "</td>");
		// print("<td>" . "TEST" . "</td>");
        print("<td>$" . number_format($position["price"], 2) . "</td>");
		print("<td>" . $position["change"] . "</td>");
		print("<td>$" . number_format($position["target"],2) . "</td>");
        print("<td>$" . number_format($position["shares"]*$position["price"], 2) . "</td>");
        print("</tr>");
		$total = $total + $position["shares"]*$position["price"];
    }
    print("<tr>");
    print("<td><strong>CASH</strong>");
    print("</td> <td></td> <td></td> <td></td> <td></td> <td></td>");
    print("<td><strong>$" . number_format($cash, 2) . "</strong></td>");
    print("</tr>");
	print("<tr>");
    print("<td><strong><i>TOTAL</i></strong>");
    print("</td> <td></td> <td></td> <td></td><td></td><td></td>");
    print("<td><strong><i>$" . number_format($cash+$total, 2) . "</i></strong></td>");
    print("</tr>");
?>
        </tbody>
    </table>
	<div>
<?php
	print ("<img src=\"http://chart.finance.yahoo.com/z?s=QQQX&t=5d&q=l&l=on&z=l&c=$string\" alt=\"Chart not available...\"/>");
?>
	</div>
</div>

