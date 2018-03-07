<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-top: 15px; border-radius: 5px;">
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
                        <li class="nav-item" style="float: right;">
                            <a class="nav-link" href="<?=$url_root?>profile"><?=$profiles->user->info->username?></a>
                        </li>
                    </ul>
                    <?php

                }
                else
                {

                    ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=$url_root?>login">Login</a>
                        </li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </nav>
