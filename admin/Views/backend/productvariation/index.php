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
        <a href="index.php?controller=variant&action=create&product_id=<?php echo $product_id ?>"  class="btn btn-primary  m-2">Add</a>

            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr style="background-color:darkgray">
                        <th>ProductID</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($variations as $variation): ?>
                      <tr>
                        <td><?php echo $variation['product_id'] ?></td>
                        <td><?php echo $variation['size'] ?></td>
                        <td><?php echo $variation['color'] ?></td>
                        <td><?php echo $variation['quantity'] ?></td>
                        <td>
                            <a href="javascript:delete_record('variant',<?php echo $variation['id'] ?>)" data-url="" class="btn btn-danger action_delete">Delete</a>
                            <a href="index.php?controller=variant&action=edit&id=<?php echo $variation['id'] ?>"  class="btn btn-primary">Edit</a>
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