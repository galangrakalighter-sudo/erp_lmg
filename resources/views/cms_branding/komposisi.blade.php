    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="tambahModalKomposisi" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                
                {{-- MODAL HEADER --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tambahModalLabel">
                        <i class="fas fa-chart-pie mr-2"></i> Tambah Komposisi
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('komposisi.store') }}" method="POST">
                    @csrf

                    {{-- MODAL BODY --}}
                    <div class="modal-body p-4">
                        <div class="row">
                            {{-- Field Produk --}}
                            <input type="hidden" name="produk" value="{{ $produk->id }}">

                            {{-- Field Nama Analisis --}}
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-bold text-dark">Type</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-edit text-primary"></i></span>
                                    </div>
                                    <input type="text" name="type" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="font-weight-bold text-dark">Komposisi</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-edit text-primary"></i></span>
                                    </div>
                                    <input type="text" name="komposisi" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Tip/Informasi Singkat (Opsional) --}}
                        <div class="alert alert-info py-2 mb-0 mt-2">
                            <small><i class="fas fa-info-circle mr-1"></i> Harap Periksa Kembali Inputannya</small>
                        </div>
                    </div>

                    {{-- MODAL FOOTER --}}
                    <div class="modal-footer bg-light border-top-0">
                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-save mr-1"></i> Simpan Analisis
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @foreach ($komposisi as $item)
        {{-- MODAL EDIT ANALISIS --}}
        <div class="modal fade" id="editModalKomposisi_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0 shadow-lg">
                    
                    {{-- MODAL HEADER (Warna Warning untuk Edit) --}}
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="editModalLabel_{{ $item->id }}">
                            <i class="fas fa-edit mr-2"></i> Edit Komposisi: {{ $item->nama }}
                        </h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{-- Sesuaikan route update Anda di sini --}}
                    <form action="{{ route('komposisi.update', $item->id) }}" method="POST">
                        @csrf

                        {{-- MODAL BODY --}}
                        <div class="modal-body p-4">
                            <div class="row">
                                {{-- Field Produk (Pre-selected) --}}
                                <input type="hidden" name="produk" value="{{ $produk->id }}">

                                {{-- Field Nama Brand Image (Pre-filled) --}}
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold text-dark">Type</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-pen-alt text-warning"></i></span>
                                        </div>
                                        <input type="text" name="type" class="form-control" value="{{ $item->type_komposisi }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold text-dark">Komposisi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fas fa-pen-alt text-warning"></i></span>
                                        </div>
                                        <input type="text" name="komposisi" class="form-control" value="{{ $item->komposisi }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Log Aktivitas/Catatan --}}
                            <div class="alert alert-warning py-2 mb-0 mt-2 border-0" style="opacity: 0.8;">
                                <small class="text-dark"><i class="fas fa-exclamation-triangle mr-1"></i> Tidak perlu menambahkan "#" diawal inputan hashtag</small>
                            </div>
                        </div>

                        {{-- MODAL FOOTER --}}
                        <div class="modal-footer bg-light border-top-0">
                            <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-warning px-4 shadow-sm font-weight-bold">
                                <i class="fas fa-sync-alt mr-1"></i> Update Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModalKomposisi_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel_{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 shadow-lg">
                    
                    {{-- MODAL HEADER (Warna Danger untuk Hapus) --}}
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel_{{ $item->id }}">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{-- Sesuaikan route delete Anda di sini --}}
                    <form action="{{ route('komposisi.destroy', $item->id) }}" method="POST">
                        @csrf

                        {{-- MODAL BODY --}}
                        <div class="modal-body p-4 text-center">
                            {{-- Icon Animasi atau Static untuk mempertegas --}}
                            <div class="text-danger mb-3">
                                <i class="fas fa-trash-alt fa-4x"></i>
                            </div>
                            
                            <h5 class="text-dark font-weight-bold">Apakah Anda yakin?</h5>
                            <p class="text-muted">
                                Komposisi <strong>"{{ $item->komposisi }}"</strong> akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>

                        {{-- MODAL FOOTER --}}
                        <div class="modal-footer bg-light border-top-0 justify-content-center">
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-danger px-4 shadow-sm font-weight-bold">
                                Ya, Hapus Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endforeach
