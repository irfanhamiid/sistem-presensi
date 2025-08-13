<ul class="nav nav-primary">
    <li class="nav-item">
        <a href="{{ route('admin-dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Data</h4>
    </li>
    <li class="nav-item">
        <a href="{{ route('karyawan-list') }}">
            <i class="fas fa-users"></i>
            <p>Karyawan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('laporan-kehadiran') }}">
            <i class="fas fa-book"></i>
            <p>Laporan Absensi</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('jam-kerja') }}">
            <i class="fas fa-clock"></i>
            <p>Setting Jam Kerja</p>
        </a>
    </li>
</ul>
