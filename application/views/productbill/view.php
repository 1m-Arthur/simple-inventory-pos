<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>
                            Pengeluaran Bahan
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Pengeluaran</a></li>
                            <li class="active">Lihat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Detail Data Pengeluaran</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Bon Permintaan:</label>
                                <input type="text" id="nf-password" value="<?php echo $view['kode_bon_permintaan'] ?>" name="bahan" placeholder="Enter Bahan.." class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nama Pelaksana:</label>
                                <input type="text" id="nf-password" value="<?php echo $view['first_name'] . ' ' . $view['last_name'] ?>" name="bahan" placeholder="Enter Bahan.." class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nama Penerima:</label>
                                <input type="text" id="nf-password" value="<?php echo $view['nama_penerima'] ?>" name="bahan" placeholder="Enter Bahan.." class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nomor PO</label>
                                <input type="text" id="nf-password" value="<?php echo $view['po_no'] ?>" name="po_no" placeholder="Anda belum menambahkan data PO" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nomor LPPM</label>
                                <input type="text" id="nf-password" value="<?php echo $view['lppm_no'] ?>" name="lppm_no" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Tanggal Diperlukan:</label>
                                <input type="text" id="nf-password" value="<?php echo date('d-M-Y', strtotime($view['tgl_diperlukan'])) ?>" name="tgl_diperlukan" placeholder="Enter Tanggal Diperlukan.." class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Tanggal Permintaan</label>
                                <input type="text" id="nf-password" value="<?php echo ($view['tgl_permintaan'] !== null) ? date('d-M-Y', strtotime($view['tgl_diperlukan'])) : "Barang belum diterima"; ?>" name="tgl_diterima" placeholder="Enter Tanggal Diperlukan.." class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="nf-password" cols="30" rows="5" disabled><?php echo $view['keterangan'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Material</label>
                                <div class="input-group">
                                    <input type="text" id="nf-password" value="<?php echo $view['nama_bahan'] ?>" name="bahan" placeholder="Enter Material.." class="form-control" disabled>
                                    <div class="input-group-addon"><?php echo $view['qty_permintaan'] ?></div>
                                    <div class="input-group-addon"><?php echo $view['nama_satuan'] ?></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Harga</label>
                                <input type="text" id="nf-password" value="<?php echo $view['harga_satuan'] ?>" name="bahan" placeholder="Anda belum menambahkan data PO" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Total</label>
                                <input type="text" id="nf-password" value="<?php echo $view['total_harga'] ?>" name="bahan" placeholder="Anda belum menambahkan data PO" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Data sudah dikeluarkan:</label>
                                <input type="text" id="nf-password" value="<?php if ($view['approve'] == '1') {
                                                                                echo "Yes";
                                                                            } else {
                                                                                echo "No";
                                                                            } ?>" name="bahan" placeholder="Anda belum menambahkan data PO" class="form-control" disabled>
                            </div>
                            <a class="btn btn-secondary btn-sm" href="<?php echo base_url('productbill/'); ?>"> Cancel</a>
                        </div>
                        <!-- </form> -->
                    </div>

                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>