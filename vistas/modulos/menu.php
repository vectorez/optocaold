<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <?php
                    $imagen = 'vistas/img/usuarios/default/anonymous.png';
                    if($_SESSION['foto'] != null && $_SESSION['foto'] != ''){
                        $imagen = $_SESSION['foto'];
                    }
                ?>
                <img src="<?php echo $imagen; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> 
                    <?php 
                        if(isset($_SESSION['nombre'])){
                            echo $_SESSION['nombre'];
                        }
                    ?>  
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar Paciente">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <?php
                $menuspermisos = ControladorPerfiles::ctrMostrarMenusPermisos('perfiles_permisos_perfil_id_i',$_SESSION['perfil']);
                foreach($menuspermisos as $item){
                    if($item['menus_treeview_i'] == 0){ 
                        echo '<li id="menu_'.$item['menus_html_href_v'].'">
                                <a href="'.$item['menus_html_href_v'].'">
                                    <i class="'.$item['menus_html_icon_v'].'"></i><span>'.$item['menus_nombre_v'].'</span>
                                </a>
                              </li>';
                    }
                }
                foreach($menuspermisos as $item){
                    if($item['menus_treeview_i'] == 1){
                        echo '
                                <li class="treeview" id="menu_'.$item['menus_html_href_v'].'">
                                    <a href="#">
                                        <i class="'.$item['menus_html_icon_v'].'"></i>
                                        <span>'.$item['menus_nombre_v'].'</span>
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">';
                        $opciones = ControladorPerfiles::ctrMostrarOpcionesMenu('opciones_menus_id_i',$item['perfiles_permisos_menu_id_i'], $_SESSION['perfil']);
                        foreach($opciones as $item2){
                            if($item2['opciones_padre_id_i'] == 0){
                                echo '
                                    <li id="op_'.$item2['opciones_html_href_v'].'">
                                        <a href="'.$item2['opciones_html_href_v'].'">
                                            <i class="'.$item2['opciones_html_icon_v'].'"></i> '.$item2['opciones_nombre_v'].'
                                        </a>
                                    </li>';
                            }else{
                                echo '
                                    <li id="op_'.$item2['opciones_html_href_v'].'" class="treeview">
                                        <a href="'.$item2['opciones_html_href_v'].'">
                                            <i class="'.$item2['opciones_html_icon_v'].'"></i> '.$item2['opciones_nombre_v'].'
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>';
                                $sub_opciones = ControladorPerfiles::ctrMostrarSubOpcionesMenu('opciones_padre_id_i', $item2['perfiles_permisos_opciones_id_i']);
                                echo '<ul class="treeview-menu">';
                                foreach($sub_opciones as $item3){
                                    echo '<li id="op_'.$item3['opciones_html_href_v'].'">
                                            <a href="'.$item3['opciones_html_href_v'].'">
                                                <i class="'.$item3['opciones_html_icon_v'].'"></i> '.$item3['opciones_nombre_v'].'
                                            </a>
                                          </li>';
                                }
                                echo '</ul>
                                    </li>';
                            }
                        }
                        echo '
                                    </ul>
                            </li>';
                    }
            } 
            ?>
        </ul>
    </section>
</aside>