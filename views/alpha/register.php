<html>
    <?=$page_header?>
    <body>
        <div class="container-fluid">
            <?=$page_navbar?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron jumbotron-fluid text-center">
                        <div class="container">
                            <h1 class="display-4">Register</h1>
                            <p class="lead">Already have an account? <a href="login">Click here login!</a></p>
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
                            <?php
                                if ( isset( $model->form['username'] ) )
                                {
                                    ?>
                                    <input type="text" required class="form-control" id="username" name="username" aria-describedby="usernameHelp" value="<?=htmlspecialchars( $model->form['username'] )?>">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <input type="text" required class="form-control" id="username" name="username" aria-describedby="usernameHelp" placeholder="Enter username">
                                    <?php
                                }

                            ?>
                            <small id="usernameHelp" class="form-text text-muted">This username will be seen publicly on Unibary to anybody who adds you to a team.</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <?php
                                if ( isset( $model->form['email'] ) )
                                {
                                    ?>
                                    <input type="email" required class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?=htmlspecialchars( $model->form['email'] )?>">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <input type="email" required class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="email@email.com">
                                    <?php
                                }
                            ?>
                            <small id="emailHelp" class="form-text text-muted">Please choose a valid email as you'll need to verify your email in order to login. We promise we won't spam you.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" required class="form-control" id="password" name="password" placeholder="Password">
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