<?php

function print_array($a) {
	echo '<pre>';
	var_dump( $a );
	echo '</pre>';
}

$dir = 'files';
$files = scandir($dir);
$extensions = array();

foreach( $files as $file ) {
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	if( ! empty( $ext ) ) {
		$extensions[$ext] = ($extensions[$ext] ?? 0) + 1; 
	}
}

print_array( $extensions );


function compare_files($a, $b) {
	$a = pathinfo( $a );
	$b = pathinfo( $b );

	if ( strcmp($a['extension'], $b['extension']) == 0 ) {
		return strcmp( $a['filename'], $b['filename'] );
	}

	return strcmp($a['extension'], $b['extension']);
}

$dir = 'files';
$files = scandir($dir);

usort( $files, 'compare_files' );
print_array( $files );
