<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pembelian {{ $order['kode_masuk'] }}</title>
    
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    .invoice-box {
        width: 100%;
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: normal; /* inherit */
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 18px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

    .row-btn {
        width: 100%;
        display: flex;
        justify-content: end;
        margin-top: 20px;
    }

    .btn-cetak {
        padding: 8px 32px;
        border-radius: 5px;
        outline: none;
        border: none;
        color: #fff;
        background: red;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                Tanggal : <strong>{{ $order['tanggal']->toDateString() }}</strong>
                            </td>
                            
                            <td>
                                Total : <strong> Rp {{ number_format($order['total']) }}</strong><br>
                                {{ $order['tanggal_masuk'] }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>PEMASOK : </strong>{{ $order['pemasok'] }}  
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>Barang</td>
                <td>Subtotal</td>
            </tr>
            
            @foreach ($order['details'] as $row)
            <tr class="item">
                <td>
                    {{ $row->barang->nama_barang }}<br>
                    <strong>Harga</strong>: Rp {{ number_format($row->harga_beli) }} x {{ $row->jumlah }}
                </td>
                <td>Rp {{ number_format($row->sub_total* $row->jumlah) }}</td>
            </tr>
            @endforeach
            
            <tr class="total">
                <td></td>
                <td>
                   Subtotal: Rp. {{ number_format($order['total']) }}
                </td>
            </tr>
            
        </table>
        <div class="row-btn">
            <button class="btn-cetak">Cetak</button>
        </div>
    </div>

    <script>
        let btn = document.querySelector('.btn-cetak').addEventListener('click', () => {
            window.print()
        })
    </script>
</body>
</html>