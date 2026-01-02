
    <div class="modal fade" id="tambahModalPosition" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tambahModalLabel">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Positioning
                    </h5>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>

                <form action="{{ route('positioning_create') }}" method="POST">
                    @csrf

                    <div class="modal-body p-4">
                        <div class="row">
                            <input type="hidden" name="produk" value="{{ $produk->id }}">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark">Indikator</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-tag text-muted"></i></span>
                                    <input type="text" name="indikator" class="form-control bg-light border-start-0 shadow-none">
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label fw-bold text-dark">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control bg-light shadow-none" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light border-top-0 px-4">
                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @foreach ($data['data'][2] as $item)
        {{-- Modal Edit --}}
        <div class="modal fade" id="editModalPosition_{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel_{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    
                    <form action="{{ route('positioning_edit', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title fw-bold" id="editModalLabel_{{ $item->id }}">
                                <i class="fas fa-edit me-2"></i> Edit Positioning
                            </h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-4">
                            <div class="row">
                                <input type="hidden" name="produk" value="{{ $produk->id }}">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Indikator</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-tag text-muted"></i></span>
                                        <input type="text" name="indikator" class="form-control bg-light border-start-0 shadow-none" 
                                            value="{{ $item->indikator }}" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-2">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control bg-light shadow-none" rows="6">{{ $item->deskripsi }}</textarea>
                                    <small class="text-muted mt-1 d-block italic">*Pastikan deskripsi sudah sesuai dengan perubahan terbaru.</small>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer bg-light border-top-0 px-4">
                            <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning px-4 shadow-sm fw-bold">
                                <i class="fas fa-sync-alt me-1"></i> Update Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- Modal Hapus --}}
        <div class="modal fade" id="deleteModalPosition_{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <form action="{{ route('positioning_delete', $item->id) }}" method="POST">
                        @csrf
                        {{-- HEADER --}}
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Hapus Body</h5>
                            <button type="button" class="close text-white" data-dismiss="modal">
                                &times;
                            </button>
                        </div>

                        {{-- BODY --}}
                        <div class="modal-body text-center">
                            <p class="mb-2">
                                Apakah kamu yakin ingin menghapus
                            </p>
                            <strong>{{ $item->indikator }}</strong>?
                            <p class="text-muted mt-2">
                                Data yang dihapus tidak dapat dikembalikan.
                            </p>
                        </div>

                        {{-- FOOTER --}}
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-secondary" data-dismiss="modal">
                                Batal
                            </button>
                            <button class="btn btn-danger">
                                Ya, Hapus
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach
