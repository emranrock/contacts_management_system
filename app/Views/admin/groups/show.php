<?= $this->extend('admin/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper" style="min-height: 1126px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Group
      <small>Add new Groups</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><?= esc($page) ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
      <div class="row">
            <div class="col-md-8">
            <div class="card">
                    <div class="card-title">Group Caption</div>
                    <div class="card-body">
                        <h3>Group Name:- <?= ucfirst($group['name']) ?></h3>
                    </div>
                    <div class="card-footer">
                    <a href="<?= base_url('admin/groups/manage') ?>" class="btn btn-primary btn-xs">View All</a>
                    </div>
                </div>
            </div><!-- /.col 2 -->
          </div>
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<?= $this->endsection(); ?>