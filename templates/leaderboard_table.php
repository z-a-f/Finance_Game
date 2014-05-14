<table class="table table-striped">

    <thead>
        <tr>
            <th>User</th>
            <th>Total Score (CASH + STOCKS)</th>
        </tr>
    </thead>

    <tbody>

<?php foreach ($keys as $key): ?>
        <tr>
            <td><?= $key ?></td>
            <td>$<?= number_format($totals[$key], 2) ?></td>
        </tr>
<?php endforeach ?>
    </tbody>

</table>
<div>
    or <a href="javascript:history.go(-1);">go back</a>
</div>
