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
                            <p class="lead"><?=$profiles->user->info->username?></p>
                            <p class="small"><a href="/settings"><?=$profiles->user->info->email?></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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

                                    ?>
                                        <div class="row">
                                    <?php
                                }
                                else
                                {

                                    ?>
                                        <div class="row" style="margin-top: 1.5%;">
                                    <?php
                                }
                            }
                            ?>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$build->name?> <small><?=date('d/m/y', $build->timestamp)?> by <span class="badge badge-primary" style="background-color: #<?=$profiles->user->info->colour?>;"><?=$profiles->user->info->username?></span></small></h5>
                                        <p class="card-text">
                                            <?=$build->description?>
                                        </p>
                                        <a href="#" class="btn btn-primary">Play</a>
                                    </div>
                                </div>
                            </div>
                            <?php

                            if ( $counter % 2 == 0 )
                            {

                                if ( $counter != 0)
                                {
                                    ?>
                                        </div>
                                    <?php
                                }
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
                    };
                ?>
            </div>
    </body>
    <?=$page_footer?>
</html>