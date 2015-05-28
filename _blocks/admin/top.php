 <!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">	               	               
    <li class="dropdown">
        <a href="#" id="usename" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['username']?> <b class="caret"></b></a>
        <ul class="dropdown-menu">	                        
             <li>
                <a href="<?=FX_System::url("admin/account")?>"><i class="fa fa-fw fa-gear"></i> <?=$_LANG[LANG_SYS]['menu_configuration']?></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?=FX_System::url("admin/logout")?>"><i class="fa fa-fw fa-power-off"></i> <?=$_LANG[LANG_SYS]['menu_logout']?></a>
            </li>	                       
        </ul>
    </li>
</ul>