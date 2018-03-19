<?php
if ( isset( $model->errors ) )
{

    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger" role="alert" id="alert">
                <?php

                    if ( count( $model->errors ) == 1 )
                    {

                        ?>
                            <?=$model->errors[0]?>
                        <?php
                    }
                    else
                    {

                        foreach ( $model->errors as $error )
                        {
                            ?>
                            <p>
                                <?=htmlspecialchars( $error )?>
                            </p>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>