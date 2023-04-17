<?php 
$this->view('partials.frontend.header',[
    "menus"=>$menus,
    "categories"=>$categories
]) ?>

<div class="container-fluid">
    <!-- produc details -->
    <section class="cartegory">
        <div class="cartegory_container">
            <div class="cartegory_top row">
                <p><a href="">Trang chủ</a></p><span>&#8594;</span>
                <p><a href="">Nữ</a></p><span>&#8594;</span>
                <p><a href="">Hàng nữ mới về</a></p>
            </div>
        </div>
        <?php
        ?>
        <form action="index.php?controller=cart&action=store" method="post">
            <div class="product_details row">

                <div class="product_lert">
                    <img src="<?php echo './public/assets/image/' . $product['image']; ?>" alt="">
                </div>

                <div class="product_right">

                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>"/>
                    <p class="product_title" style="color: red;"><?php echo $product['name'] ?></p>
                    <p class="product_price"><?php echo number_format($product['price']-$product['sale_off']) ?><sub>đ</sub></p>
                    <div class="product_select">
                        <p class="select_title">Màu sắc :</p>
                        <select name="color" id="" class="select_color" style="width:200px;">
                            <?php foreach($colors as $color): ?>
                                <option value="<?php echo $color['color'] ?>" class="select_item"><?php echo $color['color'] ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="product_details-size">
                    <p class="select_title">Size :</p>
                        <select name="size" id="" class="select_color" style="width:200px;">
                            <!-- <option value="">Màu sắc</option> -->
                            <?php foreach($sizes as $size): ?>
                                <option value="<?php echo $size['size'] ?>" class="select_item"><?php echo $size['size'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <p class="product_detailsValue">
                        <span class="product_detailsValue-title">Số lượng</span>
                       
                        <input type="number" id="quantity" name="quantity" min="1" max="100" value="1" size="10" />
                    </p>
                    <h5 style="color: red;"><?php echo isset($message)? $message : '';?></h5>
                    <?php 
                       if($total_quantity>0):
                    ?>
                    <button type="submit" class="product_button">
                        <i class="fa fa-shopping-basket product_button-icon"></i><span class="product_button-title">Mua
                            hàng</span>
                    </button>
                    <?php
                     else :
                    ?>
                       <h4 style="color: red;">Mặt hàng hiện đã hết</h4>
                    <?php
                    endif;
                    ?>
                    <ul class="phone_chat">
                        <div class="phone_chat-list">
                            <li class="phone_chat-item"><i class="fas fa-phone-volume"></i><a href=""> Hotline</a></li>

                            <li class="phone_chat-item"><i class="fas fa-comments"></i><a href="">Chat</a></li>

                            <li class="phone_chat-item"><i class="far fa-envelope"></i><a href="">Mail</a></li>

                        </div>
                    </ul>

                    <div class="product_details-code-qr">
                        <a href="">
                            <img src="https://pubcdn.ivymoda.com/images/qrcode2.png" alt="">
                        </a>
                    </div>
                    <hr>
                    <p class="content_details">
                        Chi tiết sản phẩm:
                    </p>
                    <hr id="line">
                    <p class="content_details-product">
                        <span class="content_details-product-title">
                            <?php echo $product['des']; ?>
                        </span>
                    </p>

                </div>
            </div>
        </form>
    </section>
    <section >
            <?php if(isset($_SESSION['login_id'])){ ?>
            <div class="mt-4 ml-5" >
                
                <p>Nhập bình luận:</p>
                <form action="index.php?controller=customer&action=comment&id=<?php echo $product['id'];?>" method="post">
                    <input type="hidden" name="txtproductid" value="<?php echo $product['id'];?>" />
                    <textarea class="input-field" type="text" name="comment" rows="2" cols="70" id="comment"></textarea><br>
                    <input type="submit" class="btn btn-primary"  value="Bình Luận" />
                </form>
                <br>
                <p>Các bình luận :</p>
                   <?php if($comments) { ?>
                   <?php foreach($comments as $comment):?>
                    <div class="comment_list">
                        <?php echo $comment['content']; ?>
                    </div>
                    <div class="">
                    <?php echo $comment['name']; ?>
                    </div>
                   <?php endforeach; ?>
                   <?php } ?>
            </div>
            <?php } ?>

    </section>
    <section id="Slider"></section>
    <!--footer------------------------------------------------------------------------------>

</div>

<?php $this->view('partials.frontend.footer',[]) ?> 