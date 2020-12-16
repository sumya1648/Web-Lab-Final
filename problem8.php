<?php
$color = [
    'color'     => ['a'=>'Red','b'=>'Green','c'=>'White'],
    'numbers'   => [1,2,3,4,5,6],
    'holes'     => ['First',5=>'Second','Third']
];

foreach ($color as $c1){
    foreach ($c1 as $c){
        if($c == 'Red' || $c == 'Second'){
            echo $c.' ';
        }   
    }
}


?>