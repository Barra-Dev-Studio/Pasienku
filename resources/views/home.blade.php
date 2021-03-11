@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card" id="info-totalBillings">
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
        <div class="card" id="info-totalPatients">
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
        <div class="card" id="info-totalRegistrations">
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
        <div class="card" id="info-totalItems">
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

@push('js')
<script>
    function startTour() {
        var info = new Tour({
            steps: [{
                    element: "#info-totalBillings",
                    title: "Info Total Pendapatan",
                    content: "Ini adalah informasi tentang total pendapatan yang terdata di dalam sistem"
                },
                {
                    element: "#info-totalPatients",
                    title: "Info Total Pasien",
                    content: "Ini adalah informasi tentang total pasien yang terdata di dalam sistem"
                },
                {
                    element: "#info-totalRegistrations",
                    title: "Info Total Pendaftaran",
                    content: "Ini adalah informasi tentang total registrasi pasien yang terdata di dalam sistem, baik yang sudah atau belum"
                },
                {
                    element: "#info-totalItems",
                    title: "Info Total Item",
                    content: "Ini adalah informasi tentang total item yang ada di dalam sistem, seperti obat salah satunya",
                    placement: "left",

                }
            ]
        });
        info.init();
        info.start();
        info.restart();
    }
</script>
@endpush