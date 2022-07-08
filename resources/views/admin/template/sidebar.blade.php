<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header px-3">
            <span class="navbar-brand" style="color: #55BEFF;"><i data-feather="layers"></i> ADMIN PMB POLHAS</span>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class='sidebar-title'>Main Menu</li>

                <li class="sidebar-item {{ Request::is('*/pendaftar*') ? 'active' : '' }} ">
                    <a href="/admin/pendaftar" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>Pendaftar</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/pesan*') ? 'active' : '' }} ">
                    <a href="/admin/pesan" class='sidebar-link'>
                        <i data-feather="mail" width="20"></i>
                        <span>Pesan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/jalur*') ? 'active' : '' }} ">
                    <a href="{{ route('jalur.index') }}" class='sidebar-link'>
                        <i data-feather="copy" width="20"></i>
                        <span>Jalur Masuk</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item  ">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>Organisasi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/rekomendasi*') ? 'active' : '' }} ">
                    <a href="/admin/rekomendasi" class='sidebar-link'>
                        <i data-feather="star" width="20"></i>
                        <span>Rekomendasi</span>
                    </a>
                </li> --}}
                <li class="sidebar-item {{ Request::is('*/prodi*') ? 'active' : '' }} ">
                    <a href="/admin/prodi" class='sidebar-link'>
                        <i data-feather="book" width="20"></i>
                        <span>Prodi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/kurikulum*') ? 'active' : '' }} ">
                    <a href="/admin/kurikulum" class='sidebar-link'>
                        <i data-feather="book-open" width="20"></i>
                        <span>Kurikulum</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/kelas*') ? 'active' : '' }} ">
                    <a href="/admin/kelas" class='sidebar-link'>
                        <i data-feather="bookmark" width="20"></i>
                        <span>Kelas</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/seleksi*') ? 'active' : '' }} ">
                    <a href="/admin/seleksi" class='sidebar-link'>
                        <i data-feather="clipboard" width="20"></i>
                        <span>Pengumuman Seleksi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/kontak*') ? 'active' : '' }} ">
                    <a href="/admin/kontak" class='sidebar-link'>
                        <i data-feather="phone" width="20"></i>
                        <span>Kontak</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/chat*') ? 'active' : '' }} ">
                    <a href="{{ route('chat.index') }}" class='sidebar-link'>
                        <i data-feather="message-circle" width="20"></i>
                        <span>Chat Bot</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('*/pengaturan*') ? 'active' : '' }} ">
                    <a href="/admin/pengaturan" class='sidebar-link'>
                        <i data-feather="settings" width="20"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>