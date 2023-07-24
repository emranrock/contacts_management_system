<?= $this->extend('admin/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Group
        <small>Edit Groups</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title"><?= esc($title) ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <?php $validation =  \Config\Services::validation();?>
        <form action="<?= base_url('admin/groups/edit/'.$group['group_id']); ?>" method="post">
          <div class="row">
            <input type="hidden" name="_method" value="put"/>
            <div class="col-md-8">
              <div class="form-group">
                <label class="form-label">Group Name</label>
                <input type="text" name="name" class="form-control" autocomplete="off" value="<?= $group['name'] ?>" required>
                <!-- Error -->
                <?php if ($validation->getError('name')) { ?>
                  <div class='alert alert-danger'>
                    <?= $error = $validation->getError('name'); ?>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update" name="update" />
              </div>
            </div><!-- /.col 2 -->
          </div>
        </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <?= $this->endsection(); ?>