@extends('layouts.master')

@section('content')
<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">Setting</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-account">Account</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-network">Network</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-notification">Notification</a>
        </li> -->
    </ul>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-account">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Upload Foto Profil</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('save_photo_profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*" hidden>
                        <div class="media align-items-center">
                            <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                                <img src="{{ (Auth()->user()->pic != null) ? 'profile/' . Auth()->user()->pic : 'https://ui-avatars.com/api/?background=random&name=' . Str::slug(Auth()->user()->name) }}" alt="{{ Auth()->user()->name }}" id="openphoto">
                            </div>
                            <div class="m-l-20 m-r-20">
                                <h5 class="m-b-5 font-size-18">Ubah Foto Profil</h5>
                                <p class="opacity-07 font-size-13 m-b-0">
                                    Rekomendasi: <br>
                                    120x120px Max fil size: 1MB
                                </p>
                            </div>
                            <div>
                                <button class="btn btn-tone btn-primary">Upload</button>
                            </div>
                        </div>
                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-account">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Umum</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('save_user') }}" method="POST">
                        @csrf
                        <div class="form-row align-items-end">
                            <div class="form-group col-md-5">
                                <label class="font-weight-semibold" for="name">Nama lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="User Name" value="{{ Auth()->user()->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <label class="font-weight-semibold" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="email" value="{{ Auth()->user()->email }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-block btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-account">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sunting Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('save_password') }}" method="POST">
                        @csrf
                        <div class="form-row align-items-end">
                            <div class="form-group col-md-4">
                                <label class="font-weight-semibold" for="old_password">Password lama</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password" placeholder="Password lama">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="font-weight-semibold" for="new_password">Password baru</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="Password baru">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="font-weight-semibold" for="confirm_password">Konfirmasi password</label>
                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password">
                            </div>
                            <div class="form-group col-md-2 ml-auto">
                                <button class="btn btn-block btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $('#openphoto').click(function() {
        $('#photo').trigger('click');
    });

    $('#photo').on('change', function() {
        setImagePreview(this);
    });

    function setImagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#openphoto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush