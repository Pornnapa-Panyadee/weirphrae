
<style>
    .circle{
        width: 1.6em;
        text-align: center;
        line-height: 1.6em;
    }
</style>
<nav class="navbar header-navbar pcoded-header" >
    <div class="navbar-wrapper">
        <div class="navbar-logo"> 
            <a href="{{ asset('/') }}">  <h3>Phrae Weir Assessment System </h3> </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><i class="fa fa-reorder"></i></a>
            <a class="mobile-options waves-effect waves-light"><i class="feather icon-log-in"></i></a>
            
        </div>
        <div class="navbar-container container-fluid">
            <div class="nav-right">
                <ul >
                    <li class="user-profile header-notification">
                        <div class="dropdown-primary dropdown">
                            <div class="dropdown-toggle" data-toggle="dropdown">เข้าสู่ระบบ </div>
                            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" >
                                <li>
                                <a href="{{ asset('/login') }}"><i class="feather icon-log-in"></i> Login</a>
                                </li>
                                    
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>