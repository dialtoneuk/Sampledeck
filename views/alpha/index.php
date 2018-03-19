<html>
    <?=$page_header?>
    <body>
        <div class="container-fluid">
            <?=$page_navbar?>
            <div class="row">
                <?=$index_content?>
            </div>
            <?php
                if ( isset( $page_breadcrumb ) )
                {

                    echo $page_breadcrumb;
                }
            ?>
        </div>
    </body>
    <?=$page_footer?>
</html>