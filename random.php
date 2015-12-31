<?php
include('config.php');
include('random_helper.php');

class random extends config
{
    public $mysqli;
    public $numberOfOperations = false;

    public function __construct()
    {
        $this->fill_database();
    }

    public function fill_database()
    {
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
        if (isset($_POST['random_submit'])) {
            $ammount = $_POST['ammount'];
            $db_columns = $this->mysqli->query("SHOW COLUMNS from $this->table");
            while ($row = $db_columns->fetch_assoc()) {
                $fields[] = $row['Field'];
                $rows[] = $row;
            }

            for ($i = 0; $i < $ammount; $i++) {
                foreach ($fields as $key => $field) {
                    $to_db[$field] = $this->columnsFiller($rows[$key]);
                }
                if($to_db['id'] === true) {
                    unset($to_db['id']);
                }
                $query = $this->queryBuilder($to_db);
                $this->mysqli->query($query);
            }
        }
        $this->numberOfOperations = $i;
        include('random_view.php');
    }

    public function queryBuilder($to_db)
    {
        $sql = "Insert into $this->table";
        $sql .= "(" . implode(", ", array_keys($to_db)) . ")";
        $sql .= " VALUES ('" . implode("', '", $to_db) . "')";
        return $sql;
    }

    public function columnsFiller($row)
    {
        $to_db = array();
        if ($row['Field'] == 'id') {
            $to_db = $this->getId($row);
        } else {
            $data_type = $this->typeScissor($row['Type']);
            switch ($data_type['clear_type']) {
                case 'varchar':
                    $to_db = random_helper::getVarchar($data_type);
                    break;
                case 'int':
                    $to_db = random_helper::getInt($data_type);
                    break;
                case 'enum':
                    $to_db = random_helper::getEnum($data_type);
                    break;
                case 'decimal':
                    $to_db = random_helper::getDecimal($data_type);
                    break;
                default:
                    $to_db = random_helper::getDate();
                    break;
            }
        }
        return $to_db;
    }

    public function getId($row)
    {
        if ($row['Extra'] == 'auto_increment') {
            return true;
        } else {
            $result = $this->mysqli->query("Select * from $this->table");
            if ($result->num_rows === 0) {
                $id = 1;
            } else {
                $max_id = $this->mysqli->query("select max(id) from $this->table");
                $max_id = $max_id->fetch_assoc();
                $id = $max_id['max(id)'] + 1;
            }
            return $id;
        }

    }

    public function typeScissor($type)
    {
        $data = array('params' => '',
            'clear_type' => null);
        $start = strpos($type, '(');
        $end = strpos($type, ')');
        if ($start && $end) {
            $length = $end - $start;
            $data['params'] = substr($type, $start + 1, $length - 1);
            $data['clear_type'] = substr($type, 0, $start);
        }
        return $data;


    }


}

$task3 = new random();

