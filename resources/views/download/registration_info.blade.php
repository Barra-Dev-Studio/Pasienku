@extends('layouts.invoice')
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
    <td style="text-align: left;">Item</td>
    <td style="text-align: right;">Jumlah</td>
    <td style="text-align: right;">Harga</td>
    <td style="text-align: right;">Diskon</td>
    <td style="text-align: right;">Harga</td>
  </tr>
  @php $totalBilling = 0; @endphp
  @forelse($data->billing->detail as $detailBilling)
  <tr class="item">
    <td style="text-align: left">{{ $detailBilling->prescription->name }}</td>
    <td style="text-align: right">{{ $detailBilling->prescription->total }}</td>
    <td style="text-align: right">{{ number_format($detailBilling->price, 0, ',', '.') }}</td>
    <td style="text-align: right">{{ $detailBilling->discount }}</td>
    <td style="text-align: right">{{ number_format($detailBilling->prescription->total * ($detailBilling->price - ($detailBilling->price * ($detailBilling->discount / 100))), 0, ',', '.') }}</td>
  </tr>
  @php $totalBilling += ($detailBilling->prescription->total * ($detailBilling->price - ($detailBilling->price * ($detailBilling->discount / 100)))); @endphp
  @empty
  <tr class="item">
    <td colspan="5">Tidak ada data</td>
  </tr>
  @endforelse
  <tr class="heading">
    <td colspan="4">Total</td>
    <td>{{ number_format($totalBilling, 0, ',', '.') }}</td>
  </tr>
  <tr class="heading">
    <td colspan="4">Dibayarkan</td>
    <td>{{ number_format($data->billing->total_payment, 0, ',', '.') }}</td>
  </tr>
  <tr class="heading">
    <td colspan="4">Total Kembalian</td>
    <td> {{ number_format(($data->billing->total_payment - $totalBilling), 0, ',', '.') }}</td>
  </tr>
</table>
<table cellpadding="0" cellspacing="0" style="margin-top: 3em;">
  <tr class="information">
    <td colspan="2" style="text-align: right;">ttd</td>
  </tr>
  <tr class="information">
    <td colspan="2" style="text-align: right;">{{ Auth()->user()->name }}</td>
  </tr>
</table>
@endsection