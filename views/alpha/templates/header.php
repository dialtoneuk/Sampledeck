<?php
    if ( isset( $page_title ) == false )
    {

        $page_title = "<?=$website_name?>";
    }
?>

<head>
    <title><?=$page_title?></title>
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <?php
        if (isset( $custom_scripts ) )
        {

            if ( is_array( $custom_scripts ) )
            {

                foreach ( $custom_scripts as $script )
                {

                    if ( is_string( $script ) == false )
                        continue;

                    echo $script;
                }
            }
        }
    ?>
</head>