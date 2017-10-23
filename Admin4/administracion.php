<?php
include('menuinicial.php');
?>
<header>
    <div class="container-fluid">
        <div class="navbar-holder d-flex align-items-center justify-content-between">
            <!-- Navbar Header-->
            <div class="navbar-header">
                <!-- Navbar Brand -->
                <a href="index.html" class="navbar-brand">
                    <div class="brand-text brand-big hidden-lg-down"><span><?php echo String_Get_Valores('titulo');?> </span><strong> DashBoard</strong></div>
                    <div class="brand-text brand-small"><strong>DB</strong></div>
                </a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                <!-- Notifications-->
                <li class="nav-item dropdown">
                    <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red">12</span></a>
                    <ul aria-labelledby="notifications" class="dropdown-menu">
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item">
                                <div class="notification">
                                    <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item">
                                <div class="notification">
                                    <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item">
                                <div class="notification">
                                    <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item">
                                <div class="notification">
                                    <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                                    <div class="notification-time"><small>10 minutes ago</small></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications                                            </strong></a>
                        </li>
                    </ul>
                </li>
                <!-- Messages                        -->
                <li class="nav-item dropdown">
                    <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange">10</span></a>
                    <ul aria-labelledby="notifications" class="dropdown-menu">
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                <div class="msg-body">
                                    <h3 class="h5">Jason Doe</h3>
                                    <span>Sent You Message</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                <div class="msg-body">
                                    <h3 class="h5">Frank Williams</h3>
                                    <span>Sent You Message</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                <div class="msg-body">
                                    <h3 class="h5">Ashley Wood</h3>
                                    <span>Sent You Message</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages    </strong></a>
                        </li>
                    </ul>
                </li>
                <!-- Logout    -->
                <li class="nav-item"><a href="login.html" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
            </ul>
        </div>
    </div>
</header>
<div class="page-content d-flex align-items-stretch">
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
                <h1 class="h4">Mark Stephen</h1>
                <p>Web Designer</p>
            </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Principal</span>
        <ul class="list-unstyled">
            <li class="active"> <a href="./"><i class="icon-home"></i>Home</a></li>
            <?php 
      $numero =1;
      $vector = Array_Get_MenuPrincipal(0,'principal',$_SESSION['perfil']);
      foreach ($vector as $value)
      {

        if ($value['submenu']=='1')
        {
          ?>
                <li>
                    <a href="#dashvariants<?php echo $numero ?>" aria-expanded="false" data-toggle="collapse"> <i class="icon-<?php echo $value['icono']; ?>"></i><?php echo $value['nombre']; ?></a>
                    <ul id="dashvariants<?php echo $numero ?>" class="collapse list-unstyled">
                        <?php
          $vectores = Array_Get_MenuPrincipal($value['id_modulos'],'hijos',$_SESSION['perfil']);
          foreach ($vectores as $values)
          {
            ?>
                            <li>
                                <a href="<?php echo $values['ruta']; ?>">
                                    <?php echo $values['nombre']; ?>
                                </a>
                            </li>
                            <?php
          }
          ?>
                    </ul>
                </li>
                <?php
      }
      else
      {
        ?>
                    <li> <a href="pages/<?php echo $value['ruta']; ?>"> <i class="icon-<?php echo $value['icono']; ?>"></i><?php echo $value['nombre']; ?></a></li>
                    <?php
      }     
      $numero= $numero+1;
      }
      ?>
    </nav>
</div>