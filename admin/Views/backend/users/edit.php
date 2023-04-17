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

            <form action="index.php?controller=user&action=update&id=<?php echo $_GET['id']?>" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Name:</label>
                <input type="text" name="name" value="<?php echo isset($user['name'])? $user['name'] : $editData['name']?>" class="form-control-file"  placeholder="Name" >

                <?php if(isset($errors['name'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['name']; ?></div>
                <?php endif ?>
                
            </div>
              <div class="form-group">
                <label for="">Username:</label>
                <input type="text" name="username" value="<?php echo isset($user['username'])? $user['username'] : $editData['username']?>" class="form-control-file"  placeholder="Username" >

                <?php if(isset($errors['username'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['username']; ?></div>
                <?php endif ?>

            </div>

            <div class="form-group">
                <label for="">Password:</label>
                <input type="password" name="password" value="" class="form-control-file"  placeholder="Password" >

                <?php if(isset($errors['password'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['password']; ?></div>
                <?php endif ?>

            </div>

            <div class="form-group">
                <label for="">Email:</label>
                <input type="text" name="email" value="<?php echo isset($user['email'])? $user['email'] : $editData['email']?>" class="form-control-file"  placeholder="Email" >

                <?php if(isset($errors['email'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['email']; ?></div>
                <?php endif ?>

            </div>

            <div class="form-group">
                <label for="">Address:</label>
                <input type="text" name="address" value="<?php echo isset($user['address'])? $user['address'] : $editData['address']?>" class="form-control-file"  placeholder="Address" >

                <?php if(isset($errors['address'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['address']; ?></div>
                <?php endif ?>

            </div>

            <div class="form-group">
                <label for="">Phone:</label>
                <input type="text" name="phone" value="<?php echo isset($user['phone'])? $user['phone'] : $editData['phone']?>" class="form-control-file"  placeholder="Phone" >

                <?php if(isset($errors['phone'])): ?>
                <div class="alert alert-danger mt-2"><?php echo $errors['phone']; ?></div>
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