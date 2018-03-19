<html>
    <?=$page_header?>
    <body>
        <div class="container-fluid">
            <?=$page_navbar?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron jumbotron-fluid text-center">
                        <div class="container">
                            <h1 class="display-4">Login</h1>
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
                            <input type="username" required class="form-control" id="username" name="username" aria-describedby="usernameHelp" placeholder="Username">
                            <small id="usernameHelp" class="form-text text-muted">Please <a href="account/recovery">click here if you have forgotten your username.</a></small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" required class="form-control" id="password" name="password" placeholder="Password">
                            <small id="passwordHelp" class="form-text text-muted">Please <a href="account/recovery">click here if you have forgotten your password.</a></small>
                        </div>

                        <?php
                            if ( $recaptcha_enabled )
                            {

                                ?>
                                    <div class="captcha_wrapper">
                                        <div class="g-recaptcha" data-sitekey="<?=$recaptcha_sitekey?>"></div>
                                    </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <input type="hidden" name="g-recaptcha-response" value="false">
                                <?php
                            }
                        ?>

                        <input type="hidden" value="false" name="verification">
                        <button type="submit" style="margin-top: 1.5%;" class="btn btn-primary">Submit</button>
                    </form>
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