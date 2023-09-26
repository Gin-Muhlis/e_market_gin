<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        {{-- <img src="https://vemto.app/favicon.png" alt="Vemto Logo" class="brand-image bg-white img-circle"> --}}
        <span class="brand-text font-weight-light">Techno Market</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon icon ion-md-pulse"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    @can('view-any', App\Models\Produk::class)
                        <li class="nav-item">
                            <a href="{{ route('produks.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\Barang::class)
                        <li class="nav-item">
                            <a href="{{ route('barangs.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Barang</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\Pemasok::class)
                        <li class="nav-item">
                            <a href="{{ route('pemasoks.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Pemasok</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\Pelanggan::class)
                        <li class="nav-item">
                            <a href="{{ route('pelanggans.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Pelanggan</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>User</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\Pembelian::class)
                        <li class="nav-item">
                            <a href="{{ route('pembelians.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Pembelian</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\Pembelian::class)
                        <li class="nav-item">
                            <a href="{{ route('pembelians.show') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Data Pembelian</p>
                            </a>
                        </li>
                    @endcan
                    {{-- @can('view-any', App\Models\TampungBayar::class)
                        <li class="nav-item">
                            <a href="{{ route('tampung-bayars.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Tampung Bayar</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\DetailPenjualan::class)
                        <li class="nav-item">
                            <a href="{{ route('detail-penjualans.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Detail Penjualan</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\DetailTransaksi::class)
                        <li class="nav-item">
                            <a href="{{ route('detail-transaksis.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Detail Transaksi</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\JenisPembayaran::class)
                        <li class="nav-item">
                            <a href="{{ route('jenis-pembayarans.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Jenis Pembayaran</p>
                            </a>
                        </li>
                    @endcan


                   
                    @can('view-any', App\Models\Penjualan::class)
                        <li class="nav-item">
                            <a href="{{ route('penjualans.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\Rombel::class)
                        <li class="nav-item">
                            <a href="{{ route('rombels.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Rombel</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\Transaksi::class)
                        <li class="nav-item">
                            <a href="{{ route('transaksis.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Transaksi</p>
                            </a>
                        </li>
                    @endcan --}}


                    {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-apps"></i>
                        <p>
                            Apps
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                          
                         
                    </ul>
                </li> --}}

                    {{-- @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon icon ion-md-key"></i>
                                <p>
                                    Access Management
                                    <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('view-any', Spatie\Permission\Models\Role::class)
                                    <li class="nav-item">
                                        <a href="{{ route('roles.index') }}" class="nav-link">
                                            <i class="nav-icon icon ion-md-radio-button-off"></i>
                                            <p>Roles</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('view-any', Spatie\Permission\Models\Permission::class)
                                    <li class="nav-item">
                                        <a href="{{ route('permissions.index') }}" class="nav-link">
                                            <i class="nav-icon icon ion-md-radio-button-off"></i>
                                            <p>Permissions</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif --}}
                @endauth

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon icon ion-md-exit"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
