<header>
    <div class="container">
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="<?=base_url()?>assets/images/logo.png" width="70">
            </a>

            <img src="<?=base_url('assets/images/user.png')?>" class="user-image">
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;" onclick="alert('Coming Soon...')">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;" onclick="alert('Coming Soon...')">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('logout'); ?>">Sign Out</a>
                    </li>
                </ul>
            </div> -->
        </nav>
    </div>
</header>

<?php if (strpos(current_url(), 'get-started') === false): ?>
    <nav id="nav-footer">
        <a href="<?= base_url('dashboard'); ?>" class="<?= strpos(current_url(), base_url('dashboard')) !== false ? 'active' : '' ?>">
            <i class="fa fa-home"></i>
            <span>Home</span>
        </a>

        <a href="#" class="">
            <i class="fa fa-map"></i>
            <span>Navigate</span>
        </a>

        <a href="<?= base_url('gear-guide'); ?>" class="<?= strpos(current_url(), base_url('gear-guide')) !== false ? 'active' : '' ?>">
            <i class="fa fa-compass"></i>
            <span>Gear Guide</span>
        </a>

        <a href="#" class="">
            <i class="fa fa-comments"></i>
            <span>Community</span>
        </a>
    </nav>
<?php endif; ?>