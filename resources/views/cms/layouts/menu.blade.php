<aside class="main-sidebar fixed offcanvas b-r sidebar-tabs" data-toggle='offcanvas'>
    <div class="sidebar">
        <div class="d-flex hv-100 align-items-stretch">
            <div class="indigo text-white">
                <div class="nav mt-5 pt-5 flex-column nav-pills" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <!-- <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                       aria-controls="v-pills-home" aria-selected="true"><i class="icon-inbox2"></i></a> -->
                    <!-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                       aria-controls="v-pills-profile" aria-selected="false"><i class="icon-add"></i></a> -->
                    <!-- <a class="nav-link blink skin_handle"  href="#"><i class="icon-lightbulb_outline"></i></a>
                    <a class="nav-link" id="v-pills-messages-tab" href="#"><i class="icon-message"></i></a>
                    <a class="nav-link" id="v-pills-settings-tab" href="#"><i class="icon-settings"></i></a> -->
                    <a href="">
                        <figure class="avatar">
                            <img src="{{url('assets/img/dummy/u3.png')}}" alt="">
                            <span class="avatar-badge online"></span>
                        </figure>
                    </a>
                </div>
            </div>
            <div class="tab-content flex-grow-1" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                     aria-labelledby="v-pills-home-tab">
                    <div class="relative brand-wrapper sticky b-b">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <div class="text-xs-center">
                                <span class="font-weight-lighter s-18">Menu</span>
                            </div>
                            <div class="badge badge-danger r-0">New Panel</div>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="treeview"><a href="<?php echo url('/order')?>"><i class="icon icon-inbox-document-text2 s-24"></i>Order</a></li>
                        <li class="treeview"><a href="<?php echo url('/tracking')?>"><i class="icon icon-local_shipping s-24"></i>Tracking</a></li>
                        <li class="treeview"><a href="<?php echo url('/barangkategori')?>"><i class="icon icon-package2 s-24"></i>Kategori Barang</a></li>
                        <li class="treeview"><a href="<?php echo url('/barangjenis')?>"><i class="icon icon-box2 s-24"></i>Jenis Barang</a></li>
                        <li class="treeview"><a href="<?php echo url('/barangpackage')?>"><i class="icon icon-box-filled2 s-24"></i>Package Barang</a></li>
                        <li class="treeview"><a href="<?php echo url('/fob')?>"><i class="icon icon-archive2 s-24"></i>FOB</a></li>
                        <li class="treeview"><a href="<?php echo url('/item')?>"><i class="icon icon-tag-add2 s-24"></i>Add-ons</a></li>
                        <li class="treeview"><a href="<?php echo url('/asuransi')?>"><i class="icon icon-money2 s-24"></i>Asuransi</a></li>
                        <li class="treeview"><a href="<?php echo url('/address')?>"><i class="icon icon-address-book s-24"></i>Alamat</a></li>
                        <li class="treeview"><a href="<?php echo url('/negara')?>"><i class="icon icon-building s-24"></i>Negara</a></li>
                        <li class="treeview"><a href="<?php echo url('/kota')?>"><i class="icon icon-location_city s-24"></i>Kota</a></li>
                        <li class="treeview"><a href="<?php echo url('/blog')?>"><i class="icon icon-newspaper-o s-24"></i>Blog</a></li>
                        <li class="treeview"><a href="<?php echo url('/image')?>"><i class="icon icon-image s-24"></i>Image</a></li>
                        <li class="treeview"><a href="<?php echo url('/iklan')?>"><i class="icon icon-chrome_reader_mode s-24"></i>Iklan</a></li>
                        <li class="treeview"><a href="<?php echo url('/users')?>"><i class="icon icon-account_box s-24"></i>Users</a></li>
                        <li class="treeview"><a href="<?php echo url('/configuration')?>"><i class="icon icon-gear s-24"></i>Configuration</a></li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="relative brand-wrapper sticky b-b p-3">
                        <form>
                            <div class="form-group input-group-sm has-right-icon">
                                <input class="form-control form-control-sm light r-30" placeholder="Search" type="text">
                                <i class="icon-search"></i>
                            </div>
                        </form>
                    </div>
                    <div class="sticky slimScroll">

                        <div class="p-2">
                            <ul class="list-unstyled">
                                <!-- Alphabet with number of contacts -->
                                <li class="pt-3 pb-3 sticky p-3 b-b white">
                                    <span class="badge r-3 badge-success">A</span>
                                </li>
                                <!-- Single contact -->
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u1.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u6.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u6.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-unstyled">
                                <li class="pt-3 pb-3 sticky p-3 b-b white">
                                    <span class="badge r-3 badge-danger">B</span>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u2.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u3.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u4.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-unstyled">
                                <!-- Alphabet with number of contacts -->
                                <li class="pt-3 pb-3 sticky p-3 b-b white">
                                    <span class="badge r-3 badge-success gradient">C</span>
                                </li>
                                <!-- Single contact -->
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u1.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u6.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u6.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-4">
                                    <span class="badge r-3 badge-danger purple">D</span>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u2.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u3.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="my-1">
                                    <div class="card no-b p-3">
                                        <div class="">

                                            <div class="image mr-3  float-left">
                                                <img class="w-40px" src="assets/img/dummy/u4.png" alt="User Image">
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>Alexander Pierce</strong>
                                                </div>
                                                <small> alexander@paper.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>