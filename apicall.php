<?php
  function print_array( $output ) {
    echo '<pre>';
    print_r( $output );
    echo '</pre>';
  }

  function print_img( $img ) {
	  $format = '<figure>
	  	<img src="%1$s" alt="%2$s">
		<figcaption>%3$s</figcaption>
		</figure>';

		printf( $format, 
			$img->url_full_size, 
			$img->description,
			$img->title
  		);
  }
?>
<!DOCTYPE html>
<html>
		<head>
        <title>Retrieving information from an API</title>
        <meta name="author" value="Joe Casabona" />
    </head>
    <body>
		<main>
  			<h1>Random Genreia</h1>
				<?php
					// $url = 'http://pixelford.com/api2/image?qty=3';
					// $images = array_slice(json_decode( file_get_contents( $url ) ), 0, 15);
					// foreach( $images as $img ) {
					// 	print_img( $img );
					// }
						// From URL to get webpage contents.
						$url = "http://v2.jokeapi.dev/joke/Programming,Miscellaneous,Dark/";
						// Initialize a CURL session.
						$ch = curl_init();
						// Return Page contents.
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						//grab URL and pass it to the variable.
						curl_setopt($ch, CURLOPT_URL, $url);
						$result = curl_exec($ch);
						var_dump($result);
				?>
		</main>
		<style>
			body {
				background: #edf2f8;
				font-family: 'Inter', sans-serf;
				font-size: 18px;
			}

			main {
				background: #FFFFFF;
				padding: 40px;
				margin: 0 auto;
				width: 800px;
			}

			figure {
				background: #333333;
				padding: 10px;
				margin: 15px auto;
				max-width: 95%;
			}

			figure img {
				max-width: 100%;
				height: auto;
			}

			figcaption {
				color: #FFFFFF;
				text-align: center;
			}

			form {
				margin: 25px;
			}

			form input {
				width: 100%;
				padding: 5px;
				font-size: 20px;
			}
		</style>
    </body>
</html>