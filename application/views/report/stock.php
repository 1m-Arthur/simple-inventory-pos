<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Laporan Stock Bahan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Laporan</a></li>
                            <li class="active">Stock Bahan</li>
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
            <div class="col-lg-12" style="padding-bottom:130px;">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Laporan Bahan</strong>
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
                        <form action=" <?php echo base_url('Report/printStock/') ?>" method="get">
                            <div class="row form-group"">
                            <div class=" col-lg-1"></div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="input-group date" id="startDate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="startDate" data-toggle="datetimepicker" data-target="#startDate" name="start_date" placeholder="Enter Start date.." required />
                                        <div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <!-- <input type="text" id="endDate" name="end_date" placeholder="Enter End date.." class="form-control" required> -->
                                <div class="form-group">
                                    <div class="input-group date" id="endDate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="endDate" data-toggle="datetimepicker" data-target="#endDate" name="end_date" placeholder="Enter End date.." required />
                                        <div class="input-group-append" data-target="#endDate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select name="bahan" id="select" class="form-control">
                                        <option value="">Semua Bahan</option>
                                        <?php foreach ($bahan as $bahans) { ?>
                                            <option value=" <?php echo $bahans['bahan_id'] ?>"><?php echo $bahans['nama_bahan'] ?></option>
                                        <?php
                                    } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1" style="padding-top:4.5px;">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="col-lg-1"></div>
                    </div>
                    </form>
                </div>
                <div class="card-footer" style="padding-bottom:20px;"></div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#startDate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#endDate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('.datetimepicker-input').mask('00-00-0000');
    });
</script>