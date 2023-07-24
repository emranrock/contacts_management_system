<!--MODAL DELETE-->
<form id="deleteItem">
  <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this record?</strong>
        </div>
        <div class="modal-footer">
          <span id="itemDeleteStatus"></span>
          <input type="hidden" name="item_id" class="form-control">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" id="btn_delete" class="btn btn-primary" data-itemId="">Yes</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!--END MODAL DELETE-->