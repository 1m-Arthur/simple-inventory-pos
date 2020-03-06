<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>
                            Permintaan Bahan
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Permintaan</a></li>
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
                        <strong>Detail Data Permintaan</strong>
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
                                <input type="text" id="nf-password" value="<?php echo ($view['tgl_permintaan'] !== null) ? date('d-M-Y', strtotime($view['tgl_permintaan'])) : "Barang belum diterima"; ?>" name="tgl_diterima" placeholder="Enter Tanggal Diperlukan.." class="form-control" disabled>
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
                            <label for="nf-password" class=" form-control-label">Status</label>
                            <div class="form-group">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td><?php echo $status[0]['nama_disposisi'] ?></td>
                                            <td><?php echo date('d/M/Y (H:i)', strtotime($view['created_date'])) ?></td>
                                        </tr>
                                        <?php if ($view['tgl_pengajuan'] !== null) { ?>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td><?php echo $status[1]['nama_disposisi'] ?></td>
                                                <td><?php echo date('d/M/Y (H:i)', strtotime($view['tgl_pengajuan'])) ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                        <?php if ($view['tgl_approve'] !== null) { ?>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td><?php echo $status[2]['nama_disposisi'] ?></td>
                                                <td><?php echo date('d/M/Y (H:i)', strtotime($view['tgl_approve'])) ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                        <?php if ($view['tgl_po'] !== null) { ?>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td><?php echo $status[3]['nama_disposisi'] ?></td>
                                                <td><?php echo date('d/M/Y (H:i)', strtotime($view['tgl_po'])) ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                        <?php if ($view['tgl_penerimaan'] !== null) { ?>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td><?php echo $status[4]['nama_disposisi'] ?></td>
                                                <td><?php echo date('d/M/Y (H:i)', strtotime($view['tgl_penerimaan'])) ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                        <?php if ($view['disposisi_id'] == 6) { ?>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td><b><?php echo $status[2]['nama_disposisi'] ?></b></td>
                                                <td> </td>
                                            </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                            <a class="btn btn-secondary btn-sm" href="<?php echo base_url('receiptbill/'); ?>"> Cancel</a>
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