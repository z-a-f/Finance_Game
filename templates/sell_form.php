
<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select autofocus class="form-control" name="symbol">
                <option value=""> </option>
<?php
    foreach($names as $name) {
        print("<option value=\"" . $name["symbol"] ."\">". $name["symbol"] . "</option>");
    }
?>
            </select>
        </div>
        <div class="form-group">
            <input class="form-control" name="shares" placeholder="Shares" type="number" min="1"/>
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell</button>
        </div>
    </fieldset>
</form>

<div>
    or <a href="javascript:history.go(-1);">go back</a>
</div>
