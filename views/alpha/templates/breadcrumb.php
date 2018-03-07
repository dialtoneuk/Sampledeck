<div class="row" style="margin-top: 28px;">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-capitalize">
                <li class="breadcrumb-item active"><a href="<?=$url_root?>"><?=$website_name?></a></li>
                <?php

                    $parts = explode('/', $_SERVER['REQUEST_URI'] );

                    foreach ( $parts as $part )
                    {
                        if ( empty( $part ) )
                            continue;

                        if ( $part == rtrim( ltrim( $url_root, '/'), '/' ) )
                            continue;

                        if ( last( $parts ) == $part )
                        {

                            ?>
                                <li class="breadcrumb-item" aria-current="<?=$part?>"><?=$part?></li>
                            <?php
                            continue;
                        }

                        ?>
                            <li class="breadcrumb-item text-up"><a href="<?=$url_root . $part?>"><?=$part?></a></li>
                        <?php
                    }
                ?>
                <li class="breadcrumb-item">
                    <small class="text-muted">Computed in <?=round( $load_time, 2)?> seconds.</small>
                </li>
            </ol>
        </nav>
    </div>
</div>