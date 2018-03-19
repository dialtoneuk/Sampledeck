<html>
    <?=$page_header?>
    <body>
        <div class="container-fluid">
            <?=$page_navbar?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron jumbotron-fluid text-center">
                        <div class="container">
                            <h1 class="display-4">Hub</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-bottom: 24px;">
                <div class="col-sm-12">
                    <h3>
                        Your Builds
                        <small class="text-muted">Ordered by the latest you have uploaded</small>
                    </h3>
                    <?php
                    if ( isset( $model->builds ) && $model->builds !== null )
                    {

                        $counter = 0;

                        foreach ( $model->builds as $build )
                        {

                            if ( $counter % 3 == 0)
                            {

                                if ( $counter == 0 )
                                {

                                        echo '<div class="row">';
                                }
                                else
                                {

                                        echo '<div class="row" style="margin-top: 24px;">';
                                }
                            }
                            ?>
                                <div class="col-sm-4">
                                    <div class="card" style="height: 12.5em;">
                                        <div class="card-body">
                                            <h5 class="card-title" style="overflow: hidden; white-space: nowrap;  text-overflow: ellipsis; width: 95%;">
                                                <?=$build->name?>
                                            </h5>
                                            <p>
                                                <small>
                                                    <?=date('d/m/y h:i:sA', $build->timestamp)?> by
                                                    <span class="badge badge-primary" style="background-color: #<?=$profiles->user->info->colour?>;">
                                                    <?=$profiles->user->info->username?>
                                                </span>
                                                </small>
                                            </p>
                                            <p class="card-text" style="overflow: hidden; white-space: nowrap;  text-overflow: ellipsis; height: 2em;">
                                                <?=$build->description?>
                                            </p>
                                            <a href="play/<?=$build->buildid?>" class="btn btn-success"><i class="fas fa-play"></i> Play</a>
                                            <a href="edit/<?=$build->buildid?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="edit/<?=$build->buildid?>" class="btn btn-outline-info" style="float: right;"><i class="fas fa-link"></i> Share</a>
                                        </div>
                                    </div>
                                </div>
                            <?php

                            if ( $counter % 2 == 0 )
                            {

                                if ( $counter != 0)
                                {

                                    echo '</div>';
                                }
                            }

                            if ( $counter == count( $model->builds ) - 1 )
                            {

                                echo '</div>';
                            }

                            $counter++;
                        }
                    }
                    else
                    {
                        ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-info" role="alert">
                                        You don't have any builds! Why don't you <a href="/add">add one to Unibary?</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                </div>
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