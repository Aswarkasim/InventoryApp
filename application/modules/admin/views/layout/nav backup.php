<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>



    <!-- Nav Item - Pages Collapse Menu -->
    <?php

    $main_menu = $this->db->get_where('tbl_menu_admin', array('is_main_menu' => 0));
    foreach ($main_menu->result() as $main) {
        //mencari data sub menu
        $sub_menu = $this->db->get_where('tbl_menu_admin', array('is_main_menu' => $main->id_menu));
        //perikasa apakas ada submenu
        if ($sub_menu->num_rows() > 0) {
            //main menu dengan sub menu
            echo '
            <li class="nav-item">
                <a class="nav-link collapsed" href="' . base_url($main->link) . '" data-toggle="collapse" data-target="#' . $main->slug . '" aria-expanded="true" aria-controls="' . $main->slug . '">
                    <i class="' . $main->icon . '"></i>
                    <span>' . $main->judul_menu . '</span>
                </a>
                <div id="' . $main->slug . '" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">';

            foreach ($sub_menu->result() as $sub) {
                echo '<a class="collapse-item" href="' . base_url($sub->link) . '">' . $sub->judul_menu . '</a>';
            }
            echo '</div>   
                </div>
            </li>';
        } else {
            //main menu tanpa sub
            echo '
                <li class="nav-item">
                    <a class="nav-link" href="' . base_url($main->link) . '">
                        <i class="' . $main->icon . '"></i>
                        <span>' . $main->judul_menu . '</span></a>
                </li>
            ';
        }
    }

    ?>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul> -->