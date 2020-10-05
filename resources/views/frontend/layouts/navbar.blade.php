<nav class="navbar">
    <div class=" container ">
        <div class="navbar-header ">
            <button type="button " class="navbar-toggle collapsed " data-toggle="collapse " data-target="#navbar " aria-expanded="false " aria-controls="navbar ">
                <span class="sr-only ">Mr Exportir</span>
                <span class="icon-bar "></span>
                <span class="icon-bar "></span>
                <span class="icon-bar "></span>
            </button>
            <a class="navbar-brand " href="<?php echo url('/') ?>">
                <img src="<?php echo url('/frontend/assets'); ?>/images/logo_new.png" class="img-responsive logo-top ">
            </a>
        </div>
        <div id="navbar " class="navbar-collapse collapse ">

            <ul class="nav navbar-nav navbar-right ">
                <li>
                    <a href="<?php echo url('/layanan') ?>">Layanan</a>
                </li>
                <li>
                    <a href="<?php echo url('/panduan') ?>">Panduan Expor</a>
                </li>
                <li>
                    <a href="<?php echo url('/xportku') ?>">XportKu</a>
                </li>
                <li>
                    <a href="<?php echo url('/cekresi') ?>">Cek Harga</a>
                </li>
                @if(Session::has('isloggedin'))
                <li class="btn-login"><a href="<?php echo url('/dashboard') ?>">Dashboard</a></li>
                @else
                <li class="btn-login"><a href="<?php echo url('/userlogin') ?>">Masuk</a></li>
                @endif
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
    <hr>
</nav>