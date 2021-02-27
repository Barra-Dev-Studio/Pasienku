@extends('layouts.master')

@section('content')
<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">{{ $detail->patient->name }}</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-info">Informasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-diagnosis">Diagnosis</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-receipe">Resep</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-billing">Pembayaran</a>
        </li>
    </ul>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-info">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Pendaftaran</h4>
                </div>
                <div class="card-body">
                    <table class="product-info-table">
                        <tbody>
                            <tr>
                                <td>No Pendaftaran</td>
                                <td class="text-dark font-weight-semibold">{{ $detail->registration_number }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pendaftaran</td>
                                <td class="text-dark font-weight-semibold">{{ \Carbon\Carbon::parse($detail->created_at)->format('d/M/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Diagnosa Awal</td>
                                <td>{{ $detail->diagnosis }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Pasien</h4>
                </div>
                <div class="card-body">
                    <table class="product-info-table">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td class="text-dark font-weight-semibold">{{ $detail->patient->name }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Identifikasi</td>
                                <td class="text-dark font-weight-semibold">{{ $detail->patient->identification_number }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>{{ \Carbon\Carbon::parse($detail->patient->birthdate)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>{{ $detail->patient->gender }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>{{ $detail->patient->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-diagnosis">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Diagnosa Awal / Keluhan</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea name="diagnosis" id="diagnosis" rows="5" class="form-control readonly" readonly>{{ $detail->diagnosis }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Pemeriksaan</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('diagnosis_store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="registration_id" value="{{ $detail->id }}">
                        <div class="form-group">
                            <label for="blood_pressure">Tekanan Darah</label>
                            <input type="text" name="blood_pressure" id="blood_pressure" class="form-control" placeholder="Contoh 120/80" value="{{ $detail->diagnose->blood_pressure ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="further_diagnosis">Pemeriksaan Lanjutan</label>
                            <textarea name="further_diagnosis" id="further_diagnosis" rows="5" class="form-control" placeholder="Deskripsikan pemeriksaan lanjutan pasien">{{ $detail->diagnose->further_diagnosis ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-receipe">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Resep</h4>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-billing">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Billing</h4>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection