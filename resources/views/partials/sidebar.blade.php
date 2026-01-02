<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.jpg') }}" alt="Lighter Logo" class="rounded-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid rgba(255,255,255,0.2);">
        </div>
        <div class="sidebar-brand-text mx-3">Lighter</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- SECTION: MARKETING SERVICES --}}
   @if(!request()->routeIs('cms*'))
        <hr class="sidebar-divider">

        {{-- 1. LGTR DIGITAL MARKETING --}}
        <li class="nav-item {{ (request()->is('*manajemen*') || request()->is('*analisis*')) && !request()->is('*BD*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLGTR" aria-expanded="false">
                <i class="fas fa-fw fa-bullhorn"></i>
                <span>LGTR Digital Marketing</span>
            </a>

            <div id="collapseLGTR" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded mx-2 shadow-sm">
                    
                    <a class="collapse-item font-weight-bold d-flex align-items-center bg-light mb-1 collapsed" 
                       href="#" data-toggle="collapse" data-target="#collapseMrCrepeLGTR" 
                       style="color: #e74a3b !important; justify-content: space-between;" aria-expanded="false">
                        <span><i class="fas fa-store mr-2"></i> MR. CREPE</span>
                        <i class="fas fa-chevron-down fa-xs"></i>
                    </a>

                    <div id="collapseMrCrepeLGTR" class="collapse">
                        <div class="py-1 ml-2 border-left-danger">
                            @if (Auth::user()->role == "admin")
                                <div class="px-3 mb-2">
                                    <a class="btn btn-sm btn-outline-danger btn-block text-xs font-weight-bold py-1" href="{{ route('cms.produk', 'LGTR') }}">
                                        <i class="fas fa-tools fa-xs mr-1"></i> CMS
                                    </a>
                                </div>
                            @endif

                            @foreach ($menus as $group)
                                @if($group->id == 1)
                                <div class="px-2">
                                    <a class="collapse-item collapsed font-weight-bold text-gray-600 py-1" data-toggle="collapse" data-target="#groupLGTR{{ $group->id }}" aria-expanded="false">
                                        <i class="fas fa-folder fa-sm mr-2 text-gray-400"></i> {{ $group->category }}
                                    </a>
                                    <div id="groupLGTR{{ $group->id }}" class="collapse">
                                        <div class="py-1 ml-3 border-left-primary">
                                            @foreach ($group->clients as $client)
                                                <a class="collapse-item d-flex align-items-center font-weight-bold text-primary py-1 collapsed" data-toggle="collapse" data-target="#sub_client_lgtr_{{ $client->id }}" aria-expanded="false">
                                                    <i class="fas fa-user-circle mr-2"></i> {{ $client->nama }}
                                                    <i class="fas fa-caret-down ml-auto"></i>
                                                </a>
                                                <div id="sub_client_lgtr_{{ $client->id }}" class="collapse ml-2 border-left-secondary">
                                                    <a class="collapse-item py-1 small" href="{{ route('manajemen', $client->id) }}">Manajemen Konten</a>
                                                    @if(isset($client->access_token['platform']))
                                                        @foreach($client->access_token['platform'] as $plt)
                                                            <a class="collapse-item py-1 small" href="{{ route('analisis', ['id_produk' => $client->id, 'platform' => $plt]) }}">
                                                                Analisis Konten {{ $plt }}
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                    {{-- <a class="collapse-item py-1 small" href="{{ route('analisis', $client->id) }}">Analisis Konten</a> --}}
                                                    <a class="collapse-item py-1 small" href="{{ route('market_research', $client->id) }}">Market Research</a>
                                                    <a class="collapse-item py-1 small" href="{{ route('branding', $client->id) }}">Branding</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </li>

        {{-- 2. BUSINESS DEVELOPMENT --}}
        <li class="nav-item {{ request()->is('*BD*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBD" aria-expanded="false">
                <i class="fas fa-fw fa-briefcase"></i>
                <span>Business Development</span>
            </a>

            <div id="collapseBD" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded mx-2 shadow-sm">
                    
                    <a class="collapse-item font-weight-bold d-flex align-items-center bg-light mb-1 collapsed" 
                       href="#" data-toggle="collapse" data-target="#collapseMrCrepeBD" 
                       style="color: #4e73df !important; justify-content: space-between;" aria-expanded="false">
                        <span><i class="fas fa-store mr-2"></i> MR. CREPE</span>
                        <i class="fas fa-chevron-down fa-xs"></i>
                    </a>

                    <div id="collapseMrCrepeBD" class="collapse">
                        <div class="py-1 ml-2 border-left-primary">
                            @if (Auth::user()->role == "admin")
                                <div class="px-3 mb-2">
                                    <a class="btn btn-sm btn-outline-primary btn-block text-xs font-weight-bold py-1" href="{{ route('cms.produk', 'BD') }}">
                                        <i class="fas fa-tools fa-xs mr-1"></i> CMS
                                    </a>
                                </div>
                            @endif

                            @foreach ($menus as $group)
                                @if($group->id != 1)
                                <div class="px-2">
                                    <a class="collapse-item collapsed font-weight-bold text-gray-600 py-1" data-toggle="collapse" data-target="#groupBD{{ $group->id }}" aria-expanded="false">
                                        <i class="fas fa-folder fa-sm mr-2 text-gray-400"></i> {{ $group->category }}
                                    </a>
                                    <div id="groupBD{{ $group->id }}" class="collapse">
                                        <div class="py-1 ml-3 border-left-primary">
                                            @foreach ($group->clients as $client)
                                                <a class="collapse-item d-flex align-items-center font-weight-bold text-primary py-1 collapsed" data-toggle="collapse" data-target="#sub_client_bd_{{ $client->id }}" aria-expanded="false">
                                                    <i class="fas fa-user-circle mr-2"></i> {{ $client->nama }}
                                                    <i class="fas fa-caret-down ml-auto"></i>
                                                </a>
                                                <div id="sub_client_bd_{{ $client->id }}" class="collapse ml-2 border-left-secondary">
                                                    <a class="collapse-item py-1 small" href="{{ route('manajemen', $client->id) }}">Manajemen Konten</a>
                                                    @if(isset($client->access_token['platform']))
                                                        @foreach($client->access_token['platform'] as $plt)
                                                            <a class="collapse-item py-1 small" href="{{ route('analisis', ['id_produk' => $client->id, 'platform' => $plt]) }}">
                                                                Analisis Konten {{ $plt }}
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                    <a class="collapse-item py-1 small" href="{{ route('market_research', $client->id) }}">Market Research</a>
                                                    <a class="collapse-item py-1 small" href="{{ route('branding', $client->id) }}">Branding</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endif

    {{-- SECTION: CMS MR CREPE (DIPERBESAR) --}}
    @if(request()->routeIs('cms*'))
        <hr class="sidebar-divider">
        <div class="sidebar-heading text-white font-weight-bold mb-3" style="font-size: 0.95rem; letter-spacing: 0.1rem; opacity: 1; text-transform: uppercase;">
            <i class="fas fa-tools mr-1 text-warning"></i> CMS MR CREPE
        </div>

        <li class="nav-item {{ request()->routeIs('cms.produk', $activeProductCode) ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('cms.produk', $activeProductCode) }}"><i class="fas fa-fw fa-box"></i><span>Produk</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('cms.hook', $activeProductCode) ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('cms.hook', $activeProductCode) }}"><i class="fas fa-fw fa-anchor"></i><span>Hook</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('cms.strategy', $activeProductCode) ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('cms.strategy', $activeProductCode) }}"><i class="fas fa-fw fa-chess"></i><span>Strategy</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('cms.status', $activeProductCode) ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('cms.status', $activeProductCode) }}"><i class="fas fa-fw fa-info-circle"></i><span>Status</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('cms.type', $activeProductCode) ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('cms.type', $activeProductCode) }}"><i class="fas fa-fw fa-tags"></i><span>Product Type</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('cms.pilar', $activeProductCode) ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('cms.pilar', $activeProductCode) }}"><i class="fas fa-fw fa-columns"></i><span>Pilar</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('cms.body', $activeProductCode) ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('cms.body', $activeProductCode) }}"><i class="fas fa-fw fa-paragraph"></i><span>Body</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('cms.cta', $activeProductCode) ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('cms.cta', $activeProductCode) }}"><i class="fas fa-fw fa-mouse-pointer"></i><span>CTA</span></a>
        </li>
    @endif

    {{-- BUTTON KEMBALI --}}
    @if(request()->routeIs('cms*'))
        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-arrow-left text-warning"></i>
                <span class="text-warning font-weight-bold">Kembali</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

{{-- CSS FIX UNTUK SCROLLBAR & JARAK MEPEET --}}
<style>
    #accordionSidebar {
        overflow-y: auto !important;
        overflow-x: hidden !important;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE/Edge */
    }
    #accordionSidebar::-webkit-scrollbar {
        display: none !important; /* Chrome/Safari */
    }
    .collapse-inner .collapse-item {
        margin-right: 12px !important; /* Jarak agar tidak mepet kanan */
        margin-left: 8px !important;
        border-radius: 5px;
        white-space: normal !important; /* Agar teks panjang tidak terpotong */
    }
    .border-left-primary { border-left: 3px solid #4e73df !important; }
</style>