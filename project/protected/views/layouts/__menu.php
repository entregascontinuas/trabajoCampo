<?php $path = explode("/",Yii::app()->request->pathInfo); ?>

        <ul class="menu">
          

          <li class="menu__item <?php echo (count($path) > 1)?((strtolower($path[0]) == 'index')?'active':''):'active'; ?>">
            <a href="<?php echo Yii::app()->homeUrl; ?>" class="item row middle-xs">
              <span class="item__icon"><i class="fa fa-home"></i></span>
              <span>Dashboard</span>
            </a>
          </li>
          
          
          <?php if(Tools::hasPermission(1)){ ?>
            <li class="menu__item has__submenu <?php echo (strtolower($path[0]) == 'usuarios')?'active':''; ?>">
              <p class="item row middle-xs">
                <span class="item__icon"><i class="fa fa-user"></i></span>
                <span>Usuarios</span>
                <span class="item__icon icon__small"><i class="fa fa-angle-down"></i></span>
              </p>
              <ul class="submenu">
                <li><a href="<?php echo $this->createUrl('usuarios/admin') ?>">Listar</a></li>
                <li><a href="<?php echo $this->createUrl('usuarios/create') ?>">Agregar</a></li>
              </ul>
            </li>
          <?php } ?>
          
          
          <?php if(Tools::hasPermission(2)){ ?>
            <li class="menu__item has__submenu <?php echo (strtolower($path[0]) == 'clientes')?'active':''; ?>">
              <p class="item row middle-xs">
                <span class="item__icon"><i class="fa fa-street-view"></i></span>
                <span>Clientes</span>
                <span class="item__icon icon__small"><i class="fa fa-angle-down"></i></span>
              </p>
              <ul class="submenu">
                <li><a href="<?php echo $this->createUrl('clientes/admin') ?>">Listar</a></li>
                <li><a href="<?php echo $this->createUrl('clientes/create') ?>">Agregar</a></li>
              </ul>
            </li>
          <?php } ?>
          
          <!--
          <?php if(Tools::hasPermission(3)){ ?>
            <li class="menu__item has__submenu <?php echo (strtolower($path[0]) == 'vehiculos')?'active':''; ?>">
              <p class="item row middle-xs">
                <span class="item__icon"><i class="fa fa-car"></i></span>
                <span>Vehículos</span>
                <span class="item__icon icon__small"><i class="fa fa-angle-down"></i></span>
              </p>
              <ul class="submenu">
                <li><a href="<?php echo $this->createUrl('vehiculos/admin') ?>">Listar</a></li>
                <li><a href="<?php echo $this->createUrl('vehiculos/create') ?>">Agregar</a></li>
              </ul>
            </li>
          <?php } ?>


          <?php if(Tools::hasPermission(4) || Tools::hasPermission(5)){ ?>
            <li class="menu__item has__submenu <?php echo (strtolower($path[0]) == 'ingresos')?'active':''; ?>">
              <p class="item row middle-xs">
                <span class="item__icon"><i class="fa fa-sign-in"></i></span>
                <span>Ingreso de Vehículos</span>
                <span class="item__icon icon__small"><i class="fa fa-angle-down"></i></span>
              </p>
              <ul class="submenu">
                <li><a href="<?php echo $this->createUrl('ingresos/admin') ?>">Listar</a></li>
                <?php if(Tools::hasPermission(4)){ ?>
                  <li><a href="<?php echo $this->createUrl('ingresos/create') ?>">Agregar</a></li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
        
          <?php if(Tools::hasPermission(6)){ ?>
            <li class="menu__item <?php echo (strtolower($path[0]) == 'reportes')?'active':''; ?>">
              <a class="item row middle-xs" href="<?php echo $this->createUrl('reportes/create'); ?>">
                <span class="item__icon"><i class="fa fa-bar-chart"></i></span>
                <span>Reportes</span>
              </a>
            </li>
          <?php } ?>-->


        </ul>