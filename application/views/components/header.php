<header>
    <div class="container">
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="assets/images/logo.png" width="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
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
            </div>
        </nav>
    </div>
</header>

<nav id="nav-footer">
    <a href="<?=base_url(); ?>">
        <i class="fa fa-home"></i>
        <span>Home</span>
    </a>
    <a href="#">
        <i class="fa fa-map"></i>
        <span>Navigate</span>
    </a>
    <a href=" <?=base_url('Gearguide'); ?>">
        <i class="fa fa-compass"></i>
        <span>Gear Guide</span>
    </a>
    <a href="#">
        <i class="fa fa-comments"></i>
        <span>Community</span>   
    </a>
</nav>