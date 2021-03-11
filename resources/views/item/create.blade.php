@extends('layouts.master')
@push('css')
<link href="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('content')
@include('components.breadcrumb', ['title' => 'Item', 'lists' => ['Home' => '/', 'Item' => '/item', 'Create' => '#']])

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4>Tambahkan Item</h4>
                        <p>Di bawah ini merupakan input untuk menambahkan item.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('item_store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name item</label>
                        <input type="text" name="name" id="name" placeholder="Nama item" required class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection