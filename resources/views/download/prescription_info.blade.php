@extends('layouts.prescription')
@section('title') {{ $data->registration_number }} @endsection
@section('registration_number'){{ $data->registration_number }}@endsection

@section('content')
<table cellpadding="0" cellspacing="0">
    <tr class="information">
        <td colspan="2">
            <table>
                <tr>
                    <td>
                        {{ $data->patient->address }}
                    </td>

                    <td>
                        {{ (strtolower($data->patient->gender) == 'laki-laki') ? 'Tn.' : 'Ny.' }}<br>
                        {{ $data->patient->name }}<br>
                        {{ $data->patient->contact }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0">
    <tr class="heading">
        <td style="text-align: left;">Nama Obat</td>
        <td style="text-align: left;">Penggunaan</td>
        <td style="text-align: left;">Waktu Penggunaan</td>
    </tr>
    @forelse($data->billing->detail as $detailBilling)
    <tr class="item">
        <td style="text-align: left" valign='top'>{{ $detailBilling->prescription->name }}</td>
        <td style="text-align: left" valign='top'>{{ $detailBilling->prescription->use }}</td>
        <td style="text-align: left" valign='top'>{{ $detailBilling->prescription->when }}</td>
    </tr>
    @empty
    <tr class="item">
        <td colspan="3">Tidak ada data</td>
    </tr>
    @endforelse
</table>
@endsection