<html>
    <?=$page_header?>
    <div class="container-fluid">
        <?=$page_navbar?>
        <div class="row">
            <div class="col-sm-12">
                <div class="jumbotron jumbotron-fluid text-center">
                    <div class="container">
                        <h1 class="display-4"><?=$website_name?></h1>
                        <p class="lead">Virtual Online Crime Simulator</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Virtual Computer</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Control and build your hardware & weapons.</h6>
                        <p class="card-text">Control and manipulate up to 128 unique computers at a single time and create your own army of slaves.</p>
                        <a href="#" class="card-link">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sharing your Warez</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Find and distribute over 40 kinds of unique softwares.</h6>
                        <p class="card-text">Explore the internet and find various softwares, tools and weapons to use against other machines.</p>
                        <a href="#" class="card-link">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Built by You, For You</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Completely open-source in nature.</h6>
                        <p class="card-text">Change it. Host your own. Mod it. Expand the game how ever you like and view the source code freely</p>
                        <a href="https://github.com/dialtoneuk/syscrack" class="card-link">Github</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 28px;">
            <div class="col-sm-12">
                <div class="jumbotron jumbotron-fluid" style="background-color: #28a745; color: white;">
                    <div class="container">
                        <h2 class="display-4">Currently over 0 players online...</h2>
                        <p class="lead">With over $0 in current bank accounts on the network.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: -28px;">
            <div class="col-sm-12">
                <div class="jumbotron jumbotron-fluid" style="background-color: #28a745; color: white;">
                    <div class="container">
                        <h2 class="display-4">Over 0 actions preformed network wide...</h2>
                        <p class="lead">With currently 0 DDoS attacks currently being executed.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Login to Terminal</h5>
                        <h6 class="card-subtitle mb-2 text-muted" >Already got an account? Login and start committing digital crime.</h6>
                        <a href="<?=$url_root?>login" class="card-link">Login</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Register</h5>
                        <h6 class="card-subtitle mb-2 text-muted" >It only takes a few minutes to register a new account.</h6>
                        <a href="<?=$url_root?>register" class="card-link">Register</a>
                    </div>
                </div>
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