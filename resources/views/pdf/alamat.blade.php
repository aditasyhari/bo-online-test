<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Alamat</title>

    <style>
        .box {
            padding: 4px 0;
            text-align: center;
            align-items: center;
            width: 48%;
            min-height: 150px;
            border: 2px solid black;
            border-radius: 10px;
            margin-bottom: 8px;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }
    </style>
</head>
<body>
    @if(count($list) > 0)
        @foreach($list as $key => $value)
            @if(($key+1)%2 == 1)
                <div class="box left">
                    <h4>{{$value->nama}}<br>{{$value->wa}}</h4>
                    <p>{{$value->alamat}}</p>
                    <h5>KEC. {{$value->nama_kecamatan}} - KAB. {{$value->kotakab}} - PROV. {{$value->nama_propinsi}}</h5>
                </div>
            @else
                <div class="box right">
                    <h4>{{$value->nama}}<br>{{$value->wa}}</h4>
                    <p>{{$value->alamat}}, {{$value->nama_kecamatan}}</p>
                    <h5>KEC. {{$value->nama_kecamatan}} - KAB. {{$value->kotakab}} - PROV. {{$value->nama_propinsi}}</h5>
                </div>
                <div style="clear: both"></div>
            @endif
            @if(($key+1)%8 == 0)
                <div style="page-break-before: always;"></div>
            @endif
        @endforeach
    @endif
</body>
</html>