<?php

class random extends config{
    public $mysqli;
    public function fill_database(){
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
        if(isset($_POST['random_submit'])) {
            $ammount = $_POST['ammount'];
            $increment = $this->getIncrement();
            for ($i = 0; $i < $ammount; $i++) {
                $age = $this->getAge();
                $name = $this->getName();
                $skill = $this->getSkill();
                $price = $this->getPrice();
                $date = $this->getDate();

                if (!$increment) {
                    $result = $this->mysqli->query("Select * from $this->table");
                    if ($result->num_rows == 0) {
                        $result = $this->mysqli->query("INSERT INTO $this->table(id,age,fullname,skills,price,date_creation)VALUES (1,'$age','$name','$skill','$price','$date')");
                    } else {
                        $max_id = $this->mysqli->query("select max(id) from $this->table");
                        $max_id = $max_id->fetch_assoc();
                        $max_id = $max_id['max(id)'] + 1;
                        $result = $this->mysqli->query("INSERT INTO $this->table(id,age,fullname,skills,price,date_creation)VALUES ($max_id,$age,'$name',$skill,'$price','$date')");
                    }
                } else {
                    $result = $this->mysqli->query("INSERT INTO $this->table(age,fullname,skills,price,date_creation)VALUES ($age,'$name',$skill,'$price','$date')");
                }
            }
        }
       $this->getView();
    }

    public function getIncrement(){
        $result = $this->mysqli->query("SHOW COLUMNS FROM $this->table");
        while ($row = $result->fetch_assoc()) {
            if ($row['Field'] == 'id') {
                if ($row['Extra'] == 'auto_increment') {
                    return true;
                    break;
                }else{
                    return false;
                }
            }
        }
    }

    public function getAge(){
        return rand(1, 99);
    }

    public function getName(){
        $fullname_max = rand(1, 30);
        $name = '';
        for ($j = 0; $j < $fullname_max; $j++) {
            $name .= chr(rand(48, 122));
        }
        return $name;
    }

    public function getSkill(){
        return(rand(1, 6));
    }

    public function getPrice(){
        return  (rand(1 * 100, 999 * 100)) / 100;
    }

    public function getDate(){
        return date("Y-m-d", (rand(1, time())));
    }

    public function getView(){
        $mysql = $this->mysqli->query("SELECT * from $this->table");

        ?><form action='' method='POST'>
              Ammount: <input type='text' name='ammount'>
              <input type='submit' name='random_submit' value='Fill'>
              </form><table>
    <?php

        while($row = $mysql->fetch_array()){
            echo "<tr><td>$row[id]</td>
            <td>$row[age]</td>
            <td>$row[fullname]</td>
            <td>$row[skills]</td>
            <td>$row[price]</td>
            <td>$row[date_creation]</td></tr>";
        }
            echo "</table>";
    }
}

