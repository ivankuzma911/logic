<?php


class scissors extends config
{
    public $view = '';
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
        $this->getView();


    }
    public function getView(){
        ?> <form action='' method='post'>
                    <input type='text' name='text' size='99' placeholder='Put some text'> Limit:<input type='text' name='limit' size='10'><br>
                    <textarea cols='100' rows='5'><?=$this->view?></textarea><br>
                    <input type='submit' name='scissors' value='Scissors'>
                  </form><hr>
        <?php
    }
}