<?= $this->extend('admin/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper" style="min-height: 1126px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <?= $this->include('admin/includes/alert_bar'); ?>
    <h1>
      Group
      <small>Manage All Groups</small>
    </h1>
   
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><?= esc($page) ?> <span><a href="<?= base_url('admin/groups/add'); ?>" class="btn btn-xs btn-primary">Add New Group</a></span></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <table id="group_datatable" class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Names</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php if($groups): ?>
          <?php 
            $sr=1;
            foreach($groups as $group): ?>
          <tr>
             <td><?php echo $sr; ?></td>
             <td><?php echo $group['name']; ?></td>
             <td>
              <a href="<?= base_url('admin/groups/edit/'.$group['group_id'])?>" class="btn btn-info btn-xs">Edit</a>
              <a href="<?= base_url('admin/groups/show/'.$group['group_id'])?>" class="btn btn-warning btn-xs">View</a>
              <button class="btn btn-danger btn-xs item_delete" data-toggle="modal" data-target="#Modal_Delete" data-id="<?= $group['group_id']; ?>">Delete</button>
            </td>
          </tr>
         <?php 
        $sr++;
        endforeach; ?>
         <?php endif; ?>
          </tbody>
        </table>
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
<?= $this->include('admin/includes/delete_model'); ?>
<script type="text/javascript">
  jQuery(document).ready(function() {
    $("#group_datatable").dataTable();

    //get data for delete record
    $(".item_delete").click(function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      $('[name="item_id"]').val(id);
      $('#btn_delete').attr('data-itemid',id);
    });

    //delete record to database
    $('#deleteItem').on('submit', function() {
      var deleteFrm= $(this).serialize();
      var id = $('#btn_delete').data('itemid');
      $.ajax({
        type: "DELETE",
        url: `${baseURL}groups/delete/${id}`,
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        data: deleteFrm,
        beforeSend:function(){
          $("#itemDeleteStatus").html("Please Wait...");
        },
        success: function(data) {
          $("#itemDeleteStatus").html(data);
        },error:function(err){
          $("#itemDeleteStatus").html(err.responseText);
        },complete:function(data){
          location.reload();
        }
      });
      return false;
    });
  });
</script>
<?= $this->endsection(); ?>