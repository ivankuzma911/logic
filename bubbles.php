<?php
include('config.php');

class bubbles extends config{
    public $numbers ='';
    public $bubbles;

    public function __construct(){
        $this->sort();
    }

    public function sort()
    {
        if (isset($_POST['submit'])) {
                $bubbles = explode(' ', $_POST['numbers']);
                $count = count($bubbles);
                for ($n = 0; $n < $count; $n++) {
                    for ($i = 0; $i < $count - $n - 1; $i++) {
                        $current = $bubbles[$i];
                        $next = $bubbles[$i + 1];
                        if($_POST['order_by']=='asc') {
                            if ($current > $next) {
                                $bubbles[$i] = $next;
                                $bubbles[$i + 1] = $current;
                            }
                        }else{
                            if ($current < $next) {
                                $bubbles[$i] = $next;
                                $bubbles[$i + 1] = $current;
                            }
                        }
                    }
                }
                $this->numbers = implode(' ', $bubbles);

        }
        include('bubbles_view.php');
    }
}
$task2 = new bubbles();