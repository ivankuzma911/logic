<?php
include('config.php');

class scissors extends config
{
    public $view = '';

    public function __construct(){
        $this->slice();
    }

    public function slice()
    {
        if (isset($_POST['scissors'])) {
            $limit = $_POST['limit'];
            $text = explode(' ', $_POST['text']);
            $array_full_words = array();
            $counter = 0;
            foreach ($text as $key => $value) {
                $array_full_words[] = $value;
                if (mb_strlen($value, 'UTF-8') >= 3) {
                    ++$counter;
                }
                if ($counter == $limit) {
                    break;
                }
            }
            $this->view = implode(' ',$array_full_words) . " ...";
        }
        include('scissors_view.php');
    }

}

$task1 = new scissors();

