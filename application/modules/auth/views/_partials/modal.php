<!-- Modal Add Category -->
<div class="modal fade" id="modalAddCategory" tabindex="-1" aria-labelledby="modalAddCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddCategoryLabel">Form Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="<?= site_url('auth/category/create') ?>" method="post">

            <div class="form-group">
                <label for="name">Name Category</label>
                <input type="text" class="form-control" name="name" id="name-category" placeholder="Name Category..">
            </div>

            <div class="form-group">
                <label for="description">Description Category</label>
                <textarea name="description" class="form-control" id="description-category" rows="5" placeholder="Description Category.."></textarea>
            </div>

            <div class="float-right">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm" value="submit">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Category -->