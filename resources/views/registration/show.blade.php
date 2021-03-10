@extends('layouts.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
@endpush

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
                                <td>Kontak</td>
                                <td class="text-dark font-weight-semibold">{{ $detail->patient->contact }}</td>
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
                    <h4 class="card-title">Tambahkan Obat</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select name="item_select" id="item_select" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" id="free_text_button">Tambahkan Teks Kosong</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Resep Pasien</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('prescription_store') }}" method="post">
                        @csrf
                        <input type="hidden" name="registration_id" id="registration_id" value="{{ $detail->id }}">
                        <input type="hidden" name="billing_id" id="billing_id" value="{{ $detail->billing->id }}">
                        <div id="item_field">
                            @foreach($prescriptions as $prescription)
                            <div id='field-{{ $prescription->item_id }}'>
                                <div class='form-group row d-flex align-items-center'>
                                    <div class='col-md-3'>
                                        <label for='item-{{ $prescription->item_id }}'>{{ $prescription->name }}</label>
                                        <input type='hidden' name='item_id[]' id='item-{{ $prescription->item_id }}' value='{{ $prescription->item_id }}' required>
                                        <input type='hidden' name='name[]' id='item-{{ $prescription->name }}' value='{{ $prescription->name }}' required>
                                    </div>
                                    <div class='col-md-3'>
                                        <input type='text' name='use[]' id='use-{{ $prescription->item_id }}' class='form-control' placeholder='Cara penggunaan obat' value="{{ $prescription->use }}" required>
                                    </div>
                                    <div class='col-md-3'>
                                        <input type='text' name='when[]' id='when-{{ $prescription->item_id }}' class='form-control' placeholder='Waktu penggunaan obat' value="{{ $prescription->when }}" required>
                                    </div>
                                    <div class='col-md-2'>
                                        <input type='number' name='total[]' id='total-{{ $prescription->item_id }}' class='form-control' placeholder='Total obat' value="{{ $prescription->total }}" required>
                                    </div>
                                    <div class='col-md-1'>
                                        <button type='button' class='btn btn-danger btn-sm deleteButton' data-id='{{ $prescription->item_id }}'><i class='anticon anticon-delete'></i></button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan Resep</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-billing">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pembayaran atas pasien {{ $detail->patient->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_multiple_billing') }}" method="POST">
                        @csrf
                        <table class="product-info-table table">
                            <thead>
                                <th class="text-center">Nama Obat / Tindakan</th>
                                <th class="text-center" style="width: 50px;">Kuantitas</th>
                                <th class="text-center" style="width: 50px;">Harga</th>
                                <th class="text-center" style="width: 50px;">Diskon</th>
                                <th class="text-center" style="width: 50px;">Total</th>
                            </thead>
                            <tbody>
                                @php $totalBilling = 0; @endphp
                                @forelse($detail->billing->detail as $detailBilling)
                                <tr>
                                    <td>
                                        <input type="hidden" name="id[]" id="id" value="{{ $detailBilling->id }}">
                                        <input type="hidden" name="billing_id" id="billing_id" value="{{ $detail->billing->id }}">
                                        {{ $detailBilling->prescription->name }}
                                    </td>
                                    <td class="text-dark font-weight-semibold text-center">{{ $detailBilling->prescription->total }}</td>
                                    <td class="text-dark text-right">
                                        <input type="number" class="form-control text-right" value="{{ $detailBilling->price }}" name="price[]" id="price">
                                    </td>
                                    <td class="text-dark text-right">
                                        <input type="number" class="form-control text-right" value="{{ $detailBilling->discount }}" name="discount[]" id="discount">
                                    </td>
                                    <td class="text-dark font-weight-semibold text-right">{{ number_format($detailBilling->prescription->total * ($detailBilling->price - ($detailBilling->price * ($detailBilling->discount / 100)))) }}</td>
                                </tr>
                                @php $totalBilling += ($detailBilling->prescription->total * ($detailBilling->price - ($detailBilling->price * ($detailBilling->discount / 100)))); @endphp
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center font-weight-semibold" colspan="4">Total</td>
                                    <td class="text-right font-weight-semibold">
                                        <input type="hidden" name="total_price" id="total_price" value="{{ $totalBilling }}">
                                        {{ number_format($totalBilling) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary">Simpan Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#item_select').select2({
        theme: "bootstrap",
        placeholder: "Cari nama obat untuk ditambahkan",
        minimumInputLength: 2,
        templateResult: formatResultPatient,
        ajax: {
            url: "{{ route('item_list_select') }}",
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

        var template = $("<span><b>" + index.text + "</b></span><br><span>Stok: " + index.stock + "</span>");

        return template;
    }

    $("#item_select").on('change', function() {
        $.ajax({
            url: "{{ route('item_detail') }}",
            method: "POST",
            data: {
                id: $(this).val()
            },
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(response) {
                var itemField = `<div id='field-${response.id}'>
                    <div class='form-group row d-flex align-items-center'>
                        <div class='col-md-3'>
                            <label for='item-${response.id}'>${response.name}</label>
                            <input type='hidden' name='item_id[]' id='item-${response.id}' value='${response.id}' required>
                            <input type='hidden' name='name[]' id='item-${response.name}' value='${response.name}' required>
                        </div>
                        <div class='col-md-3'>
                            <input type='text' name='use[]' id='use-${response.id}' class='form-control' placeholder='Cara penggunaan obat' required>
                        </div>
                        <div class='col-md-3'>
                            <input type='text' name='when[]' id='when-${response.id}' class='form-control' placeholder='Waktu penggunaan obat' required>
                        </div>
                        <div class='col-md-2'>
                            <input type='number' name='total[]' id='total-${response.id}' class='form-control' placeholder='Total obat' required>
                        </div>
                        <div class='col-md-1'>
                            <button type='button' class='btn btn-danger btn-sm deleteButton' data-id='${response.id}'><i class='anticon anticon-delete'></i></button>
                        </div>
                    </div>
                </div>`;

                $('#item_field').append(itemField);
            }
        });
    });

    $("#free_text_button").on('click', function() {
        var itemField = `<div id='field-0'>
                <div class='form-group row d-flex align-items-center'>
                    <div class='col-md-3'>
                        <input type='hidden' name='item_id[]' id='item-id-0' value='0' required>
                        <input type='text' name='name[]' id='item-0' class='form-control' placeholder='Nama obat/ Racikan' required>
                    </div>
                    <div class='col-md-3'>
                        <input type='text' name='use[]' id='use-0' class='form-control' placeholder='Cara penggunaan obat' required>
                    </div>
                    <div class='col-md-3'>
                        <input type='text' name='when[]' id='when-0' class='form-control' placeholder='Waktu penggunaan obat' required>
                    </div>
                    <div class='col-md-2'>
                            <input type='number' name='total[]' id='total-0' class='form-control' placeholder='Total obat' required>
                        </div>
                    <div class='col-md-1'>
                        <button type='button' class='btn btn-danger btn-sm deleteButton' data-id='0'><i class='anticon anticon-delete'></i></button>
                    </div>
                </div>
            </div>`;

        $('#item_field').append(itemField);
    });

    $(document).on('click', '.deleteButton', function() {
        Swal.fire({
            title: 'Hapus obat ini dari resep?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E7472C'
        }).then((result) => {
            if (result.value) {
                $(this).parent().parent().parent().remove();
                Swal.fire({
                    title: 'Obat berhasil dihapus dari resep',
                    icon: 'success'
                });
            }
        });
    });
</script>
@endpush