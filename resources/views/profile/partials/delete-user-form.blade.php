<section>
    <p class="text-muted small mb-3">
        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
    </p>

    <!-- Trigger Modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        <i class="ti ti-trash me-1"></i> Hapus Akun
    </button>

    <!-- Bootstrap Modal -->
    <div class="modal fade @if($errors->userDeletion->isNotEmpty()) show d-block @endif" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true" @if($errors->userDeletion->isNotEmpty()) style="background: rgba(0,0,0,0.5);" @endif>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title text-danger fw-bold" id="confirmUserDeletionModalLabel">
                            <i class="ti ti-alert-triangle me-2"></i>Apakah Anda yakin ingin menghapus akun?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="document.getElementById('confirmUserDeletionModal').classList.remove('show','d-block');"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small mb-3">
                            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label fw-semibold">Kata Sandi</label>
                            <input type="password" id="delete_password" name="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Masukkan kata sandi untuk konfirmasi" required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="document.getElementById('confirmUserDeletionModal').classList.remove('show','d-block');">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="ti ti-trash me-1"></i> Hapus Akun Permanen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

