<!-- Dark overlay -->
<div class="overlay"></div>

<!-- Content -->
<div class="content">

    <nav id="naviBar" class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <i class="fas fa-angle-double-right fa-sm mr-3 text-light open-menu" style="cursor:pointer;"></i>
            <span class="comName">Dashboard</span>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="fas fa-user"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="naviIcon">
                        <i class="fa fa-calendar fa-lg mr-2" style="font-size: 18px;"></i>
                        <span id="currentDate" class="bd-highlight align-self-center">[Current date]</span>
                    </li>
                    <li class="naviIcon ml-2">
                        <div class="mr-2 ml-2">
                            <div>
                                <span style="font-size: 15px;">Marley Botosh</span>
                            </div>
                            <div class="d-flex justify-content-center">
                                <span style="font-size: 11px;">Administrator</span>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown naviIcon ml-2">
                        <a class="noUnderline dropdown-toggle d-flex align-items-center ml-2" href="#" id="navbarDropdownProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle" style="font-size: 23px;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <a class="dropdown-item" href="#">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>