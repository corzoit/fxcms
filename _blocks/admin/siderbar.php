<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
    	<li>
            <a href="<?=FX_System::url('admin/')?>"><i class="fa fa-fw fa-dashboard"></i> <?=$_LANG[LANG_SYS]['menu_dashboard']?></a>
        </li>
        <li>
            <a href="<?=FX_System::url('admin/menu/manager')?>"><i class="glyphicon glyphicon-tasks"></i> <?=$_LANG[LANG_SYS]['menu_manager']?></a>
        </li>	                    
        <li>
            <a href="<?=FX_System::url('admin/page/manager')?>" class="" data-target="#demo" data-toggle="collapse" href="javascript:;" ><i class="fa fa-fw fa-table"></i> <?=$_LANG[LANG_SYS]['menu_content_author']?></a>
            <!--<ul class="collapse" id="demo" >
                <li>
                    <a href="<?=FX_System::url('administrador/seccion')?>"><i class="fa fa-fw fa-table"></i> Secciones</a>
                </li>
                <li>
                    <a href="<?=FX_System::url('administrador/autores')?>"><i class="fa fa-fw fa-table"></i> Autores</a>
                </li>
            </ul>-->
        </li>	                            
        <li>
            <a href="<?=FX_System::url('admin/contact/manager')?>"><i class="glyphicon glyphicon-earphone"></i> <?=$_LANG[LANG_SYS]['menu_contacts']?></a>
        </li>
        	                    	                  
        <li>
            <a href="<?=FX_System::url('admin/slideshow/manager')?>"><i class="glyphicon glyphicon-facetime-video"></i> <?=$_LANG[LANG_SYS]['menu_slides_manager']?></a>
        </li>          
        <li>
            <a href="<?=FX_System::url('admin/comment/manager')?>"><i class="glyphicon glyphicon-envelope"></i> <?=$_LANG[LANG_SYS]['menu_comments']?></a>
        </li>  
         <li>
            <a href="<?=FX_System::url('admin/media/')?>"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?=$_LANG[LANG_SYS]['menu_media']?></a>            
        </li>  
        <li>
            <a href="<?=FX_System::url('admin/design/')?>" target="_blank"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?=$_LANG[LANG_SYS]['menu-design']?></a>            
        </li>  
   	</ul>
</div>