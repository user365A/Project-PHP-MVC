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

            <form action="index.php?controller=product&action=update&id=<?php echo isset($product['id'])? $product['id'] : $_GET['id']?>" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label for="">Product's name:</label>
                <input type="text" name="name" value="<?php echo isset($product['name'])? $product['name'] : $editData['name']?>" class="form-control-file"  placeholder="product's name" >

                <?php if(isset($errors['name'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['name']; ?></div>
                <?php endif ?>
                
            </div>
              <div class="form-group">
                <label for="">Price:</label>
                <input type="text" name="price" value="<?php echo isset($product['price'])? $product['price'] : $editData['price']?>" class="form-control-file"  placeholder="product price" >

                <?php if(isset($errors['price'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['price']; ?></div>
                <?php endif ?>

            </div>
              <div class="form-group">
                <label for="">Image:</label>
                <input type="file" name="image"  class="form-control-file"  placeholder="product image" >

            </div>
              <div class="form-group">
                <label for="">Category</label>
                <select class="form-control " name="category_id">
                    <option value=""></option>
                    <?php foreach ($categories as $category):?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    <?php endforeach ?>
                </select>

                <?php if(isset($errors['category_id'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['category_id']; ?></div>
                <?php endif ?>

            </div>

            <div class="form-group">
                <label for="">Menu</label>
                <select class="form-control " name="menu_id">
                    <option value="">Select menu</option>
                    <?php foreach ($menus as $menu): ?>
                    <option value="<?php echo $menu['id'] ?>"><?php echo $menu['name'] ?></option>
                    <?php endforeach ?>
                </select>

                <?php if(isset($errors['menu_id'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['menu_id']; ?></div>
                <?php endif ?>

            </div>

            <div class="form-group">
                <label for="">Sale off:</label>
                <input type="text" name="sale_off" value="<?php echo isset($product['sale_off'])? $product['sale_off'] : $editData['sale_off']?>" class="form-control-file"  placeholder="safe off" >

                <?php if(isset($errors['sale_off'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['sale_off']; ?></div>
                <?php endif ?>

            </div>

              <div class="form-group">
                <label for="">description:</label>
                <textarea name="des" class="form-control" id="" cols="30" rows="10"><?php echo isset($product['des'])? $product['des'] : $editData['des']?></textarea>

                <?php if(isset($errors['des'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['des']; ?></div>
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