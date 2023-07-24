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
        <form action="<?= base_url('admin/contacts/edit/' . $contact['id']); ?>" method="post">
          <div class="row">
            <input type="hidden" name="_method" value="put" />
            <div class="col-md-8">
              <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" autocomplete="off" value="<?= $contact['name'] ?>" required>
                <!-- Error -->
                <?php if ($validation->getError('name')) { ?>
                  <div class='text-danger mt-2'>
                    * <?= $validation->getError('name') ; ?>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" autocomplete="off" value="<?= $contact['email'] ?>" required>
                <!-- Error -->
                <?php if ($validation->getError('email')) { ?>
                  <div class='text-danger mt-2'>
                    * <?= $validation->getError('email') ; ?>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="number" name="phone" class="form-control" autocomplete="off" value="<?= $contact['phone'] ?>" required>
                <?php if ($validation->getError('phone')) { ?>
                  <div class='text-danger mt-2'>
                    * <?= $validation->getError('phone') ; ?>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group">
                <label class="form-label">Group</label>
                <select name="group" class="form-control">
                  <option value="">Select Group</option>
                  <?php foreach ($groups as $group) : ?>
                    <option value="<?= $group['group_id'] ?>" <?= $group['group_id']==$contact['group']?'selected':'' ?>><?= $group['name'] ?></option>
                  <?php endforeach; ?>
                </select>
                <!-- Error -->
                <?php if ($validation->getError('group')) { ?>
                  <div class='text-danger mt-2'>
                    * <?= $validation->getError('group') ; ?>
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