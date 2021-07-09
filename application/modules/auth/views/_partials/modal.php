<!-- Modal Add Category -->
<div class="modal fade" id="modalAddCategory" tabindex="-1" aria-labelledby="modalAddCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">

        <form action="<?= site_url('auth/category/create') ?>" method="post" id="formAddCategory">
            <input type="hidden" name="id_category" id="id_category" value="">
            <div class="form-group">
                <label for="name">Name Category <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name-category" placeholder="Name Category..">
                <div class="invalid-feedback">
                  
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description Category <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" id="description-category" rows="5" placeholder="Description Category.."></textarea>
                <div class="invalid-feedback">
                  
                </div>
            </div>

            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-sm" value="submit" id="btnSaveModal" onclick="save()" >Save</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseModal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Category -->

<!-- Modal Add Product -->
<div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="modalAddProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleProduct"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalProduct">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">

        <form action="<?= site_url('auth/product/create') ?>" method="post" id="formAddProduct">
            <input type="hidden" name="id_product" id="id_product" value="">
            <div class="form-group">
                <label for="name-product">Name Product <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name-product" placeholder="Name Product..">
                <div class="invalid-feedback">
                  
                </div>
            </div>

            <div class="form-group">
              <label for="category-product">Category <span class="text-danger">*</span></label>
              <select name="id_category" id="category-product" class="form-control">
                <option value="">- Choose Category -</option>
                 <?php foreach($category as $data): ?>
                  <option value="<?= $data->id_category ?>"><?= $data->name; ?></option>
                 <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
              <label for="stock-product">Stock <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="stock" id="stock-product" placeholder="Stock..">
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
              <label for="price-product">Price <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="price" id="price-product" placeholder="Price..">
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
                <label for="description-product">Description Product</label>
                <textarea name="description" class="form-control" id="description-product" rows="5" placeholder="Description Product.."></textarea>
                <div class="invalid-feedback">
                  
                </div>
            </div>

            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-sm" value="submit" id="btnSaveModalProduct" onclick="save()" >Save</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseModalProduct">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Product -->

<!-- Modal Add Order -->
<div class="modal fade" id="modalAddOrder" tabindex="-1" aria-labelledby="modalAddOrderLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleOrder"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalOrder">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">

        <form action="<?= site_url('auth/order/create') ?>" method="post" id="formAddOrder">
            <input type="hidden" name="id_order" id="id_order" value="">

            <div class="form-group">
              <label for="product-order">Product <span class="text-danger">*</span></label>
              <select name="id_product" id="product-order" class="form-control">
                <option value="" selected disabled>- Choose Product -</option>
                 <?php foreach($product as $data): ?>
                  <option data-name="<?= $data->name; ?>" data-price="<?= $data->price ?>" value="<?= $data->id_product ?>"><?= $data->name; ?></option>
                 <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
              <label for="qty-order">Quantity <span class="text-danger">*</span></label>
              <input type="text" class="form-control" value="1" min="1" name="qty" id="qty-order" placeholder="Stock..">
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
                <label for="price-order">Price <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="price" id="price-order" placeholder="Price.." readonly>
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
                <label for="total-order">Total <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="total" id="total-order" placeholder="Total.." readonly>
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-sm" value="submit" id="btnSaveModalOrder" onclick="save()" >Save</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseModalOrder">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Order -->

<!-- Modal Add Shipment -->
<div class="modal fade" id="modalAddShipment" tabindex="-1" aria-labelledby="modalAddShipmentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleShipment"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalShipment">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">

        <form action="<?= site_url('auth/shipment/create') ?>" method="post" id="formAddShipment">
            <input type="hidden" name="id_shipment" id="id_shipment" value="">

            <div class="form-group">
              <label for="date-shipment-shipment">Date Shipment <span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="date_shipment" id="date-shipment">
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
                <label for="address-shipment">Address Shipment</label>
                <textarea name="address" class="form-control" id="address-shipment" rows="5" placeholder="Address Shipment.."></textarea>
                <div class="invalid-feedback">
                  
                </div>
            </div>

            <div class="form-group">
                <label for="courier-shipment">Courier Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="courier_name" id="courier-shipment" placeholder="Courier Name..">
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-sm" value="submit" id="btnSaveModalShipment" onclick="save()" >Save</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseModalShipment">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Shipment -->