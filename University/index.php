<?php

$universities = array();
$countryName = "";

if (isset($_GET['country']) && trim($_GET['country']) != "")
{
    $countryName = trim($_GET['country']);
    $country = urlencode($countryName);

    $url = "http://universities.hipolabs.com/search?country=" . $country;

    $response = @file_get_contents($url);

    if ($response !== false)
    {
        $data = json_decode($response, true);

        if (is_array($data))
        {
            $universities = $data;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Finder Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>🎓 University Finder Portal</h1>
    <p>Search Universities Around The World</p>
</header>

<div class="container">

    <div class="search-box">
        <form method="GET">

            <input
                type="text"
                name="country"
                placeholder="Enter Country Name"
                value="<?php echo htmlspecialchars($countryName); ?>"
                required>

            <button type="submit">Search</button>

        </form>
    </div>

    <?php if ($countryName != "") { ?>

        <div class="result-box">
            <h2>
                Results for:
                <?php echo htmlspecialchars($countryName); ?>
            </h2>

            <p>
                Total Universities Found:
                <strong><?php echo count($universities); ?></strong>
            </p>
        </div>

    <?php } ?>

    <div class="cards">

        <?php

        if (count($universities) > 0)
        {
            foreach ($universities as $uni)
            {
                $name = isset($uni['name']) ? $uni['name'] : 'N/A';
                $country = isset($uni['country']) ? $uni['country'] : 'N/A';

                $domain = 'N/A';
                if (isset($uni['domains'][0]))
                {
                    $domain = $uni['domains'][0];
                }

                $website = '#';
                if (isset($uni['web_pages'][0]))
                {
                    $website = $uni['web_pages'][0];
                }

                ?>

                <div class="card">

                    <h3><?php echo htmlspecialchars($name); ?></h3>

                    <p>
                        <strong>Country:</strong>
                        <?php echo htmlspecialchars($country); ?>
                    </p>

                    <p>
                        <strong>Domain:</strong>
                        <?php echo htmlspecialchars($domain); ?>
                    </p>

                    <a
                        href="<?php echo htmlspecialchars($website); ?>"
                        target="_blank"
                        class="btn">
                        Visit Website
                    </a>

                </div>

                <?php
            }
        }
        elseif ($countryName != "")
        {
            echo "<h3>No universities found.</h3>";
        }

        ?>

    </div>

</div>

<footer>
    <p>University Finder Portal | PHP API Project</p>
</footer>

</body>
</html>