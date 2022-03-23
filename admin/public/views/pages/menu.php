<aside class="main-sidebar elevation-4 sidebar-light-danger">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="public/views/resources/img/qs-logo.png" alt="QS-logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bolder">QSC-Web</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="public/views/resources/img/logo-attention.png" class="img-circle elevation-2" alt="User IMG">
            </div>
            <div class="info">
                <a href="dashboard" class="d-block font-weight-bolder">Hola! <?php echo $_SESSION["loginNombresQS"]; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Administración</li>
                <li class="nav-item">
                    <a href="usuarios" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>
                <li class="nav-header">Complementos</li>
                <li class="nav-item">
                    <a href="derechos" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale-right"></i>
                        <p>
                            Derechos en Salud
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="causas" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Causas Específicas
                        </p>
                    </a>
                </li>

                <li class="nav-header">Atención al Usuario Virtual</li>
                <li class="nav-item">
                    <a href="reclamos" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Reclamos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="consultas" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Consultas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="sugerencias" class="nav-link">
                        <i class="nav-icon fas fa-comment-medical"></i>
                        <p>
                            Sugerencias
                        </p>
                    </a>
                </li>
                <li class="nav-header">Reportes</li>
                <li class="nav-item">
                    <a href="reporte-general" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            General
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte-jefatura" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Jefatura
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte-responsable" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Responsable
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>