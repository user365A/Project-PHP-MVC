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

            <form action="index.php?controller=category&action=update&id=<?php echo isset($category['id'])? $category['id'] : $_GET['id']?>" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label for="">Category's name:</label>
                <input type="text" name="name" value="<?php echo isset($category['name'])? $category['name'] : $editData['name']?>" class="form-control-file"  placeholder="category's name" >

                <?php if(isset($errors['name'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['name']; ?></div>
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