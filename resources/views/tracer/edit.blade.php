@extends('layouts.app')

@section('title', 'Edit Tracer Study')

@section('content')
<h4 class="mb-4">Edit Tracer Study</h4>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('tracer.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label fw-bold">Status Sekarang</label>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="form-check card py-3 px-3 border rounded cursor-pointer status-option" data-status="working">
                            <input class="form-check-input" type="radio" name="status" id="status_working"
                                   value="working" {{ old('status', $tracer->status ?? '') == 'working' ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="status_working">
                                <i class="bi bi-briefcase d-block fs-4 mb-1"></i>
                                Bekerja
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check card py-3 px-3 border rounded cursor-pointer status-option" data-status="studying">
                            <input class="form-check-input" type="radio" name="status" id="status_studying"
                                   value="studying" {{ old('status', $tracer->status ?? '') == 'studying' ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="status_studying">
                                <i class="bi bi-book d-block fs-4 mb-1"></i>
                                Melanjutkan Studi
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check card py-3 px-3 border rounded cursor-pointer status-option" data-status="entrepreneur">
                            <input class="form-check-input" type="radio" name="status" id="status_entrepreneur"
                                   value="entrepreneur" {{ old('status', $tracer->status ?? '') == 'entrepreneur' ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="status_entrepreneur">
                                <i class="bi bi-shop d-block fs-4 mb-1"></i>
                                Wirausaha
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check card py-3 px-3 border rounded cursor-pointer status-option" data-status="unemployed">
                            <input class="form-check-input" type="radio" name="status" id="status_unemployed"
                                   value="unemployed" {{ old('status', $tracer->status ?? '') == 'unemployed' ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="status_unemployed">
                                <i class="bi bi-search d-block fs-4 mb-1"></i>
                                Belum Bekerja
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="working-fields" class="status-fields" style="display: none;">
                <h5 class="mb-3"><i class="bi bi-briefcase me-2"></i>Data Pekerjaan</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="company_name" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="company_name" name="company_name"
                               value="{{ old('company_name', $tracer->company_name ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="job_position" class="form-label">Posisi/Jabatan</label>
                        <input type="text" class="form-control" id="job_position" name="job_position"
                               value="{{ old('job_position', $tracer->job_position ?? '') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Gaji per Bulan (Rp)</label>
                    <input type="number" class="form-control" id="salary" name="salary" min="0"
                           value="{{ old('salary', $tracer->salary ?? '') }}">
                </div>
            </div>

            <div id="studying-fields" class="status-fields" style="display: none;">
                <h5 class="mb-3"><i class="bi bi-book me-2"></i>Data Pendidikan</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="university_name" class="form-label">Nama Universitas</label>
                        <input type="text" class="form-control" id="university_name" name="university_name"
                               value="{{ old('university_name', $tracer->university_name ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="study_major" class="form-label">Jurusan Kuliah</label>
                        <input type="text" class="form-control" id="study_major" name="study_major"
                               value="{{ old('study_major', $tracer->study_major ?? '') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Jenjang Pendidikan</label>
                    <select class="form-select" id="level" name="level">
                        <option value="">Pilih Jenjang</option>
                        <option value="D3" {{ old('level', $tracer->level ?? '') == 'D3' ? 'selected' : '' }}>D3 (Diploma)</option>
                        <option value="S1" {{ old('level', $tracer->level ?? '') == 'S1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                        <option value="S2" {{ old('level', $tracer->level ?? '') == 'S2' ? 'selected' : '' }}>S2 (Magister)</option>
                        <option value="S3" {{ old('level', $tracer->level ?? '') == 'S3' ? 'selected' : '' }}>S3 (Doktor)</option>
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <h5 class="mb-3"><i class="bi bi-graph-up me-2"></i>Informasi Pekerjaan</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="waiting_time" class="form-label">Waktu Tunggu Kerja/Studi (Bulan)</label>
                    <input type="number" class="form-control @error('waiting_time') is-invalid @enderror"
                           id="waiting_time" name="waiting_time" min="0"
                           value="{{ old('waiting_time', $tracer->waiting_time ?? '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="job_relevance" class="form-label">Relevansi Pekerjaan (1-5)</label>
                    <select class="form-select @error('job_relevance') is-invalid @enderror"
                            id="job_relevance" name="job_relevance" required>
                        <option value="">Pilih Skala</option>
                        <option value="1" {{ old('job_relevance', $tracer->job_relevance ?? '') == '1' ? 'selected' : '' }}>1 - Sama sekali Tidak Relevan</option>
                        <option value="2" {{ old('job_relevance', $tracer->job_relevance ?? '') == '2' ? 'selected' : '' }}>2 - Kurang Relevan</option>
                        <option value="3" {{ old('job_relevance', $tracer->job_relevance ?? '') == '3' ? 'selected' : '' }}>3 - Cukup Relevan</option>
                        <option value="4" {{ old('job_relevance', $tracer->job_relevance ?? '') == '4' ? 'selected' : '' }}>4 - Relevan</option>
                        <option value="5" {{ old('job_relevance', $tracer->job_relevance ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Relevan</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label for="feedback" class="form-label">Feedback/Saran untuk Sekolah</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="4"
                          placeholder="Tuliskan pendapat Anda tentang sekolah...">{{ old('feedback', $tracer->feedback ?? '') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('alumni.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<style>
.cursor-pointer { cursor: pointer; }
.status-option:hover { background-color: #f8f9fa; }
.status-option input:checked + label { color: #0d6efd; }
.form-check-input:checked + .status-option { border-color: #0d6efd; background-color: #e7f1ff; }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusRadios = document.querySelectorAll('input[name="status"]');
    const workingFields = document.getElementById('working-fields');
    const studyingFields = document.getElementById('studying-fields');

    function toggleFields() {
        let selectedStatus = document.querySelector('input[name="status"]:checked')?.value;

        workingFields.style.display = 'none';
        studyingFields.style.display = 'none';

        if (selectedStatus === 'working') {
            workingFields.style.display = 'block';
        } else if (selectedStatus === 'studying') {
            studyingFields.style.display = 'block';
        }
    }

    statusRadios.forEach(radio => {
        radio.addEventListener('change', toggleFields);
    });

    toggleFields();
});
</script>
@endpush
@endsection