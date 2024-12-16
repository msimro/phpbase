<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drupal-Inspired Design with API Integration</title>
    <style>
        /* ... (CSS from previous responses) ... */
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Your Website Title</h1>
        <p>A RankSignals inspired design with image API.</p>
    </header>

    <main>

        <?php
        // Hero Image
        $url = 'https://pixelford.com/api2/image?qty=1';
        $heroImage = json_decode(file_get_contents($url), true); // Decode as associative array


        if ($heroImage && !empty($heroImage)) { // Check if the API returned any data. The returned data from api is [] and !empty is for checking against that.
            $firstImage = $heroImage[0]; // Get the first image from the array
            $imageUrl = $firstImage['url_full_size'];  // Correctly access image URL
            $imageAlt = $firstImage['description'] ?? 'Hero Image'; // Use description or default alt text
            $imageCaption = $firstImage['title'] ?? 'Hero Image Caption';  // Use title or default caption
            ?>

            <figure class="full-width">
                <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt; ?>">
                <figcaption><?php echo $imageCaption; ?></figcaption>
            </figure>

            <?php
        } else {
            echo "<p>Error loading hero image or API unavailable.</p>";
        }

        ?>




        <section class="features">
            <h2>Features</h2>
            <div class="feature-grid">

                <?php

                $url = 'https://pixelford.com/api2/image?qty=3';
                $images = json_decode(file_get_contents($url), true); // Decode as array

                if ($images && is_array($images)) { // API returns array on success. This check makes sure its array format.
                    foreach ($images as $img) {
                      $imageUrl = $img['url_full_size'];
                      $imageAlt = $img['description'] ?? 'Feature image';
                      $imageCaption = $img['title'] ?? 'Feature Caption';
                        ?>
                        <div class="feature">
                            <figure class="grid-image">
                                <img src="<?php echo $imageUrl ?>" alt="<?php echo $imageAlt ?>">
                                <figcaption><?php echo $imageCaption ?></figcaption>
                            </figure>
                            <h3><?php echo $img['title'] ?></h3>
                            <p><?php echo $img['description'] ?></p>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Error loading grid images or API unavailable.</p>";
                }
                ?>
            </div>
        </section>


    </main>

    <footer>
        &copy; 2024 Your Website
    </footer>
</div>
</body>
</html>

