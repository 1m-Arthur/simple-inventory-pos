<!DOCTYPE html>
<html>

<head>
    <title>Laporan Stock Bahan</title>
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

    font {
        color: #5E5B5C;
    }

    .normal {
        text-align: center;
    }

    .short {
        width: 4%;
    }
</style>

<body>
    <div id="outtable">
        <h2 align="center">Laporan Stock Bahan</h2>
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
            <!-- <tr>
                
            </tr> -->
        </table>
        <font size="2"> Periode: <?php echo $this->input->get('start_date') . ' s.d. ' . $this->input->get('end_date') ?> </font>
        <table border="1">
            <thead>
                <tr>
                    <th class="short">#</th>
                    <th class="normal">Material</th>
                    <th class="normal">Stock Awal</th>
                    <th class="normal">Penerimaan</th>
                    <th class="normal">Pengeluaran</th>
                    <th class="normal">Stock Akhir</th>
                    <th class="normal">TGL</th>
                    <th class="normal">Keterangan</th>
                </tr>
            </thead>
            <tbody class="even">
                <?php $no = 1; ?>
                <?php foreach ($report as $reports) : ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td class="normal"><?php echo $reports['nama_bahan']; ?></td>
                        <td class="normal"><?php echo $reports['awal']; ?></td>
                        <td class="normal"><?php echo $reports['terima']; ?></td>
                        <td class="normal"><?php echo $reports['pengeluaran']; ?></td>
                        <td class="normal"><?php echo $reports['akhir']; ?></td>
                        <td class="normal"><?php echo date("d/m/y", strtotime($reports['created_date'])); ?></td>
                        <td class="normal"></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>