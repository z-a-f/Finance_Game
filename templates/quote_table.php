
<table class="table table-striped">

    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <th><?= $quote["symbol"] ?></th>
            <th><?= $quote["name"] ?></th>
            <th>$<?= number_format ( $quote["price"], 2 ) ?></th>
        </tr>
    </tbody>
</table>
<div>
	<img src=<?= $quote["chart"] ?> alt=<?= "Chart for " . $quote["symbol"] ?> />
</div>
<hr>
<div>
    or <a href="javascript:history.go(-1);">go back</a>
</div>
