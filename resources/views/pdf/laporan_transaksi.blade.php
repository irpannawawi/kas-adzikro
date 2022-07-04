<html>
<head>
    <style>
        h3, p{
          font-family: sans-serif;
          margin: 5px;
      }
      
      table {
          font-family: Arial, Helvetica, sans-serif;
          color:black;
          background: #eaebec;
          border: black 2px solid;
          margin: 0px auto;
          font-size: 12px;
          width: 100%;
      }
      
      table th {
          padding: 8px;
          border-left:1px solid black;
          border-bottom: 1px solid black;

          background: #808080; 
      }
      
      table th:first-child{  
          border-left:none;  
      }
      
      table tr {
          text-align: left;
      }
      
      table td:first-child {
          text-align: left;
          border-left: 0;

      }
      
      table td {
          padding: 6px;
          border: 1px solid black;
          background: white;
      }
      
      table tr:last-child td {
          border-bottom: 0;
      }
      
.text-danger{
  color:  red;
}      
.text-success{
  color:  green;
}
.text-right{
  text-align: right;
}
.text-left{
  text-align: left;
}

  </style>
</head>
<body>
    <h3 align="center">
    @if (isset($title))
      {{$title}}
    @else
    Laporan Transaksi
    @endif
    </h3>
    <p align="center">{{$tgl}}</p>
     <table class="table table-sm table-bordered table-striped" cellspacing="0">
          <tr class="bg-dark text-center" style="color:white;">
            <th>No</th>
            <th>Nama/Kontak</th>
            @if (!isset($title))
            <th>Barang/Jasa</th>
            @elseif ($title == 'Laporan Pemasukan')
            <th>Barang/Jasa</th>
            @endif
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Nominal</th>
          </tr>
          @php 
            $n=1;
            $jumlah=0;
          @endphp
          @foreach ($transaksi as $tr)
          <tr>
            <td>{{ $n++ }}</td>
            <td>{{ $tr->kontak->nama_kontak }} ({{$tr->prson->nama_level}})</td>
            @if (!isset($title))
            <td>
              @if ($tr->produk)
                {{ $tr->produk->nama_produk }}
              @endif
            </td>
            @elseif ($title == 'Laporan Pemasukan')
            <td>
              @if ($tr->produk)
                {{ $tr->produk->nama_produk }}
              @endif
            </td>
            @endif
            <td>{{ $tr->keterangan }}</td>
            <td class="text-center">{{ $tr->tanggal }}</td>
            <td class="{{$tr->tipe=='masuk'?'text-success text-left':'text-danger text-right'}}" nowrap>Rp. {{ number_format($tr->nominal,0,'.',',') }},-</td>
          </tr>
          @php
          if($tr->tipe == 'masuk')
          {
            $jumlah += $tr->nominal;
          }else{
            $jumlah -= $tr->nominal;
          }
          @endphp
          @endforeach
          <tr style="color:white;">
            <th colspan="{{!isset($title) || $title == 'Laporan Pemasukan'?5:4;}}">Total</th>
            <th nowrap>Rp. {{ number_format($jumlah,0,'.',',') }},-</th>
          </tr>
        </table><br>
        <br>

        <p class="text-right" style="font-size:12px;">Karawang, {{date('d M Y')}}<br>{{Str::ucfirst(Auth::user()->level)}}
        <br>
        <br>
        <br>
        <br>
        {{Str::ucfirst(Auth::user()->nama)}}
      </p>
</body>
</html> 