<html>
    <?=$page_header?>
    <div class="container-fluid">
        <?=$page_navbar?>
        <div class="row">
            <?=$index_content?>
        </div>
        <?php
        if ( isset( $page_breadcrumb ) )
        {

            echo $page_breadcrumb;
        };
        ?>
    </div>
    <?=$page_footer?>
</html>