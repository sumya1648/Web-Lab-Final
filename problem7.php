<?php
// TODO: Generate radom uniq number between range
$array = [];
$i=true;
while($i){
    $rand = mt_rand(11, 20);
    if(!in_array($rand,$array)){
        $array[] = $rand;
    }
    if(count($array)==10){
        $i=false;
    }
}
echo implode(' ',$array);
?>