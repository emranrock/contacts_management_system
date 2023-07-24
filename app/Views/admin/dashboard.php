<?= $this->extend('admin/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
      <small>Control panel</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner text-center">
            <h3>0</h3>
            <p>Total Employees</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-maroon">
          <div class="inner text-center">
            <h3>0</h3>
            <p>Total Stores</p>
          </div>
          <div class="icon">
            <i class="fa fa-home"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-teal">
          <div class="inner text-center">
            <h3>0</h3>
            <p>Total NDR </p>
          </div>
          <div class="icon">
            <i class="fa fa-clock-o"></i>
          </div>
          <a href="<?= base_url('admin/ndr/forwards');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner text-center">
            <h3>0</h3>
            <p>Total RTO</p>
          </div>
          <div class="icon">
            <i class="fa fa-forward"></i>
          </div>
          <a href="<?= base_url('#');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-gray">
          <div class="inner text-center">
            <h3>0</h3>
            <p>Total Delivered</p>
          </div>
          <div class="icon">
            <i class="fa fa-check-circle"></i>
          </div>
          <a href="<?= base_url('admin/forward/delivered');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-olive">
          <div class="inner text-center">
            <h3>0</h3>
            <p>Total In Process</p>
          </div>
          <div class="icon">
            <i class="fa fa-circle-o-notch"></i>
          </div>
          <a href="<?= base_url('admin/forward/manage');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div>
    <div class="row">
      <div class="col-md-6">
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Weekly</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="bar-chart" style="height: 300px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-6">
        <!-- DONUT CHART -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Daily</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>

    </div>
  </section>
</div>
<script src="<?php echo base_url('assets/admin/plugins/raphael/raphael.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/morris/morris.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
  //BAR CHART
  var bar = new Morris.Bar({
    element: 'bar-chart',
    resize: true,
    data: [{
        y: '2006',
        a: 100,
        b: 90
      },
      {
        y: '2007',
        a: 75,
        b: 65
      },
      {
        y: '2008',
        a: 50,
        b: 40
      },
      {
        y: '2009',
        a: 75,
        b: 65
      },
      {
        y: '2010',
        a: 50,
        b: 40
      },
      {
        y: '2011',
        a: 75,
        b: 65
      },
      {
        y: '2012',
        a: 100,
        b: 90
      }
    ],
    barColors: ['#00a65a', '#f56954'],
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['CPU', 'DISK'],
    hideHover: 'auto'
  });

  //DONUT CHART
  var donut = new Morris.Donut({
    element: 'sales-chart',
    resize: true,
    colors: ["#3c8dbc", "#f56954", "#00a65a"],
    data: [{
        label: "Download Sales",
        value: 12
      },
      {
        label: "In-Store Sales",
        value: 30
      },
      {
        label: "Mail-Order Sales",
        value: 20
      }
    ],
    hideHover: 'auto'
  });
 </script>
<?= $this->endSection() ?>