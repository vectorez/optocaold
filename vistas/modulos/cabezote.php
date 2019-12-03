<header class="main-header">
	<!-- Logo -->
    <a href="inicio" class="logo">
      	<!-- mini logo for sidebar mini 50x50 pixels -->
     	<!--<span class="logo-mini logoJ">
      		<span>GI</span>
      	</span>
      	logo for regular state and mobile devices -->
      	<!--<span class="logo-lg logoJ" style="font-size: 18px;">
      		Gestion Incapacidades
      	</span>-->
      	<span class="logo-mini">
      		<!--<img src="vistas/img/plantilla/icono.png" class="img-responsive" style="padding: 10px;">-->
      		<img src="vistas/img/plantilla/icono_pqu.png" height="30" width="30" />
      	</span>
      	<!-- logo for regular state and mobile devices -->
      	<span class="logo-lg">
      		<img src="vistas/img/plantilla/Provisional_421.png" height="45" width="165" />	
      	</span>
    </a>
    <!-- BARRA DE NAVEGACION -->
    <nav class="navbar navbar-static-top">
		<!-- Boton de Navegacion -->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<!-- Perfil de usuario -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php
							$imagen = 'vistas/img/usuarios/default/anonymous.png';
							if($_SESSION['foto'] != null && $_SESSION['foto'] != ''){
								$imagen = $_SESSION['foto'];
							}
						?>
						<img src="<?php echo $imagen; ?>" class="user-image">
						<span class="hidden-xs">
						 	<?php 
		                        if(isset($_SESSION['nombre'])){
		                            echo $_SESSION['nombre'];
		                        }
		                    ?>
						</span>
					</a>
					<!-- Dropdown Toggle -->
					<ul class="dropdown-menu">
						<li class="user-header" >
	                        <img src="<?php echo $imagen;?>" class="img-circle" alt="User Image">
	                        <p>
	                            <?php 
	                                echo $_SESSION['nombre']; 
								?>
	                        </p>
	                    </li>
						<li class="user-footer">
							<div class="pull-right">
								<a href="salir" class="btn btn-default btn-flat">Salir</a>
							</div>
							<!--<div class="pull-left">
								<a href="salir" class="btn btn-default btn-flat">Cambiar Contraseña</a>
							</div>-->
						</li>
					</ul>
				</li>
			</ul>
		</div>
		
    </nav>
</header>