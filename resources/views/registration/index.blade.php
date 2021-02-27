@extends('layouts.master')

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
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Pasien" required>
                        </div>
                        <div class="form-group">
                            <label for="identification_number">No Identifikasi (KTP/SIM/KK)</label>
                            <input type="text" name="identification_number" id="identification_number" class="form-control" placeholder="No Identifikasi (KTP/SIM/KK)" required>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" placeholder="Tanggal Lahir" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="custom-select">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat Lengkap</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Alamat Lengkap" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="diagnosis">Diagnosis Awal / Keluhan</label>
                            <textarea name="diagnosis" id="diagnosis" class="form-control" placeholder="Diagnosis Awal / Keluhan" rows="5"></textarea>
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
                        <select name="patien_id" id="patient_old_id" class="select2 form-control" placeholder="Cari nama atau No Identitas"></select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection