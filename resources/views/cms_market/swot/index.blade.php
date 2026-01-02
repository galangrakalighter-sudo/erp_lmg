
    <div class="modal fade" id="tambahModalSWOT" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                <div class="modal-header bg-primary text-white" style="border-radius: 1rem 1rem 0 0;">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-chart-pie mr-2"></i>Tambah Analisis SWOT
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('analize_swot_create') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <input type="hidden" name="produk" value="{{ $produk->id }}">

                        <div class="row font-weight-bold">
                            <div class="col-md-6 border-right">
                                <div class="form-group">
                                    <label class="text-success"><i class="fas fa-plus-circle mr-1"></i> Strength</label>
                                    <textarea name="strenght" class="form-control border-success" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-warning"><i class="fas fa-lightbulb mr-1"></i> Opportunity</label>
                                    <textarea name="oportunity" class="form-control border-warning" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-danger"><i class="fas fa-minus-circle mr-1"></i> Weakness</label>
                                    <textarea name="weakness" class="form-control border-danger" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-dark"><i class="fas fa-exclamation-triangle mr-1"></i> Threat</label>
                                    <textarea name="threat" class="form-control border-dark" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light" style="border-radius: 0 0 1rem 1rem;">
                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-save mr-1"></i> Simpan Analisis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @foreach ($data['data'][1] as $item)
    <div class="modal fade" id="editModalSWOT_{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                <div class="modal-header bg-info text-white" style="border-radius: 1rem 1rem 0 0;">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>Edit Analisis SWOT
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('analize_swot_edit', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <input type="hidden" name="produk" value="{{ $produk->id }}">

                        <div class="row">
                            <div class="col-md-6 border-right font-weight-bold">
                                <div class="form-group">
                                    <label class="text-success">Strength</label>
                                    <textarea name="strenght" class="form-control border-success" rows="2">{{ $item->strenght }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-warning">Opportunity</label>
                                    <textarea name="oportunity" class="form-control border-warning" rows="2">{{ $item->oportunity }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 font-weight-bold">
                                <div class="form-group">
                                    <label class="text-danger">Weakness</label>
                                    <textarea name="weakness" class="form-control border-danger" rows="2">{{ $item->weakness }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-dark">Threat</label>
                                    <textarea name="threat" class="form-control border-dark" rows="2">{{ $item->threat }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light" style="border-radius: 0 0 1rem 1rem;">
                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info px-4 text-white shadow-sm">
                            <i class="fas fa-sync-alt mr-1"></i> Update Analisis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModalSWOT_{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <form action="{{ route('analize_swot_delete', $item->id) }}" method="POST">
                    @csrf

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus SWOT</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            &times;
                        </button>
                    </div>

                    <div class="modal-body text-center">
                        <p class="mb-2">
                            Apakah kamu yakin ingin menghapus SWOT
                        </p>
                        <strong>{{ $item->nama }}</strong>?
                        <p class="text-muted mt-2">
                            Data yang dihapus tidak dapat dikembalikan.
                        </p>
                    </div>

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
