<?php 
$this->view('partials.backend.header');
$this->view('partials.backend.sidebar')
?>

<div class="content-wrapper">


<div class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="container mt-3">
            <div class="col-md-12">
        <a href="index.php?controller=product&action=create"  class="btn btn-primary  m-2">Add</a>

            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr style="background-color:darkgray">
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($products as $product): ?>
                      <tr>
                        <td><?php echo $product['id'] ?></td>
                        <td><?php echo $product['name'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><img src="../public/assets/image/<?php echo $product['image'] ?>" width="200" height="200" alt=""></td>
                        <td><?php echo $product['category_id'] ?></td>
                        <td>
                            <a href="javascript:delete_record('product',<?php echo $product['id'] ?>)" data-url="" class="btn btn-danger action_delete">Delete</a>
                            <a href="index.php?controller=product&action=edit&id=<?php echo $product['id'] ?>"  class="btn btn-primary">Edit</a>
                            <a href="index.php?controller=product&action=showVariant&id=<?php echo $product['id'] ?>"  class="btn btn-warning">Variations</a>
                          </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
            </div>
            <div class="col-md-12">

            </div>
          </div>

    </div>

  </div>
</div>

</div>

<?php 
$this->view('partials.backend.footer') 
?>