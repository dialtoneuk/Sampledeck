<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="margin-top: 15px; border-radius: 5px 5px 0px 0px;">
            <a class="navbar-brand" href="<?=$url_root?>"><?=$website_name?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <?php
                if ( $profiles->session->info->active)
                {
                    ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="hub">Hub</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Builds
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">View</a>
                                <a class="dropdown-item" href="#">Links</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Upload</a>
                            </div>
                        </li>


                        <?php

                        if ( isset( $profiles->teams ) == false )
                        {

                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Team
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Create</a>
                                        <a class="dropdown-item" href="#">Join</a>
                                    </div>
                                </li>
                            <?php
                        }
                        else
                        {

                            if ( isset( $profiles->teams->info->teamid) )
                            {

                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Team <span class="badge badge-primary" style="background-color: #<?=$profiles->teams->info->colour?>;"><?=$profiles->teams->info->name?></span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">Builds</a>
                                            <a class="dropdown-item" href="#">Members</a>

                                            <?php

                                                if ( $profiles->teams->info->group == ADMIN_GROUP )
                                                {

                                                    ?>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Manage</a>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </li>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Team
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">Create</a>
                                            <a class="dropdown-item" href="#">Join</a>
                                        </div>
                                    </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <ul class="navbar-nav" style="margin-left: auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Account <span class="badge badge-primary" style="background-color: #<?=$profiles->user->info->colour?>;"><?=$profiles->user->info->username?></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="settings">Settings</a>
                                <a class="dropdown-item" href="logout">Logout</a>
                            </div>
                        </li>
                    </ul>
                    <?php

                }
                else
                {

                    ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="register">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login">Pricing</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav" style="margin-left: auto">
                        <li class="nav-item">
                            <a class="nav-link" href="register" data-toggle="tooltip" data-placement="bottom" title="Register"><i class="fas fa-star"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login" data-toggle="tooltip" data-placement="bottom" title="Login"><i class="fas fa-home"></i></a>
                        </li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </nav>
