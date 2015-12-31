
<html>
<head></head>
<body>
<form action='' method='POST'>
    Ammount: <input type='text' name='ammount'>
    <input type='submit' name='random_submit' value='Fill'>
</form>
<?php echo  ($this->numberOfOperations) ?  "Affected rows:$this->numberOfOperations" : null?>
</body>
</html>