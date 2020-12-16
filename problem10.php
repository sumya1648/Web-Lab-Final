<?php
$array = ['white','green','red'];

echo 'A. '. implode(', ',$array).'<br>';

echo 'B.<ul>';
foreach ($array as $a){
    echo '<li>'.$a.'</li>';
}
echo '</ul>';

?>