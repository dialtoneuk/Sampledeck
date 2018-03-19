<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron jumbotron-fluid text-center">
                <div class="container">
                    <h1 class="display-4"><?=$website_name?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-bottom: 24px;">

        <?php

            if ( $profiles->user->info->group == DEFAULT_GROUP )
            {

                ?>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="lead">
                                    Why purchase a package?
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card" style="height: 15rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-users"></i> Build teams</h5>
                                        <p class="card-text">Unibary allows you to create a group accessible repository for your development builds
                                            when working with the Unity Engine. Easily share the current state of your game with team members and
                                            comment on builds with feedback and advice.</p>
                                        <a href="#" class="btn btn-primary">Read more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card" style="height: 15rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-globe"></i> Play & Share your creations</h5>
                                        <p class="card-text">Unibary allows for direct play testing inside your web browser, as long as
                                            its a modern one that supports OpenGL. You can also create share links so that unregistered users
                                            are able to play test your build. This can also be useful for temporary game hosting when testing
                                            online features.</p>
                                        <a href="#" class="btn btn-primary">Read more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card" style="height: 15rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Up to 20 Builds included free</h5>
                                        <p class="card-text">Unibary users are able to create teams, upload up to 20 builds and obtain
                                            all the features of Unibary with out paying a dime. If you require more builds, we charge a
                                            very modest price offering packages which offer unlimited builds at an affordable price.</p>
                                        <a href="#" class="btn btn-primary">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
            else
            {

                ?>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="display-4">
                                    You are a supporter!
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Modify your package</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Edit, Change or Refund your current package.</h6>
                                        <a href="#" class="btn btn-primary">Package</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">View your builds</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Take a look at all of your Unity builds.</h6>
                                        <a href="#" class="btn btn-primary">Builds</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
    <div class="row" style="padding-bottom: 24px;">
        <div class="col-sm-12">
            <p class="display-4">
                News
            </p>
            <div class="row">
                <div class="col-sm-3">
                    <div class="card" style="height: 18em;">
                        <div class="card-body">
                            <h5 class="card-title">Test News Entry</h5>
                            <h6 class="card-subtitle mb-2 text-muted">By <span class="badge badge-primary">hackerman</span></h6>
                            <p class="card-text" style="overflow: hidden; white-space: nowrap;  text-overflow: ellipsis; height: 8em;">
                                Lorem ipsum dolor sit amet, ex solet commodo ius, <br>
                                ubique putant dissentiet in nam, pro et tantas, <br>
                                laboramus ullamcorper. Clita vivendum no vix, <br>
                                rebum soleat mel te, mel viris consequat conclusionemque ea.
                                Cu sed idque graece possit, mei commodo mediocrem ea. Vitae adipisci assueverit an sea,
                                mei te nihil aliquid, te nec alii aperiam probatus. Vix tantas commodo concludaturque ei,
                                mel eu graeci ponderum intellegam.
                            </p>
                            <a class="btn btn-primary btn-sm" href="#" role="button"><i class="fas fa-file"></i> Read</a>
                            <a class="btn btn-outline-primary btn-sm" href="#" style="float: right;" role="button"><i class="fas fa-envelope"></i> Share</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card" style="height: 18em;">
                        <div class="card-body">
                            <h5 class="card-title">Test News Entry</h5>
                            <h6 class="card-subtitle mb-2 text-muted">By <span class="badge badge-primary">hackerman</span></h6>
                            <p class="card-text" style="overflow: hidden; white-space: nowrap;  text-overflow: ellipsis; height: 8em;">
                                Lorem ipsum dolor sit amet, ex solet commodo ius, <br>
                                ubique putant dissentiet in nam, pro et tantas, <br>
                                laboramus ullamcorper. Clita vivendum no vix, <br>
                                rebum soleat mel te, mel viris consequat conclusionemque ea.
                                Cu sed idque graece possit, mei commodo mediocrem ea. Vitae adipisci assueverit an sea,
                                mei te nihil aliquid, te nec alii aperiam probatus. Vix tantas commodo concludaturque ei,
                                mel eu graeci ponderum intellegam.
                            </p>
                            <a class="btn btn-primary btn-sm" href="#" role="button"><i class="fas fa-file"></i> Read</a>
                            <a class="btn btn-outline-primary btn-sm" href="#" style="float: right;" role="button"><i class="fas fa-envelope"></i> Share</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card" style="height: 18em;">
                        <div class="card-body">
                            <h5 class="card-title">Test News Entry</h5>
                            <h6 class="card-subtitle mb-2 text-muted">By <span class="badge badge-primary">hackerman</span></h6>
                            <p class="card-text" style="overflow: hidden; white-space: nowrap;  text-overflow: ellipsis; height: 8em;">
                                Lorem ipsum dolor sit amet, ex solet commodo ius, <br>
                                ubique putant dissentiet in nam, pro et tantas, <br>
                                laboramus ullamcorper. Clita vivendum no vix, <br>
                                rebum soleat mel te, mel viris consequat conclusionemque ea.
                                Cu sed idque graece possit, mei commodo mediocrem ea. Vitae adipisci assueverit an sea,
                                mei te nihil aliquid, te nec alii aperiam probatus. Vix tantas commodo concludaturque ei,
                                mel eu graeci ponderum intellegam.
                            </p>
                            <a class="btn btn-primary btn-sm" href="#" role="button"><i class="fas fa-file"></i> Read</a>
                            <a class="btn btn-outline-primary btn-sm" href="#" style="float: right;" role="button"><i class="fas fa-envelope"></i> Share</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card" style="height: 18em;">
                        <div class="card-body">
                            <div class="jumbotron jumbotron-fluid text-center">
                                <div class="container">
                                    <p>
                                        Read all of the latest updates from <?=$website_name?> at our official development blog.
                                        <br>
                                        <br>
                                        <a class="btn btn-success btn-sm" href="#" role="button"><i class="fas fa-envelope"></i> Read</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron jumbotron-fluid text-center">
                <div class="container">
                    <p>
                        <a class="btn btn-primary btn-sm" href="#" role="button"><i class="fab fa-discord"></i>  Join our discord</a>
                        <a class="btn btn-primary btn-sm" href="#" role="button"><i class="fab fa-github"></i> Fork us on Github</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


