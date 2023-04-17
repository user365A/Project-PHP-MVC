<?php 
$this->view('partials.backend.header');
$this->view('partials.backend.sidebar')
?>

<div class="content-wrapper">

<div class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="container">
            <h2>Edit form</h2>

            <form action="index.php?controller=variant&action=update&id=<?php echo isset($variation['id'])? $variation['id']:$_GET['id'] ?>" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="product_id" value="<?php echo isset($product_id)? $product_id :$variation['product_id']; ?>"/>

            <div class="form-group">
                <label for="">Size</label>
                <input type="text" name="size" value="<?php echo isset($variation['size'])? $variation['size'] : $editData['size']?>" class="form-control-file"  placeholder="product's size" >

                <?php if(isset($errors['size'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['size']; ?></div>
                <?php endif ?>
                
            </div>
              <div class="form-group">
                <label for="">Color:</label>
                <input type="text" name="color" value="<?php echo isset($variation['color'])? $variation['color'] : $editData['color']?>" class="form-control-file"  placeholder="product color" >

                <?php if(isset($errors['color'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['color']; ?></div>
                <?php endif ?>

            </div>
              <div class="form-group">
                <label for="">Quantity:</label>
                <input type="text" name="quantity" value="<?php echo isset($variation['quantity'])? $variation['quantity'] : $editData['quantity']?>" class="form-control-file"  placeholder="quantity" >

                <?php if(isset($errors['quantity'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['quantity']; ?></div>
                <?php endif ?>

            </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
    </div>
  </div>
</div>

</div>

<?php 
$this->view('partials.backend.footer') 
?>