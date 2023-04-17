<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="./public/css/style.css">

    <title>Fashion Shop</title>
</head>

<body>

    <header class="header_app">

        <div class="logo">
            <a href="index.php?"><img src="https://pubcdn.ivymoda.com/images/logo.png" alt=""></a>
        </div>
        <div class="menu">
            <div class="header_menu-text">
                <li>
                    <span class="header_menu-text-title-all"> <a href="index.php?controller=product&action=show">Sản phẩm mới nhất</a></span>
                </li>
            </div>
            <?php foreach ($menus as $index => $menu) : ?>
                <div class="header_menu-text">
                    <li><span class="header_menu-text-title-all"> <a href="index.php?controller=product&action=show&menuId=<?php echo $menu['id']; ?>"><?php echo ucfirst($menu['name']) ?></a></span>
                        <ul class="sub-menu">
                            <?php foreach ($categories as $category) : ?>
                                <li class="sub-menu-item"><a href=""><span class="header_menu-text-title"><?php echo $category['menu_id'] == $menu['id'] ? $category['name'] : '' ?></span>
                                    </a></li>
                            <?php endforeach;  ?>
                        </ul>
                    </li>
                </div>
            <?php endforeach; ?>
            <div class="header_menu-text">
                <li>
                    <span class="header_menu-text-title-all"> <a href="index.php?controller=product&action=showPromotion">Khuyến mãi</a></span>
                </li>
            </div>

        </div>

        <div class="other">
            <li>
                <form action="index.php?controller=product&action=search" method="POST">
                    <div class="input-group">
                        <input type="text" name="searchtext" class="form-control" placeholder="Search product">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </li>
            <li>
                <div class="header-other_search-list">
                    <a href="index.php?controller=customer&action=login_view"><i class="fas fa-sign-in-alt header-other_search-icon"></i></a>
                </div>
            </li>
            <?php
            if (isset($_SESSION['login_id'])) {
            ?>
                <li>
                    <div class="header-other_search-list">
                        <a href="index.php?controller=customer&action=logout"><i class="fas fa-sign-out-alt header-other_search-icon"></i></a>
                    </div>
                </li>
            <?php
            }
            ?>
            <li>
                <div class="header-other_search-list">
                    <a href="index.php?controller=customer&action=register_view"><i class="fa fa-user header-other_search-icon" aria-hidden="true"></i></a>
                </div>
            </li>
            <li>
                <div class="header-other_search-list">
                    <a href="index.php?controller=cart&action=index"><i class="fa fa-shopping-bag header-other_search-icon"></i>
                        <?php if (!empty($_SESSION['cart'])) { ?>
                            <span style="color: red; margin-top: 20px; margin-left: 0px;font-size: 14px;">(<?php echo count($_SESSION['cart']); ?>)</span>
                        <?php } ?>
                    </a>

                </div>
            </li>

        </div>
    </header>

