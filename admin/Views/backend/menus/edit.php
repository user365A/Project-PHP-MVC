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

            <form action="index.php?controller=menu&action=update&id=<?php echo isset($menu['id'])? $menu['id'] : $_GET['id']?>" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label for="">Menu's name:</label>
                <input type="text" name="name" value="<?php echo isset($menu['name'])? $menu['name'] : $editData['name']?>" class="form-control-file"  placeholder="menu's name" >

                <?php if(isset($errors['name'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['name']; ?></div>
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