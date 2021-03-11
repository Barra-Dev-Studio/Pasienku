@extends('layouts.master')
@push('css')
<link href="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('components.breadcrumb', ['title' => 'Kelola Pasien', 'lists' => ['Home' => '/', 'Pasien' => '#']])

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4>List Pasien</h4>
                        <p>Di bawah ini merupakan list pasien yang terdaftar di dalam sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No. Identifikasi</th>
                            <th>Kontak</th>
                            <th style="width: 10px; text-align: center"><i class='anticon anticon-setting'></i></th>
                        </thead>
                    </table>
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
                url: "{{ route('patient_data_list') }}",
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
                    data: 'name',
                },
                {
                    data: 'identification_number',
                },
                {
                    data: 'contact',
                },
                {
                    data: 'action'
                }
            ]
        });
    })
</script>
@endpush