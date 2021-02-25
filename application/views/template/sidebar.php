<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li>
                    <a href="<?= base_url('dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-th-list"></i> <span> Transmittal </span>  <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="<?= base_url('transmittal/new') ?>">New Transmittal</a></li>
                        <li><a href="<?= base_url('transmittal/all') ?>">All Transmittal</a></li>
                    </ul>
                </li>
                <li class="menu-title">Reports</li>
                <li>
                    <a href="<?= base_url('reports/transmittal') ?>"><i class="fas fa-newspaper" aria-hidden="true"></i> Transmittal Report</a>
                </li>
            </ul>
        </div>
    </div>
</div>