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
          border: black 1px solid;
          margin: 0px auto;
          font-size: 12px;
          width: 100%;
      }
      
      table th {
          padding: 8px;
          text-align: center;
          border: black 1px solid;

      }
      

      
      table tr {
          text-align: left;
      }
      
      table td:first-child {
          text-align: left;


      }
      
      table td {
          background: white;
          border: black 1px solid;
      }
      
      table tr:last-child td {
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
    <h3 align="center">Jurnal Umum</h3><p align="center">{{$tgl}}</p>
             <table cellspacing="0">
          <tr class="bg-dark text-center">
            <th>Tgl</th>
            <th>Ket/Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
          </tr>
          @foreach ($transaksi as $tr)
          <tr>
            <td width="13%" rowspan="{{$tr->jurnal->count()+1}}" style="vertical-align: top; padding: 8px">{{ $tr->tanggal }}</td>
            <th colspan="3" class="text-left">{{ $tr->keterangan }}</th>
          </tr>
            @foreach ($tr->jurnal as $jr)
            <tr>
              <td style="padding-left: 30px;">{{ $jr->kode_akun.' '.$jr->akun->nama_akun }}</td>
              <td class="text-right">{{ $jr->debit<1?'':'Rp. '.number_format($jr->debit,0,'.',',').',-' }}</td>
              <td class="text-right">{{ $jr->kredit<1?'':'Rp. '.number_format($jr->kredit,0,'.',',').',-' }}</td>
            </tr>
            @endforeach
          @endforeach
          
          
        </table><br>
        <br>
        <p class="text-right" style="font-size:12px;">Karawang, {{date('d M Y')}}<br>{{Str::ucfirst(Auth::user()->level)}}

        <br>
        <br>
        <br>
        <br>
        {{Str::ucfirst(Auth::user()->level)}}
      </p>
</body>
</html> 