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
                <label for="name-product">Name Product <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name-product" placeholder="Name Product..">
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
                    <?php if($data->stock != 0): ?>
                    <option data-name="<?= $data->name; ?>" data-price="<?= $data->price ?>" value="<?= $data->id_product ?>"><?= $data->name; ?></option>
                    <?php endif; ?>
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
<div class="modal fade" id="modalAddShipment" tabindex="-1" aria-labelledby="modalAddShipmentLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-xl">
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

            <div class="form-group">
              <label for="order-shipment">Order <span class="text-danger">*</span></label>
              <div class="table-responsive">
                  <table class="table" id="wrap-add">
                    <tr class="tr1">
                      <td>
                        <select name="id_order[]" class="form-control order-shipment">
                          <option value="" selected disabled>- Choose Order -</option>
                          <?php foreach($order as $data): ?>
                            <?php if($data->status_order == 'selesai' ): ?>
                              <option data-product="<?= $data->name_product; ?>" data-qty="<?= $data->qty; ?>" data-price="<?= $data->price; ?>" data-total="<?= $data->total; ?>" value="<?= $data->id_order ?>">
                                (<?= $data->username_user; ?>) - <?= $data->name_product; ?> - Total : <?= $data->total; ?> - Tanggal Transaksi : <?= $data->tanggal_transaksi; ?> (<?= $data->status_order; ?>)
                              </option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                      </td>

                      <td>
                        <input type="text" name="product_order_shipment" id="product-order-shipment" placeholder="Product Name.." class="form-control product-order-shipment" readonly />
                      </td>
                      
                      <td>
                        <input type="text" placeholder="Quantity.." class="form-control qty-order-shipment" readonly />
                      </td>

                      <td>
                        <input type="text" placeholder="Price.." class="form-control price-order-shipment" readonly />
                      </td>

                      <td>
                        <input type="text" placeholder="Total.." class="form-control total-order-shipment" readonly />
                      </td>

                      <td>
                        <button type="button" id="tambah" class="btn btn-success btn-sm mt-1">
                          <i class="fa fa-plus"></i>
                        </button>
                      </td>
                    </tr>
                  </table>
              </div>
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
                <label for="total-shipment">Grand Total <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="grandtotal" id="grandtotal-shipment" placeholder=" Grand Total.." value="0" readonly>
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
              <label for="status-shipment">Status Shipment <span class="text-danger">*</span></label>
              <select name="status_shipment" id="status-shipment" class="form-control">
                <option value="" selected disabled>- Choose Status -</option>
                 
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
                
              </select>
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

<!-- Modal Add Shipment Order -->
<div class="modal fade" id="modalAddShipmentOrder" tabindex="-1" aria-labelledby="modalAddShipmentOrderLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleShipmentOrder"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalShipmentOrder">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">

        <form action="<?= site_url('auth/shipment_order/create') ?>" method="post" id="formAddShipmentOrder">
        
            <input type="hidden" name="id_shipment_order" id="id_shipment_order" value="">

            <div class="form-group">
              <label for="order-shipment-order">Order <span class="text-danger">*</span></label>
              <select name="id_order" id="order-shipment-order" class="form-control">
                <option value="" selected disabled>- Choose Order -</option>
                 <?php foreach($order as $data): ?>
                  <?php if($data->status_order == 'selesai' ): ?>
                    <option value="<?= $data->id_order ?>">
                      (<?= $data->username_user; ?>) - <?= $data->name_product; ?> - Total : <?= $data->total; ?> - Tanggal Transaksi : <?= $data->tanggal_transaksi; ?> (<?= $data->status_order; ?>)
                    </option>
                  <?php endif; ?>
                 <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="form-group">
              <label for="shipment-shipment-order">Shipment <span class="text-danger">*</span></label>
              <select name="id_shipment" id="shipment-shipment-order" class="form-control">
                <option value="" selected disabled>- Choose Shipment -</option>
                 <?php foreach($shipment as $data): ?>
                    <option value="<?= $data->id_shipment ?>">
                      Kurir : <?= $data->courier_name; ?> - Tanggal Pengiriman: <?= $data->date_shipment; ?> - <?= $data->address; ?> (<?= $data->status_shipment; ?>)
                    </option>
                 <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">
                  
              </div>
            </div>

            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-sm" value="submit" id="btnSaveModalShipmentOrder" onclick="saveShipmentOrder()" >Save</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseModalShipmentOrder">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Shipment Order -->

<!-- <div class="form-group">
        <label for="order-shipment">Order <span class="text-danger">*</span></label>
        <div class="form-inline" id="wrap-add">
            <input type="text" class="form-control" name="courier_name" id="courier-shipment" placeholder="Order..">
            <a href="#" class="btn btn-success btn-md ml-2"><i class="fa fa-plus"></i> Add Order</a>
        </div>
        <div class="invalid-feedback">
          
        </div>
        <div class="table-responsive">
            <table class="table" id="wrap-add">
              <tr>
                <td><input type="text" placeholder="Order.." class="form-control" id="order-shipment" /></td>
                <td>
                  <button type="button" id="tambah" class="btn btn-success btn-sm mt-1">
                    <i class="fa fa-plus"></i> Add
                  </button>
                </td>
              </tr>
            </table>
        </div>
    </div> -->