<div class="container-fluid mt-4">
    <div class="modal fade" id="tambahModalAnalyze4P" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-plus-circle mr-2"></i>Tambah Analisis 4P
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('analize_4p_create') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <input type="hidden" name="produk" value="{{ $produk->id }}">
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Analisis</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" name="nama" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Type</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fas fa-layer-group"></i></span>
                                </div>
                                <input type="text" name="type" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-save mr-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($data['data'][0] as $item)
    {{-- Modal Edit --}}
    <div class="modal fade" id="editModalAnalyze4P_{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>Edit Analisis 4P
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('analize_4p_edit', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <input type="hidden" name="produk" value="{{ $produk->id }}">
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Jenis Body</label>
                            <input type="text" name="nama" class="form-control border-info" value="{{ $item->nama_analisis }}">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Type</label>
                            <input type="text" name="type" class="form-control border-info" value="{{ $item->type }}">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info px-4 text-white shadow-sm">
                            <i class="fas fa-sync-alt mr-1"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="deleteModalAnalyze4P_{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <form action="{{ route('analize_4p_delete', $item->id) }}" method="POST">
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
                        <strong>{{ $item->nama_analisis }}</strong>?
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
</div>