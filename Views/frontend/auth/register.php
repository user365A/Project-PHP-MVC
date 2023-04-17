<?php
$this->view('partials.frontend.header', [
    "menus" => $menus,
    "categories" => $categories
]) ?>

<br><br>
<hr>
<div class="container">
    <div class="center">
        <div class="center_title">
            <p>
                Your Information
            </p>
        </div>
        <div class="center_form">
            <form action="index.php?controller=customer&action=register" method="post">

                <input type="text" name="txtName" value="<?php echo isset($regisData['txtName']) ? $regisData['txtName'] : '' ?>" id=""  placeholder="Tên của bạn">
                <?php if (isset($errors['txtName'])) : ?>
                    <div style="color: red;"><?php echo $errors['txtName']; ?></div>
                <?php endif ?>
                <br>

                <input type="text" name="txtAddress" value="<?php echo isset($regisData['txtAddress']) ? $regisData['txtAddress'] : '' ?>" id=""  placeholder="Địa chỉ">
                <?php if (isset($errors['txtAddress'])) : ?>
                    <div style="color: red;"><?php echo $errors['txtAddress']; ?></div>
                <?php endif ?>
                <br>

                <input type="text" name="txtNumberPhone" value="<?php echo isset($regisData['txtNumberPhone']) ? $regisData['txtNumberPhone'] : '' ?>" id=""  placeholder="Số điện thoại">
                <?php if (isset($errors['txtNumberPhone'])) : ?>
                    <div style="color: red;"><?php echo $errors['txtNumberPhone']; ?></div>
                <?php endif ?>
                <br>

                <input type="text" name="txtEmail" value="<?php echo isset($regisData['txtEmail']) ? $regisData['txtEmail'] : '' ?>" id=""  placeholder="Email">
                <?php if (isset($errors['txtEmail'])) : ?>
                    <div style="color: red;"><?php echo $errors['txtEmail']; ?></div>
                <?php endif ?>
                <br>

                <input type="text" name="txtLogin" value="<?php echo isset($regisData['txtLogin']) ? $regisData['txtLogin'] : '' ?>" id=""  placeholder="Tên đăng nhập">
                <?php if (isset($errors['txtLogin'])) : ?>
                    <div style="color: red;"><?php echo $errors['txtLogin']; ?></div>
                <?php endif ?>
                <br>

                <input type="password" name="txtPass" value="<?php echo isset($regisData['txtPass']) ? $regisData['txtPass'] : '' ?>" id=""  placeholder="Password">
                <?php if (isset($errors['txtPass'])) : ?>
                    <div style="color: red;"><?php echo $errors['txtPass']; ?></div>
                <?php endif ?>
                <br>

                <button type="submit" class="login" name="submit">Đăng ký</button>
            </form>

        </div>
    </div>
</div>

<?php $this->view('partials.frontend.footer', []) ?>