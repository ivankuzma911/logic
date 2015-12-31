<?php
 class random_helper{
    public static function getVarchar($data_type){
        $fullname_max = rand(1, $data_type['params']);
        $name = '';
        for ($j = 0; $j < $fullname_max; $j++) {
            $name .= chr(rand(48, 122));
        }
        return $name;
    }

     public static function getInt($data_type){
         $min = 1;
         $max = pow($min*10,$data_type['params']);

         return rand($min, $max);
     }



     public static function getEnum($data_type){
         $ammount = explode(',', $data_type['params']);
         $count = count($ammount);

         return(rand(1, $count));
     }

     public static function getDecimal($data_type){
         $params = explode(',',$data_type['params']);
         $coma = pow(10,$params[1]);
         $number = $params[0] - $params[1];
         $prefix = '9';
         for($i=1;$i<$number;$i++){
             $prefix .= '9';
         }

         return  (rand(1 * $coma, $prefix * $coma)) / $coma;
     }

     public static function getDate(){
         return date("Y-m-d", (rand(1, time())));
     }


}