<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penerimaan Bahan</title>
</head>
<style type="text/css">
    table {
        border-collapse: collapse;
        font-family: arial;
        color: #5E5B5C;
        width: 100%;
    }

    thead th {
        text-align: left;
        padding: 5px;
        border: 2px solid;
    }

    tbody td {
        padding-left: 7px;
        padding-right: 7px;
    }

    tbody.even tr:nth-child(even) {
        background: #F6F5FA;
    }

    tbody tr:hover {
        background: #EAE9F5
    }

    h2 {
        padding: 0px;
        margin-bottom: 5px;
        color: #5E5B5C;
    }

    .normal {
        text-align: center;
    }
</style>

<body>
    <div id="outtable">
        <h2 align="center">Laporan Penerimaan Bahan</h2>
        <table border="0" style="padding-bottom:1.3em;">
            <tr>
                <th align="left" style="font-size:18px;padding-left:7px;"> PT. Mantap Djiwa </th>
            </tr>
            <tr>
                <td> Alamat: Perumahan anak komplek, </td>
            </tr>
            <tr>
                <td> Jl. jalan No 322 </td>
            </tr>
            <tr>
                <td> Tangerang - 14045 </td>
            </tr>
            <tr>
                <td> Telp : +6281069696969 </td>
            </tr>
        </table>
        <table border="1">
            <thead>
                <tr>
                    <th class="short">#</th>
                    <th class="normal">Tanggal</th>
                    <th class="normal">Penerima</th>
                    <th class="normal">Supplier</th>
                    <!-- <th class="normal">No. LPPM</th> -->
                    <th class="normal">No. PO</th>
                    <th class="normal">Material</th>
                    <th class="normal">Qty</th>
                    <th class="normal">Total Harga</th>
                </tr>
            </thead>
            <tbody class="even">
                <?php $no = 1; ?>
                <?php foreach ($report as $reports) : ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td class="normal"><?php echo date("Y/m/d", strtotime($reports['tgl_penerimaan'])); ?></td>
                        <td class="normal"><?php echo $reports['first_name'] . " " . $reports['last_name']; ?></td>
                        <td class="normal"><?php echo $reports['nama_supplier']; ?></td>
                        <!-- <td><?php echo $reports['lppm_no']; ?></td> -->
                        <td><?php echo $reports['po_no']; ?></td>
                        <td class="normal"><?php echo $reports['nama_bahan']; ?></td>
                        <td class="normal"><?php echo $reports['qty'] . " " . $reports['nama_satuan']; ?></td>
                        <td class="normal"><?php echo $reports['total_harga']; ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>