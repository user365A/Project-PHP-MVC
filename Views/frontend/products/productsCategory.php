<?php
$this->view('partials.frontend.header', [
    "menus" => $menus,
    "categories" => $categories
]) ?>


<div class="container-fluid">
    <!--cartegory--------------------------------------------------------------------------->
    <section class="cartegory ">
        <div class="cartegory_container">
            <div class="cartegory_top row">
                <p><a href="">Trang chủ</a></p><span>&#8594;</span>
                <p><a href="">Nữ</a></p><span>&#8594;</span>
                <p><a href="">Hàng nữ mới về</a></p>
            </div>
        </div>
        <div class="cartegory_container cartegory_container-left-all">
            <div class="row">
                <div class="cartegory_container-left">
                    <ul>
                        <li class="cartegory_left-item "><a class="cartegory_left-item-title" href="">Nữ</a>
                            <ul class="cartegory_left-item-list">
                                <li><a href="">Hàng nữ mới về</a></li>
                                <li><a href="">COLLECTION</a></li>
                                <li><a href="">ESSENTIAL SWEATSUIT</a></li>
                                <li><a href="">LIKE A GODDESS</a></li>
                            </ul>
                        </li>
                        <li class="cartegory_left-item "><a class="cartegory_left-item-title" href="">Nam</a>
                            <ul class="cartegory_left-item-list">
                                <li><a href="">Hàng nam mới về</a></li>
                                <li><a href="">NEW POLO FOR MEN</a></li>
                                <li><a href="">ESSENTIAL SWEATSUIT</a></li>
                                <li><a href="">SAFE ZONE</a></li>
                            </ul>
                        </li>
                        <li class="cartegory_left-item"><a class="cartegory_left-item-title" href="">Trẻ em</a>
                            <ul class="cartegory_left-item-list">
                                <li><a href="">Hàng nam mới về</a></li>
                                <li><a href="">NEW POLO FOR MEN</a></li>
                                <li><a href="">ESSENTIAL SWEATSUIT</a></li>
                                <li><a href="">SAFE ZONE</a></li>
                            </ul>
                        </li>
                        <li class="cartegory_left-item"><a class="cartegory_left-item-title" href="">Bộ sưu tập</a>
                            <ul class="cartegory_left-item-list">
                                <li><a href="">Hàng nam mới về</a></li>
                                <li><a href="">NEW POLO FOR MEN</a></li>
                                <li><a href="">ESSENTIAL SWEATSUIT</a></li>
                                <li><a href="">SAFE ZONE</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="cartegory_container-right row">
                    <div class="cartegory_container-right-top-item">

                    </div>
                    <div class="cartegory_container-right-top-item">
                        <button><span>Bộ lọc</span><i class="fas fa-sort-down"></i></button>

                    </div>
                    <div class="cartegory_container-right-top-item">
                        <?php if (isset($_GET['menuId'])) { ?>
                            <a style="color: red;font-size:small" href="index.php?controller=product&action=show&menuId=<?php echo $_GET['menuId']; ?>&order=desc&sortBy=price">
                                <option value="DESC">Giá cao đến thấp</option>
                            </a>
                            <a style="color: red;font-size:small" href="index.php?controller=product&action=show&menuId=<?php echo $_GET['menuId']; ?>&order=asc&sortBy=price">
                                <option value="ASC">Giá thấp đến cao</option>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="cartegory_container-right-list row">
                        <?php foreach ($products as $product) : ?>
                            <div class="cartegory_container-right-item">
                                <img src="<?php echo './public/assets/image/' . $product['image']; ?>" alt="">
                                <h2 class="cartegory_container-item-title"><a href="index.php?controller=product&action=showDetailProduct&id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h2>

                                <?php if ($product['sale_off'] == 0) { ?>
                                    <p class="cartegory_container-item-price"><sub><?php echo $product['price']; ?>đ</sub></p>
                                <?php } else { ?>
                                    <p class="cartegory_container-item-price-sale"><del><?php echo $product['price']; ?></del><sub>đ</sub></p>
                                    <p class="cartegory_container-item-price">Giảm còn:<?php echo ($product['price'] - $product['sale_off']); ?><sub>đ</sub></p>
                                <?php } ?>

                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php


                    ?>
                    <div class="cartegory-right-botton row">
                        <div class="cartegory-right-botton-item">

                        </div>
                        <div class="cartegory-right-botton_list">
                            <!-- Truong hop co menuId  -->
                            <?php if (isset($_GET['menuId'])) { ?>

                                <?php
                                if ($currentPage > 0 && $pages > 1) {
                                ?>
                                    <li class="cartegory-right-botton_list-item"><a href="index.php?controller=product&action=show&menuId=<?php echo $_GET['menuId'] ?>&page=<?php echo $currentPage-1; ?>">&#171;</a></li>
                                <?php
                                }
                                ?>

                                <?php
                                for ($i = 0; $i <= $pages - 1; $i++) {
                                ?>
                                    <li class="cartegory-right-botton_list-item"><a href="index.php?controller=product&action=show&menuId=<?php echo $_GET['menuId'] ?>&page=<?php echo $i; ?>"><?php echo $i + 1; ?></a></li>

                                <?php } ?>

                                <?php
                                if ($currentPage < $pages-1 && $pages > 1) {
                                ?>
                                    <li class="cartegory-right-botton_list-item"><a href="index.php?controller=product&action=show&menuId=<?php echo $_GET['menuId'] ?>&page=<?php echo $currentPage+1; ?>">&#187;</a></li>
                                <?php
                                }
                                ?>

                                <li class="cartegory-right-botton_list-item"><a href="index.php?controller=product&action=show&menuId=<?php echo $_GET['menuId'] ?>&page=<?php echo $pages-1; ?>">Trang cuối</a>

                                </li>

                                <!-- Truong hop san pham khuyen mai hoac search -->
                            <?php } else if ($_REQUEST['action'] != 'search') { ?>

                                <?php
                                if ($currentPage > 0 && $pages > 1) {
                                ?>
                                    <li class="cartegory-right-botton_list-item"><a href="index.php?controller=product&action=<?php echo $_REQUEST['action'] == 'show' ? 'show' : 'showPromotion'; ?>&page=<?php echo $currentPage-1; ?>">&#171;</a></li>
                                <?php
                                }
                                ?>
                                <?php
                                for ($i = 0; $i <= $pages - 1; $i++) {
                                ?>
                                    <li class="cartegory-right-botton_list-item"><a href="index.php?controller=product&action=<?php echo $_REQUEST['action'] == 'show' ? 'show' : 'showPromotion'; ?>&page=<?php echo $i; ?>"><?php echo $i + 1; ?></a></li>
                                <?php } ?>

                                <?php
                                if ($currentPage < $pages-1 && $pages > 1) {
                                ?>
                                    <li class="cartegory-right-botton_list-item"><a href="index.php?controller=product&action=<?php echo $_REQUEST['action'] == 'show' ? 'show' : 'showPromotion'; ?>&page=<?php echo $currentPage+1; ?>">&#187;</a></li>
                                <?php
                                }
                                ?>

                                <li class="cartegory-right-botton_list-item"><a href="index.php?controller=product&action=<?php echo $_REQUEST['action'] == 'show' ? 'show' : 'showPromotion'; ?>&page=<?php echo $pages-1; ?>">Trang cuối</a>

                                </li>

                            <?php
                            } else {
                            ?>


                            <?php } ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section id="Slider"></section>
    <!--footer------------------------------------------------------------------------------>
</div>

<?php $this->view('partials.frontend.footer', []) ?>