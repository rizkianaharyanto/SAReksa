@extends('pembelian.template.table')

@section('judul', 'Jurnal Khusus Pembelian')

@section('halaman', 'Jurnal Khusus Pembelian')

@section('thead')
<tr>
    <th>No. Transaksi</th>
    <th>Akun</th>
    <th>Debit</th>
    <th>Kredit</th>
    <!-- <th style="column-width: 80px">Aksi</th> -->
</tr>
@endsection

@section('tbody')
@foreach ($jurnals as $jurnal)
<tr>
    <td>
        @if ($jurnal->penerimaan_id !=null){{$jurnal->penerimaan->kode_penerimaan}}
        @elseif ($jurnal->faktur_id !=null){{$jurnal->faktur->kode_faktur}}
        @elseif ($jurnal->retur_id !=null){{$jurnal->retur->kode_retur}}
        @else -
        @endif
    </td>
    <td>
        @if ($jurnal->akun_id == 1) barang
        @elseif ($jurnal->akun_id == 2) barang belum ditagih
        @else -
        @endif
    </td>
    <td>{{ $jurnal->debit }}</td>
    <td>{{ $jurnal->kredit }}</td>
    <!-- <td class="d-flex justify-content-between">
        <i onclick="" class="fas fa-info-circle"></i>
        <i onclick="" class="fas fa-edit"></i>
        <i onclick="" class="fas fa-trash"></i>
    </td> -->
</tr>
@endforeach
@endsection