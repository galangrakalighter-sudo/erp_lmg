@include('partials.header')

<div class="container-fluid mt-4 pb-5">
    <div class="row g-4 mb-6">
        <div class="col-lg-6">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-image mr-2"></i>4P Analyze</h6>
                @if(Auth::user()->role == "admin")
                <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalAnalyze4P">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                </button>
                @endif
            </div>
            <div class="card card-body h-100">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="dataTable">
                        <thead class="bg-light">
                            <tr class="text-secondary" style="font-size: 0.85rem;">
                                <th class="bg-dark text-white">No</th>
                                <th class="bg-dark text-white">Nama</th>
                                <th class="bg-dark text-white">Type</th>
                                <th class="bg-dark text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.875rem;">
                            @foreach ($data['data'][0] as $analize_4p)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $analize_4p->nama_analisis }}</th>
                                    <th>{{ $analize_4p->type }}</th>
                                    <th>
                                        <button class="btn btn-warning btn-sm text-white" 
                                                data-toggle="modal" 
                                                data-target="#editModalAnalyze4P_{{ $analize_4p->id }}" 
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <button class="btn btn-danger btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#deleteModalAnalyze4P_{{ $analize_4p->id }}" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-image mr-2"></i>SWOT Analyse</h6>
                @if(Auth::user()->role == "admin")
                <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalSWOT">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                </button>
                @endif
            </div>
            <div class="card card-body h-100">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="swot_analize">
                        <thead class="bg-light">
                            <tr class="text-secondary" style="font-size: 0.85rem;">
                                <th class="bg-dark text-white">No</th>
                                <th class="bg-dark text-white">Strenght</th>
                                <th class="bg-dark text-white">Weakness</th>
                                <th class="bg-dark text-white">Oportunity</th>
                                <th class="bg-dark text-white">Threat</th>
                                @if(Auth::user()->role == "admin")
                                <th class="bg-dark text-white">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.875rem;">
                            @foreach ($data['data'][1] as $analize_swot)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $analize_swot->strenght }}</th>
                                    <th>{{ $analize_swot->weakness }}</th>
                                    <th>{{ $analize_swot->oportunity }}</th>
                                    <th>{{ $analize_swot->threat }}</th>
                                    @if(Auth::user()->role == "admin")
                                    <th>
                                        <button class="btn btn-warning btn-sm text-white" 
                                                data-toggle="modal" 
                                                data-target="#editModalSWOT_{{ $analize_swot->id }}" 
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <button class="btn btn-danger btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#deleteModalSWOT_{{ $analize_swot->id }}" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </th>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-13 mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-image mr-2"></i>Segmentasi Market</h6>
            @if(Auth::user()->role == "admin")
            <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalSegmentasi">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
            </button>
            @endif
        </div>
        <div class="card card-body h-100">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="segmentasi">
                    <thead class="bg-light">
                        <tr>
                            <th colspan="2" class="bg-info border"></th>
                            <th class="text-center bg-info border text-white" colspan="2">Demografi</th>
                            <th class="text-center bg-info border text-white" colspan="2">Geografi</th>
                            <th class="text-center bg-info border text-white" colspan="3">Psikografi</th>
                            <th class="text-center bg-info border text-white" colspan="4">Perilaku</th>
                        </tr>
                        <tr class="text-secondary" style="font-size: 0.85rem;">
                            <th class="bg-dark text-white">No</th>
                            <th class="bg-dark text-white">Usia</th>
                            <th class="bg-dark text-white">Gender</th>
                            <th class="bg-dark text-white">Negara</th>
                            <th class="bg-dark text-white">Wilayah</th>
                            <th class="bg-dark text-white">Gaya Hidup</th>
                            <th class="bg-dark text-white">Status Sosial</th>
                            <th class="bg-dark text-white">Minat</th>
                            <th class="bg-dark text-white">Penggunaan Konten</th>
                            <th class="bg-dark text-white">Loyalitas</th>
                            <th class="bg-dark text-white">Manfaat</th>
                            @if(Auth::user()->role == "admin")
                            <th class="bg-dark text-white">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.875rem;">
                        @foreach ($data['data'][3] as $segmentasi)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $segmentasi->usia }}</th>
                                <th>{{ $segmentasi->gender }}</th>
                                <th>{{ $segmentasi->negara }}</th>
                                <th>{{ $segmentasi->wilayah }}</th>
                                <th>{{ $segmentasi->gaya_hidup }}</th>
                                <th>{{ $segmentasi->status_sosial }}</th>
                                <th>{{ $segmentasi->minat }}</th>
                                <th>{{ $segmentasi->penggunaan }}</th>
                                <th>{{ $segmentasi->loyalitas }}</th>
                                <th>{{ $segmentasi->manfaat }}</th>
                                @if(Auth::user()->role == "admin")
                                <th>
                                    <button class="btn btn-warning btn-sm text-white" 
                                            data-toggle="modal" 
                                            data-target="#editModalSegmentasi_{{ $segmentasi->id }}" 
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <button class="btn btn-danger btn-sm" 
                                            data-toggle="modal" 
                                            data-target="#deleteModalSegmentasi_{{ $segmentasi->id }}" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </th>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-image mr-2"></i>Target Audience</h6>
                @if(Auth::user()->role == "admin")
                <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalTarget">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                </button>
                @endif
            </div>
            <div class="card card-body h-100">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="target_audience">
                        <thead class="bg-light">
                            <tr class="text-white bg-info" style="font-size: 0.85rem;">
                                <th class="border">No</th>
                                <th class="border">Indikator</th>
                                <th class="border text-center" colspan="2" class="text-center">Profile</th>
                                <th class="border">Gaya Hidup</th>
                                <th class="border">Status Sosial</th>
                                <th class="border">Penggunaan Produk</th>
                                <th class="border">Manfaat</th>
                                @if(Auth::user()->role == "admin")
                                <th class="border">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.875rem;">
                            @foreach ($data['data'][4] as $target)
                                @php
                                    $profiles = [
                                        ['label' => 'Usia', 'val' => $target->usia ?? 'Semua Usia'],
                                        ['label' => 'Gender', 'val' => $target->gender ?? 'Semua Gender'],
                                        ['label' => 'Negara', 'val' => $target->negara ?? 'Indonesia'],
                                        ['label' => 'Wilayah', 'val' => $target->wilayah ?? 'Jabodetabek'],
                                        ['label' => 'Profile', 'val' => $target->pekerjaan ?? 'Pekerja Kantoran'],
                                    ];
                                @endphp

                                @foreach ($profiles as $p)
                                <tr>
                                    {{-- Data utama diulang di setiap baris agar dideteksi plugin --}}
                                    <td class="text-center">{{ $loop->parent->iteration }}</td>
                                    <td class="text-center">{{ $target->indikator ?? "-" }}</td>
                                    
                                    {{-- Bagian Profile (Dua kolom ini tetap terpisah per baris) --}}
                                    <td style="background-color: #f2f2f2; font-weight: bold;">{{ $p['label'] }}</td>
                                    <td>{{ $p['val'] }}</td>

                                    {{-- Kolom Sisi Kanan diulang di setiap baris --}}
                                    <td class="text-center">{{ $target->gaya_hidup ?? "-" }}</td>
                                    <td class="text-center">{{ $target->status_sosial ?? "-" }}</td>
                                    <td class="text-center">{{ $target->penggunaan ?? "-" }}</td>
                                    <td class="text-center">{{ $target->manfaat ?? "-" }}</td>
                                    @if(Auth::user()->role == "admin")
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm text-white" 
                                                data-toggle="modal" 
                                                data-target="#editModalTarget_{{ $target->id }}" 
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <button class="btn btn-danger btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#deleteModalTarget_{{ $target->id }}" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-image mr-2"></i>Posistion</h6>
                @if(Auth::user()->role == "admin")
                <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalPosition">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                </button>
                @endif
            </div>
            <div class="card card-body h-100">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="positioning">
                        <thead class="bg-light">
                            <tr class="text-secondary bg-info" style="font-size: 0.85rem;">
                                <th class="text-white border">No</th>
                                <th class="text-white border">Indikator</th>
                                <th class="text-white border">Deskripsi</th>
                                @if(Auth::user()->role == "admin")
                                <th class="text-white border">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.875rem;">
                            @foreach ($data['data'][2] as $positioning)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $positioning->indikator }}</th>
                                    <th>{{ $positioning->deskripsi }}</th>
                                    @if(Auth::user()->role == "admin")
                                    <th>
                                        <button class="btn btn-warning btn-sm text-white" 
                                                data-toggle="modal" 
                                                data-target="#editModalPosition_{{ $positioning->id }}" 
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <button class="btn btn-danger btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#deleteModalPosition_{{ $positioning->id }}" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </th>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('cms_market.4p.index')
@include('cms_market.swot.index')
@include('cms_market.segmentasi.index')
@include('cms_market.target_audience.index')
@include('cms_market.positioning.index')

@include('partials.footer')