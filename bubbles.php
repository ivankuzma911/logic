<?php


class bubbles extends config{
    public $numbers ='';
    public function sort(){

        if(isset($_POST['submit'])) {
            if($_POST['order_by']=='asc'){
            $bubbles = explode(' ', $_POST['numbers']);
            $count = count($bubbles);
            for ($n = 0; $n < $count; $n++) {
                for ($i = 0; $i < $count - $n - 1; $i++) {
                    $current = $bubbles[$i];
                    $next = $bubbles[$i + 1];
                    if ($current > $next) {
                        $bubbles[$i] = $next;
                        $bubbles[$i + 1] = $current;
                    }
                }
            }
            $this->numbers = implode(' ',$bubbles);
        }else{
                $bubbles = explode(' ', $_POST['numbers']);
                $count = count($bubbles);
                for ($n = 0; $n < $count; $n++) {
                    for ($i = 0; $i < $count - $n - 1; $i++) {
                        $current = $bubbles[$i];
                        $next = $bubbles[$i + 1];
                        if ($current < $next) {
                            $bubbles[$i] = $next;
                            $bubbles[$i + 1] = $current;
                        }
                    }
                }
                $this->numbers = implode(' ',$bubbles);
            }
        }
        $this->getView();
    }
    public function getView(){
       ?> <form action='' method='POST'>
                <input type='text' name='numbers' size='100' value='<?=$this->numbers?>' placeholder='9 3 8 1 4'>
            <select name="order_by">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select><br>
                <input type='submit' name='submit' value='Sort it'></form>
        <?php
    }
}