<?php
$lines = file('paises.txt');
$data = array();
foreach($lines as $line) {
    $data[] = explode(';',trim($line));
}
var_dump($data);

?>
<br>
<?php
$data = array(0 => array(0 => "Edad", 1 => 21));
var_dump($data);

?>
