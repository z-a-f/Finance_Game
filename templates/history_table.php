<table class="table table-striped">

    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>

    <tbody>
<?php foreach ($history as $row): ?>
        <tr>
            <td><?= $row["transaction"] ?></td>
            <td><?= $row["datetime"] ?></td>
            <td><?= $row["symbol"] ?></td>
            <td><?= $row["shares"] ?></td>
            <td>$<?= number_format($row["price"], 2) ?></td>
        </tr>
<?php endforeach ?>
    </tbody>

</table>
<div>
    or <a href="javascript:history.go(-1);">go back</a>
</div>
