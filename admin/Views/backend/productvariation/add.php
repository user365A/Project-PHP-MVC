<?php 
$this->view('partials.backend.header');
$this->view('partials.backend.sidebar')
?>

<div class="content-wrapper">

<div class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="container">
            <h2>Add form</h2>

            <form action="index.php?controller=variant&action=store" method="POST" enctype="multipart/form-data">

               <?php if(!empty($errorSizeColor)){ ?>
                <div class="alert alert-danger mt-2"><?php echo $errorSizeColor ?></div>
                <?php } ?>
              <input type="hidden" name="product_id" value="<?php echo isset($product_id)? $product_id : $_GET['product_id'];?>"/>
              <div class="form-group">
                <label for="">Size</label>
                <input type="text" name="size" value="<?php echo isset($addData['size'])? $addData['size'] :'' ?>" class="form-control-file"  placeholder="product's size" >

                <?php if(isset($errors['size'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['size']; ?></div>
                <?php endif ?>
                
            </div>
              <div class="form-group">
                <label for="">Color:</label>
                <input type="text" name="color" value="<?php echo isset($addData['color'])? $addData['color'] :'' ?>" class="form-control-file"  placeholder="product color" >

                <?php if(isset($errors['color'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['color']; ?></div>
                <?php endif ?>

            </div>
              <div class="form-group">
                <label for="">Quantity:</label>
                <input type="text" name="quantity" value="<?php echo isset($addData['quantity'])? $addData['quantity'] :'' ?>"  class="form-control-file "  placeholder="quantity" >

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