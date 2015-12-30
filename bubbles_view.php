<html>
<head></head>
<body>
<form action='' method='POST'>
    <input type='text' name='numbers' size='100' value='<?=$this->numbers?>' placeholder='9 3 8 1 4'>
    <select name="order_by">
        <option value="asc">ASC</option>
        <option value="desc">DESC</option>
    </select><br>
    <input type='submit' name='submit' value='Sort it'></form>
</body>
</html>