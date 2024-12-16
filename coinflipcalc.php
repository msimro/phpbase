<?php

function flip() {
	return ( 0 == rand(0,1) ) ? 'H' : 'T';
}

/** SOLUTION 1 **/
$H = 0;
$T = 0;

for( $i = 0; $i < 1000; $i++ ) {
	$flip = flip(); 
	${$flip}++; // Defing dynamic variable name using variable (e.g. H or T in this case). ++ adds the counting.
}

echo 'Heads was flipped ' . $H/10 . '% of the time. Tails, ' . $T/10 . '%.'; 
// Since its out of 1000, we can devide by 10 to get percentage

?>

<hr/>

<?php

//Alternative way.
//This cheats a little because we modified the flip function.
function flipx() {
	return rand(0,1);
}

$flipx = 0;

for( $i = 0; $i < 1000; $i++ ) {
	$flipx += flipx(); 
}
// In case of 0, adding means nothing. so only 1s will be added which are heads :) SMART!
echo 'Heads was flipped ' . ($flipx/1000)*100 . '% of the time.';


?>