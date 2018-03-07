<html>
    <?=$page_header?>
    <div class="container-fluid">
        <?=$page_navbar?>
        <div class="row">
            <div class="col-sm-12">
                <div class="jumbotron jumbotron-fluid text-center">
                    <div class="container">
                        <h1 class="display-4">Root Login</h1>
                        <p class="lead">Don't have an account? <a href="<?=$url_root?>register">Click here to sign up, it only takes a few seconds!</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 offset-4">
                <?=$form_error?>
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" required class="form-control" id="username" name="username" aria-describedby="usernameHelp" placeholder="Enter username">
                        <small id="usernameHelp" class="form-text text-muted">Please <a href="<?=$url_root?>account/recovery">click here if you have forgotten your username</a></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" required class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <input type="hidden" value="false" name="verification">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
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