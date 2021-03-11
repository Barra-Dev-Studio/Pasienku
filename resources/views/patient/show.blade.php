@extends('layouts.master')
@push('css')
<link href="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">{{ $detail->name }}</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-detail">Detail</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-history">Riwayat Diagnosa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-edit">Edit Pasien</a>
        </li>
    </ul>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-detail">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail</h4>
                </div>
                <div class="card-body">
                    <table class="product-info-table">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td class="text-dark font-weight-semibold">{{ $detail->name }}</td>
                            </tr>
                            <tr>
                                <td>No. Identifikasi</td>
                                <td>{{ $detail->identification_number }}</td>
                            </tr>
                            <tr>
                                <td>Kontak</td>
                                <td>{{ $detail->contact }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>{{ \Carbon\Carbon::parse($detail->birthdate)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>{{ $detail->gender }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>{{ $detail->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-history">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4>Riwayat Diagnosa</h4>
                            <p>Di bawah ini merupakan list riwayat diagnosa pasien melalui pendaftaran.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Riwayat Diagnosa</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="datatable" width="100%">
                            <thead>
                                <th>No</th>
                                <th>Tanggal Pendaftaram</th>
                                <th>No. Registrasi</th>
                                <th style="width: 10px; text-align: center"><i class='anticon anticon-setting'></i></th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-edit">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Pasien</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('patient_update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $detail->id }}">
                        <div class="form-group">
                            <label for="name">Nama item</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama pasien" value="{{ $detail->name }}" required>
                            @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="identification_number">No KTP/SIM/KK</label>
                            <input type="text" name="identification_number" id="identification_number" class="form-control @error('identification_number') is-invalid @enderror" placeholder="No KTP/SIM/KK" value="{{ $detail->identification_number }}" required>
                            @error('identification_number')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact">Kontak</label>
                            <input type="text" name="contact" id="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="Email/No Hp" value="{{ $detail->contact }}" required>
                            @error('contact')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control @error('birthdate') is-invalid @enderror" placeholder="Email/No Hp" value="{{ $detail->birthdate }}" required>
                            @error('birthdate')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="custom-select" required>
                                <option value="Laki-laki" @if($detail->gender == 'Laki-laki') selected='selected' @endif>Laki-laki</option>
                                <option value="Perempuan" @if($detail->gender == 'Perempuan') selected='selected' @endif>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" rows="5" class="form-control @error('address') is-invalid @enderror" required>{{ $detail->address }}</textarea>
                            @error('address')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ url('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            paginate: true,
            info: true,
            sort: true,
            processing: true,
            serverSide: true,
            order: [1, 'ASC'],
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ route('register_history') }}",
                data: {
                    id: "{{ $detail->id }}"
                },
                method: 'POST'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                    width: '10px'

                },
                {
                    data: 'date',
                },
                {
                    data: 'registration_number',
                },
                {
                    data: 'action',
                    class: 'text-center',
                    width: '10px'
                }
            ]
        });
    })
</script>
@endpush