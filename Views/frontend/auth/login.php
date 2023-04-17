<?php
$this->view('partials.frontend.header', [
    "menus" => $menus,
    "categories" => $categories
]) ?>
<div class="container">
    <br>
    <br>
</div>
<hr>
<div class="container">
    <div class="center">
        <div class="center_title">
            <p>
                Your Information
            </p>
        </div>
        <div class="center_form">
            <form action="index.php?controller=customer&action=login" method="post">

                <input type="text" name="txtusername" value="<?php echo isset($loginData['txtusername']) ? $loginData['txtusername'] :'' ?>" id="" placeholder="Tên của bạn">

                <?php if (isset($errors['txtusername'])) : ?>
                    <div style="color: red;"><?php echo $errors['txtusername']; ?></div>
                <?php endif ?>
                <br>
                <input type="password" name="txtpassword" value="<?php echo isset($loginData['txtpassword']) ? $loginData['txtpassword'] :'' ?>" id="" placeholder="Password">
                
                <?php if (isset($errors['txtpassword'])) : ?>
                    <div style="color: red;"><?php echo $errors['txtpassword']; ?></div>
                <?php endif ?>

                <hr>
                <button type="submit" class="login" name="submit">LogIn</button>

            </form>
            <a href="index.php?controller=customer&action=logout"><button type="" class="logout" name="logout">LogOut </button></a>

        </div>

    </div>

</div>

<?php $this->view('partials.frontend.footer', []) ?>