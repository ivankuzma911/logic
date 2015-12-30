<?php
include('config.php');
class random extends config{
    public $mysqli;
    public $numberOfOperations =false;

    public function __construct(){
        $this->fill_database();
    }
    public function fill_database(){
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
        if(isset($_POST['random_submit'])) {
            $ammount = $_POST['ammount'];
            $increment = $this->getIncrement();
            $fullTable = $this->getFullTable();
            $maxId = $this->getMaxId()+1;
            for ($i = 0; $i < $ammount; $i++) {
                $age = $this->getAge();
                $name = $this->getName();
                $skill = $this->getSkill();
                $price = $this->getPrice();
                $date = $this->getDate();

                if (!$increment) {
                    if (!$fullTable) {
                        $result = $this->mysqli->query("INSERT INTO $this->table(id,age,fullname,skills,price,date_creation)VALUES (1,'$age','$name','$skill','$price','$date')");
                    } else {
                        $idToDb = $maxId+$i;
                        $result = $this->mysqli->query("INSERT INTO $this->table(id,age,fullname,skills,price,date_creation)VALUES ($idToDb,$age,'$name',$skill,'$price','$date')");
                    }
                } else {
                    $result = $this->mysqli->query("INSERT INTO $this->table(age,fullname,skills,price,date_creation)VALUES ($age,'$name',$skill,'$price','$date')");
                }
            }
            $this->numberOfOperations = $i;
        }
       include('random_view.php');
    }

    public function getMaxId(){
        $max_id = $this->mysqli->query("select max(id) from $this->table");
        $max_id = $max_id->fetch_assoc();
        $max_id = $max_id['max(id)'];
        return $max_id;
    }

    public function getIncrement(){
        $result = $this->mysqli->query("SHOW COLUMNS FROM $this->table");
        while ($row = $result->fetch_assoc()) {
            if ($row['Field'] == 'id') {
                if ($row['Extra'] == 'auto_increment') {
                    return true;
                }else{
                    return false;
                }
            }
        }
    }

    public function getFullTable(){
        $result = $this->mysqli->query("Select * from $this->table");
        if($result->num_rows === 0){
            return false;
        }
        return true;
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
}

$task3 = new random();

