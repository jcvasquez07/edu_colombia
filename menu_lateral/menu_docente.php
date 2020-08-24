<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['nombre_corto__usuario_logeado']; ?></a>
            <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="fas fa-desktop"></i>&nbsp;&nbsp;
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-school"></i>
                    <p>Academico<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">


                    <li class="nav-item">
                        <a href="main.php?pagina=listado_grupos" class="nav-link">
                            <i class="fas fa-cubes mx-2"></i>
                            <p>Grupos</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="main.php?pagina=listado_materias" class="nav-link">
                            <i class="fa fa-book-open mx-2"></i>
                            <p>Asignaturas</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="main.php?pagina=listado_tareas" class="nav-link">
                            <i class="fa fa-check-double mx-2"></i>
                            <p>Tareas</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
