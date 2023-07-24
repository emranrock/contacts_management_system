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
        <h3 class="box-title"><?= esc($page) ?> <span><a href="<?= base_url('admin/contacts/add'); ?>" class="btn btn-xs btn-primary">Add New Contact</a></span></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <table id="conatct_datatable" class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Names</th>
              <th>Emails</th>
              <th>Phones</th>
              <th>Groups</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php if($contacts): ?>
          <?php 
            $sr=1;
            foreach($contacts as $contact): ?>
          <tr>
             <td><?php echo $sr; ?></td>
             <td><?php echo $contact['name']; ?></td>
             <td><?php echo $contact['email']; ?></td>
             <td><?php echo $contact['phone']; ?></td>
             <td><?php echo $contact['group_name']; ?></td>
             <td>
              <a href="<?= base_url('admin/contacts/edit/'.$contact['id'])?>" class="btn btn-info btn-xs">Edit</a>
              <a href="<?= base_url('admin/contacts/show/'.$contact['id'])?>" class="btn btn-warning btn-xs">View</a>
              <button class="btn btn-danger btn-xs item_delete" data-toggle="modal" data-target="#Modal_Delete" data-id="<?= $contact['id']; ?>">Delete</button>
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
    $("#conatct_datatable").dataTable();

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
        url: `${baseURL}contacts/delete/${id}`,
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