<html>
    <?=$page_header?>
    <div class="container-fluid">
        <?=$page_navbar?>
        <div class="row" style="margin-top: 2.5%;">
            <div class="col-sm-4 offset-4">
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
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" class="form-control" id="username" name="username" aria-describedby="usernameHelp" placeholder="Enter username">
                        <small id="usernameHelp" class="form-text text-muted">Please <a href="<?=$url_root?>account/recovery">click here if you have forgotten your username</a></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <input type="hidden" value="false" name="verification">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?=$page_footer?>
</html>