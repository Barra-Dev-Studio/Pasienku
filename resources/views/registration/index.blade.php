@extends('layouts.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">Pendaftaran</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-new">Pasien Baru</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-old">Pasien Lama</a>
        </li>
    </ul>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-new">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4>Pasien Baru</h4>
                            <p>Lakukan pendaftaran dengan mendaftarkan pasien baru</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lengkapi data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('register_new_patient') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Pasien</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pasien" required value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="identification_number">No Identifikasi (KTP/SIM/KK)</label>
                            <input type="text" name="identification_number" id="identification_number" class="form-control @error('identification_number') is-invalid @enderror" placeholder="No Identifikasi (KTP/SIM/KK)" required value="{{ old('identification_number') }}">
                            @error('identification_number')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control @error('birthdate') is-invalid @enderror" placeholder="Tanggal Lahir" value="{{ date('Y-m-d') }}" required value="{{ old('birthdate') }}">
                            @error('birthdate')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="custom-select @error('gender') is-invalid @enderror">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat Lengkap</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat Lengkap" rows="5">{{ old('address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="diagnosis">Diagnosis Awal / Keluhan</label>
                            <textarea name="diagnosis" id="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" placeholder="Diagnosis Awal / Keluhan" rows="5">{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Daftarkan Pasien</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-old">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4>Pasien Lama</h4>
                            <p>Gunakan pencarian di bawah ini untuk mencari pasien terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cari pasien terdaftar</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select name="patien_id" id="patient_select" class="form-control" placeholder="Cari nama atau No Identitas"></select>
                    </div>
                    <form action="{{ route('register_old_patient') }}" method="POST" id="oldPatientForm" style="display: none;">
                        @csrf
                        <input type="hidden" name="id" id="patient_old_id" value="{{ old('id') }}">
                        <div class="form-group">
                            <table class="product-info-table">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td class="text-dark font-weight-semibold" id="search_result_name"></td>
                                    </tr>
                                    <tr>
                                        <td>No Identifikasi</td>
                                        <td class="text-dark font-weight-semibold" id="search_result_identification_number"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td id="search_result_birthdate"></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td id="search_result_gender"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td id="search_result_address"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="diagnosis">Diagnosis Awal / Keluhan</label>
                            <textarea name="diagnosis" id="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" placeholder="Diagnosis Awal / Keluhan" rows="5">{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        @error('id')
                        <div class="form-group">
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                        <div class="form-group">
                            <button class="btn btn-primary">Daftarkan Pasien</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- <script src="{{ url('assets/js/oldRegistration.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#patient_select').select2({
            theme: "bootstrap",
            placeholder: "Cari nama pasien atau no identifikasi",
            minimumInputLength: 2,
            templateResult: formatResultPatient,
            ajax: {
                url: "{{ route('patient_list') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
            }
        });

        function formatResultPatient(index) {
            if (!index.id) return index.text;

            var template = $("<span><b>" + index.text + "</b></span><br><span>" + index.identification_number + "</span>");

            return template;
        }

        $('#patient_select').on('change', function() {
            $.ajax({
                url: "{{ route('patient_get') }}",
                method: 'POST',
                data: {
                    id: $(this).val()
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#search_result_name').html(response.name);
                    $('#search_result_identification_number').html(response.identification_number);
                    $('#search_result_gender').html(response.gender);
                    $('#search_result_birthdate').html(response.birthdate);
                    $('#search_result_address').html(response.address);
                    $('#patient_old_id').val('');
                    $('#patient_old_id').val(response.id);
                    $('#oldPatientForm').show();
                }
            });
        })
    })
</script>
@endpush