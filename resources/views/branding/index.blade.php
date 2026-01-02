@include('partials.header')

<div class="container-fluid mt-4 pb-5">
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-fingerprint mr-2"></i>Brand Identify</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalIdentify">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="dataTable">
                            <thead class="bg-dark text-white">
                                <tr style="font-size: 0.85rem;">
                                    <th>No</th>
                                    <th>Gambar</th>
                                    @if(Auth::user()->role == "admin")
                                    <th class="text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.875rem;">
                                @foreach ($identify as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>
                                    @if($item->identify)
                                        <a href="{{ asset('storage/' . $item->identify) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->identify) }}" 
                                                alt="Moodboard" 
                                                class="img-thumbnail shadow-sm" 
                                                style="width: 120px; height: 80px; object-fit: cover;">
                                        </a>
                                    @else
                                        <span class="text-muted small">Tidak ada gambar</span>
                                    @endif
                                    </th>
                                    @if(Auth::user()->role == "admin")
                                    <th>
                                        <button class="btn btn-warning btn-sm text-white" 
                                                data-toggle="modal" 
                                                data-target="#editModalIdentify_{{ $item->id }}" 
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <button class="btn btn-danger btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#hapusModalIdentify_{{ $item->id }}" 
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

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-image mr-2"></i>Brand Image</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalImage">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="swot_analize">
                            <thead class="bg-dark text-white">
                                <tr style="font-size: 0.85rem;">
                                    <th>No</th>
                                    <th>Nama</th>
                                    @if(Auth::user()->role == "admin")
                                    <th class="text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.875rem;">
                                @foreach ($image as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $item->nama_image }}</th>
                                        @if(Auth::user()->role == "admin")
                                        <th>
                                            <button class="btn btn-warning btn-sm text-white" 
                                                    data-toggle="modal" 
                                                    data-target="#editModalImage_{{ $item->id }}" 
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <button class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteModalImage_{{ $item->id }}" 
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

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-star mr-2"></i>Brand Value</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalValue">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="segmentasi">
                            <thead class="bg-dark text-white">
                                <tr style="font-size: 0.85rem;">
                                    <th>No</th>
                                    <th>Nama</th>
                                    @if(Auth::user()->role == "admin")
                                    <th class="text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.875rem;">
                                @foreach ($value as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $item->nama_value }}</th>
                                        @if(Auth::user()->role == "admin")
                                        <th>
                                            <button class="btn btn-warning btn-sm text-white" 
                                                    data-toggle="modal" 
                                                    data-target="#editModalValue_{{ $item->id }}" 
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <button class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteModalValue_{{ $item->id }}" 
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

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-users mr-2"></i>Tagline</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalTagline">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-info text-white">
                                <tr style="font-size: 0.85rem;">
                                    <th>No</th>
                                    <th>Tagline</th>
                                    <th>Hashtag</th>
                                    @if(Auth::user()->role == "admin")
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.875rem;">
                                @foreach ($tagline as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->nama_tagline }}</th>
                                    <th>{{ $item->nama_tagline }}</th>
                                    @if(Auth::user()->role == "admin")
                                    <th>
                                        <button class="btn btn-warning btn-sm text-white" 
                                                data-toggle="modal" 
                                                data-target="#editModalTagline_{{ $item->id }}" 
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <button class="btn btn-danger btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#deleteModalTagline_{{ $item->id }}" 
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

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-comments mr-2"></i>Gaya Komunikasi</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalKomunikasi">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-info text-white">
                                <tr style="font-size: 0.85rem;">
                                    <th>No</th>
                                    <th>Gaya Bicara</th>
                                    <th>Gaya Bahasa</th>
                                    @if(Auth::user()->role == "admin")
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.875rem;">
                                @foreach ($komunikasi as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $item->gaya_bicara }}</th>
                                        <th>{{ $item->gaya_bahasa }}</th>
                                        @if(Auth::user()->role == "admin")
                                        <th>
                                            <button class="btn btn-warning btn-sm text-white" 
                                                    data-toggle="modal" 
                                                    data-target="#editModalKomunikasi_{{ $item->id }}" 
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <button class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteModalKomunikasi_{{ $item->id }}" 
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

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-flask mr-2"></i>Komposisi</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalKomposisi">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-info text-white">
                                <tr style="font-size: 0.85rem;">
                                    <th class="pl-4">No</th>
                                    <th>Type</th>
                                    <th>Komposisi</th>
                                    @if(Auth::user()->role == "admin")
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.875rem;">
                                @foreach ($komposisi as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $item->type_komposisi }}</th>
                                        <th>{{ $item->komposisi }}</th>
                                        @if(Auth::user()->role == "admin")
                                        <th>
                                            <button class="btn btn-warning btn-sm text-white" 
                                                    data-toggle="modal" 
                                                    data-target="#editModalKomposisi_{{ $item->id }}" 
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <button class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteModalKomposisi_{{ $item->id }}" 
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

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-volume-up mr-2"></i>Audio Branding</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalAudio">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-info text-white">
                                <tr style="font-size: 0.85rem;">
                                    <th class="pl-4">No</th>
                                    <th>Nama</th>
                                    @if(Auth::user()->role == "admin")
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.875rem;">
                                @foreach ($audio as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $item->nama_audio }}</th>
                                        @if(Auth::user()->role == "admin")
                                        <th>
                                            <button class="btn btn-warning btn-sm text-white" 
                                                    data-toggle="modal" 
                                                    data-target="#editModalAudio_{{ $item->id }}" 
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <button class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteModalAudio_{{ $item->id }}" 
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

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-palette mr-2"></i>Moodboard</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalMoodboard">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-info text-white">
                            <tr style="font-size: 0.85rem;">
                                <th>No</th>
                                <th>Gambar</th>
                                @if(Auth::user()->role == "admin")
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($moodboard as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>
                                @if($item->moodboard)
                                    <a href="{{ asset('storage/' . $item->moodboard) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->moodboard) }}" 
                                            alt="Moodboard" 
                                            class="img-thumbnail shadow-sm" 
                                            style="width: 120px; height: 80px; object-fit: cover;">
                                    </a>
                                @else
                                    <span class="text-muted small">Tidak ada gambar</span>
                                @endif
                                </th>
                                @if(Auth::user()->role == "admin")
                                <th>
                                    <button class="btn btn-warning btn-sm text-white" 
                                            data-toggle="modal" 
                                            data-target="#editModalMoodboard_{{ $item->id }}" 
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <button class="btn btn-danger btn-sm" 
                                            data-toggle="modal" 
                                            data-target="#hapusModalMoodboard_{{ $item->id }}" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </th>
                                @endif
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-tools mr-2"></i>Alat Branding</h6>
                    @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahModalAlat">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-info text-white">
                            <tr style="font-size: 0.85rem;">
                                <th>No</th>
                                <th>Nama</th>
                                @if(Auth::user()->role == "admin")
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alat as $item)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th>{{ $item->nama_alat }}</th>
                                    @if(Auth::user()->role == "admin")
                                    <th>
                                        <button class="btn btn-warning btn-sm text-white" 
                                                data-toggle="modal" 
                                                data-target="#editModalAlat_{{ $item->id }}" 
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <button class="btn btn-danger btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#deleteModalAlat_{{ $item->id }}" 
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

@include("cms_branding.identify")
@include("cms_branding.moodboard")
@include("cms_branding.alatBranding")
@include("cms_branding.image")
@include("cms_branding.komunikasi")
@include("cms_branding.tagline")
@include("cms_branding.value")
@include("cms_branding.audio")
@include("cms_branding.komposisi")
@include('partials.footer')