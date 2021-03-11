@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-green">
                        <i class="anticon anticon-dollar"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">Rp{{ number_format($totalBillings) }}</h2>
                        <p class="m-b-0 text-muted">Total Pendapatan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-team"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ number_format($totalPatients) }}</h2>
                        <p class="m-b-0 text-muted">Total Pasien</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-red">
                        <i class="anticon anticon-form"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ number_format($totalRegistrations) }}</h2>
                        <p class="m-b-0 text-muted">Total Pendaftaran</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-inbox"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ number_format($totalItems) }}</h2>
                        <p class="m-b-0 text-muted">Total Obat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection