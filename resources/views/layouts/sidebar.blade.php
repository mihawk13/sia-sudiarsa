<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ asset('assets/images/users/profile.png') }}" alt="user" />
                <!-- this is blinking heartbit-->
                <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
            </div>
            <!-- User profile text-->
            <div class="profile-text">
                <h5>{{ auth()->user()->nama }}</h5>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li> <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i
                            class="mdi mdi-gauge"></i>Dashboard</a></li>
                <li> <a class="waves-effect waves-dark" href="{{ route('kontak') }}" aria-expanded="false"><i
                            class="mdi mdi-account-box"></i>Kontak</a></li>
                <li> <a class="waves-effect waves-dark" href="{{ route('akun') }}" aria-expanded="false"><i
                            class="mdi mdi-bullseye"></i>Akun</a></li>
                <li> <a class="waves-effect waves-dark" href="{{ route('barang') }}" aria-expanded="false"><i
                            class="mdi mdi-gift"></i>Barang</a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="mdi mdi-plus-circle-multiple-outline"></i><span class="hide-menu">Transaksi </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('kas') }}">Kas</a></li>
                        <li><a href="/">Penjualan</a></li>
                        <li><a href="/">Pembelian</a></li>
                        <li><a href="/">Bayar</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="mdi mdi-book-open-variant"></i><span class="hide-menu">Laporan </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="starter-kit.html">Starter Kit</a></li>
                        <li><a href="pages-blank.html">Blank page</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
