<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Material</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li>Material</li>
                            <li class="active">Stock</li>
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
                        <strong class="card-title">Daftar Stock Material</strong>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($this->session->tempdata('msgntf'))) { ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Warning!</strong> <?php echo $this->session->tempdata('msgntf'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                    } ?>
                        <?php if (!empty($this->session->tempdata('msgout'))) { ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong> <?php echo $this->session->tempdata('msgout'); ?> </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                    } ?>

                        <!-- table cont -->
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Material</th>
                                        <th class="text-left">Stock Tersedia</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no = 1;
                                    foreach ($stock as $stocks) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $no ?></td>
                                            <td> <span class="name"><?php echo $stocks['nama_bahan'] ?></span> </td>
                                            <td class="text-left" style="padding-left:3.5em"> <span class="name"><?php echo $stocks['stock_awal'] ?></span> </td>
                                        </tr>
                                        <?php $no++;
                                    } ?>

                                </tbody>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>