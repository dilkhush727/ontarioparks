<header>
    <div class="container">
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="<?=base_url()?>assets/images/logo.png" width="70">
            </a>

            <!-- <img src="<?=base_url('assets/images/user-profile.png')?>" class="user-image"> -->

            <div>
                <img src="<?=base_url('assets/images/user-profile.png')?>" class="navbar-toggler user-image" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">

                <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('logout'); ?>">Sign Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

<?php if (strpos(current_url(), 'get-started') === false): ?>
    <nav id="nav-footer">
        <a href="<?= base_url('dashboard'); ?>" class="<?= strpos(current_url(), base_url('dashboard')) !== false ? 'active' : '' ?>">
            <i class="fa fa-home"></i>
            <span>Home</span>
        </a>

        <a href="<?= base_url('get-parks'); ?>" class="<?= strpos(current_url(), base_url('get-parks')) !== false ? 'active' : '' ?>">
            <i class="fa fa-map"></i>
            <span>Navigate</span>
        </a>

        <a href="<?= base_url('gear-guide'); ?>" class="<?= strpos(current_url(), base_url('gear-guide')) !== false ? 'active' : '' ?>">
            <i class="fa fa-compass"></i>
            <span>Gear Guide</span>
        </a>

        <a href="<?= base_url('add-friends'); ?>" class="<?= strpos(current_url(), base_url('add-friends')) !== false ? 'active' : '' ?>">
            <i class="fa fa-comments"></i>
            <span>Community</span>
        </a>
    </nav>
<?php endif; ?>