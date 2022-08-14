 <head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="RRI Bogor">
    <link rel="shortcut icon" href="<?= base_url('assets/images/logorri.png') ?>">

    <!-- FontAwesome JS-->
    <script defer src="<?= base_url('assets/plugins/fontawesome/js/all.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <!-- Numeral JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <!-- CHART HOME -->
    <script src="<?= base_url('assets/js/grafik_chartjs.js') ?>"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/css/portal_unminify.css') ?>">
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.css') ?>"> -->

    <!-- Link dan Script Confirmation Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/sr-1.1.0/datatables.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/DataTables/datatables.min.css') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- AJAX -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- JQUERY -->
    <script type="text/javascript" charset="utf8" src="<?= base_url('assets/vendor/DataTables/datatables.min.js') ?>"></script>

 </head>

 <body class="app">
    <header class="app-header fixed-top">
       <div class="app-header-inner">
          <div class="container-fluid py-2">
             <div class="app-header-content">
                <div class="row justify-content-between align-items-center">
                   <div class="col-auto">
                      <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                         <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                            <title>Menu</title>
                            <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                         </svg>
                      </a>
                   </div>
                   <div class="app-utilities col-auto">
                      <div class="app-utility-item app-notifications-dropdown dropdown">
                         <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="Notifications">
                         </a>

                         <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
                            <div class="dropdown-menu-header p-3">
                            </div>
                            <div class="dropdown-menu-content">
                               <div class="item p-3">
                                  <div class="row gx-2 justify-content-between align-items-center">
                                     <div class="col-auto">
                                        <img class="profile-image" src="<?= base_url('assets/images/profiles/profile-1.png'); ?>" alt="">
                                     </div>
                                     <div class="col">
                                     </div>
                                  </div>
                               </div>
                               <div class="item p-3">
                                  <div class="row gx-2 justify-content-between align-items-center">
                                     <div class="col-auto">
                                        <div class="app-icon-holder">
                                           <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                              <path fill-rule="evenodd" d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                           </svg>
                                        </div>
                                     </div>
                                     <div class="col">
                                     </div>
                                  </div>
                               </div>
                               <div class="item p-3">
                                  <div class="row gx-2 justify-content-between align-items-center">
                                     <div class="col-auto">
                                        <div class="app-icon-holder icon-holder-mono">
                                           <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />
                                           </svg>
                                        </div>
                                     </div>
                                     <div class="col">
                                     </div>
                                  </div>
                               </div>
                               <div class="item p-3">
                                  <div class="row gx-2 justify-content-between align-items-center">
                                     <div class="col-auto">
                                        <img class="profile-image" src="<?= base_url('assets/images/profiles/profile-2.png'); ?>" alt="">
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <?php

                        use App\Models\Model_admin;

                        $this->adminModel = new Model_admin();
                        $admin = $this->adminModel->findAll();
                        foreach ($admin as $key => $data) {
                           if ($data['username'] == session()->get()['username']) {
                              $admindata = $data;
                              break;
                           }
                        } ?>
                      <div class="app-utility-item app-user-dropdown dropdown">
                         <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img class="rounded-circle" src="<?= base_url('assets/images/upload/' . $admindata['foto']) ?>" style="object-fit:cover;" alt="user profile"></a>
                         <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                            <li><a class="dropdown-item" href="<?= base_url('admin'); ?>">Akun</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('login/logout'); ?>">Keluar</a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <?php $page = basename($_SERVER['PHP_SELF']) ?>

       <div id="app-sidepanel" class="app-sidepanel">
          <div id="sidepanel-drop" class="sidepanel-drop"></div>
          <div class="sidepanel-inner d-flex flex-column">
             <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
             <div class="app-branding">
                <a class="app-logo" href="<?= base_url('Home'); ?>"><img class="logo-icon me-2" src="<?= base_url('assets/images/logorri.png'); ?>" alt="logo"><span class="logo-text">Koperasi RRI Bogor</span></a>
             </div>
             <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                   <li class="nav-item">
                      <a class="nav-link <?php if ($page == 'Admin' || $page == 'admin') : echo 'active';
                                          endif; ?>" href="<?= base_url('Admin'); ?>">
                         <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                               <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                         </span>
                         <span class="nav-link-text">Akun</span>
                      </a>

                   </li>
                   <li class="nav-item">
                      <a class="nav-link <?php if ($page == 'Home' || $page == 'home') : echo 'active';
                                          endif; ?>" href="<?= base_url('Home'); ?>">
                         <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                               <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            </svg>
                         </span>
                         <span class="nav-link-text">Beranda</span>
                      </a>
                   </li>
                   <li class="nav-item has-submenu">
                      <!-- tambahkan 'submenu-toggle' jika ingin ganti style pada class tag <a>-->
                      <a class="nav-link <?php if ($page == 'Item' || $page == 'item') : echo 'active';
                                          endif; ?>" href="<?= base_url('Item'); ?>">
                         <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                               <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z" />
                               <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z" />
                            </svg>
                         </span>
                         <span class="nav-link-text">Barang</span>
                         <!-- <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                         </span> -->
                      </a>
                      <!-- <div id="submenu-1" class="collapse submenu submenu-1 <?php if ($page == 'Item' || $page == 'stok') echo 'show'; ?>" data-bs-parent="#menu-accordion">
                         <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link <?php if ($page == 'Item') : echo 'active';
                                                                              endif; ?>" href="<?= base_url('Item'); ?>">Daftar Barang</a></li>
                            <li class="submenu-item"><a class="submenu-link <?php if ($page == 'stok') : echo 'active';
                                                                              endif; ?>" href="<?= base_url('Item/stok'); ?>">Stok</a></li>
                         </ul>
                      </div> -->
                   </li>
                   <li class="nav-item">
                      <a class="nav-link <?php if ($page == 'Buyer' || $page == 'buyer') : echo 'active';
                                          endif; ?>" href="<?= base_url('Buyer'); ?>">
                         <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                               <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                            </svg>
                         </span>
                         <span class="nav-link-text">Anggota</span>
                      </a>
                   </li>
                   <!-- <li class="nav-item">
                      <a class="nav-link <?php if ($page == 'Orders'|| $page == 'orders') : echo 'active';
                                          endif; ?>" href="<?= base_url('Orders'); ?>">
                         <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                               <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
                               <circle cx="3.5" cy="5.5" r=".5" />
                               <circle cx="3.5" cy="8" r=".5" />
                               <circle cx="3.5" cy="10.5" r=".5" />
                            </svg>
                         </span>
                         <span class="nav-link-text">Pembelian</span>
                      </a>
                   </li> -->
                   <li class="nav-item has-submenu">
                      <a class="nav-link <?php if ($page == 'Orders' || $page == 'input') echo 'active'; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                         <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                               <path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
                            </svg>
                         </span>
                         <span class="nav-link-text">Pembelian</span>
                         <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                         </span>
                      </a>
                      <div id="submenu-2" class="collapse submenu submenu-2 <?php if ($page == 'Orders' || $page == 'input' ) echo 'show'; ?>" data-bs-parent="#menu-accordion">
                         <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link <?php if ($page == 'Orders') : echo 'active';
                                                                              endif; ?>" href="<?= base_url('Orders'); ?>">Data Riwayat</a></li>
                            <li class="submenu-item"><a class="submenu-link <?php if ($page == 'input') : echo 'active';
                                                                              endif; ?>" href="<?= base_url('Orders/input'); ?>">Input Pembelian</a></li>
                         </ul>
                      </div>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link <?php if ($page == 'Report' || $page == 'report') echo 'active'; ?>" href="<?= base_url('Report'); ?>">
                         <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                               <path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
                            </svg>
                         </span>
                         <span class="nav-link-text">Pelaporan</span>
                      </a>
                   </li>

                </ul>
             </nav>

          </div>
       </div>
    </header>
 </body>
 <script>
 </script>