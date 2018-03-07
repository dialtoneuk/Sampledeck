<?php
if ( isset( $model->errors ) )
{

    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger" role="alert" id="alert">
                <?php
                foreach ( $model->errors as $error )
                {
                    ?>
                    <?=$error?>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>