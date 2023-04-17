<?php 

$this->view('partials.frontend.header',[
    "menus"=>$menus,
    "categories"=>$categories
]) ?>
<div class="container-fluid">
    <!--cart--------------------------------------------------------------------------->
    <?php

    ?>

    <section class="cartegory">

        <div class="container">
            <?php
            if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) :
                echo '<script> alert("Giỏ hàng của bạn chưa có món hàng nào");</script>';

            ?>
                <!-- truong hop khong sp -->
                <div class="product_noproduct">
                    <div class="product_cart-empty">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h5 class="product_empty">Bạn chưa chọn sản phẩm</h5>
                    <h5 class="product_back"><a href="index.php?controller=product&action=show">
                            << Quay lại trang chủ ?</a>
                    </h5>
                </div>
            <?php
            else :
            ?>
                <!-- truong hop co san pham -->
                <div class="product row">
                    <div class="product_detail">
                        <form action="index.php?controller=cart&action=update" method="post">
                            <table>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Màu</th>
                                    <th>Size</th>
                                    <th>SL</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                <?php
                                $i = 0;
                                foreach ($_SESSION['cart'] as $key => $item) :
                                    $i++;
                                ?>
                                    <tr>
                                    
                                        <td><img src="<?php echo './public/assets/image/' . $item['image']; ?>" alt=""></td>
                                        <td><?php echo $item['name'] ?></td>
                                        <td><?php echo number_format($item['price'] - $item['sale_off']); ?></td>
                                        <td><?php echo $item['color'] ?></td>
                                        <td><?php echo $item['size'] ?></td>
                                        <td><input type="number" style="width: 40px;" name="newqty[<?php echo $item['id'] ?>]" value="<?php echo $item['quantity']; ?>"></td>
                                        <td><button type="submit" class=""><i class="fas fa-pen"></i></button></td>
                                        <td><a href="index.php?controller=cart&action=delete&id=<?php echo $item['id']; ?>"><button type="button" id="button_remove" value=""><i class="fas fa-times"></i></button></a></td>

                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </form>
                    </div>
                    <div class="product_address">
                        <p class="product_address-title">Tổng tiền giỏ hàng</p>
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        Tổng sản phẩm
                                    </td>
                                    <td>
                                        <?php
                                        $countCart = 0;
                                        if (isset($_SESSION['cart'])) {
                                            $countCart = count($_SESSION['cart']);
                                        }
                                        ?>
                                        <?php echo $countCart; ?>
                                    </td>
                                </tr>
                                <tr class="line_table">
                                    <td>
                                        Thành tiền
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($_SESSION['cart'] as $key => $items) :
                                        ?>
                                            <?php echo $items['total'] . "<br>" ?>
                                        <?php endforeach; ?>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        Tổng hóa đơn
                                    </td>
                                    <td>
                                        <?php echo $_SESSION['totalCart']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        if (isset($_SESSION['login_id'])) {
                        ?>
                            <div class="product_payment">

                                <p class="product_address-payment">Bạn sẽ tiếp tục ở đây!</p>
                                <a class="" href="index.php?controller=checkout&action=store" id="button_payment"><i class="fas fa-dollar-sign"></i>Mua Hàng</a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            endif;
            ?>
        </div>


    </section>
    <section id="Slider"></section>
    <!--footer------------------------------------------------------------------------------>
</div>
<script>
    function confirmCart(){
        let text="Ban chac chan chu?"
        confirm(text);
    }
</script>
<?php $this->view('partials.frontend.footer',[]) ?> 