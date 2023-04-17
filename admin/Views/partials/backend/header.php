<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/adminlte/dist/css/adminlte.min.css">

    <script type="text/javascript">
    function delete_record(controller,id)
    {
        if (confirm('Are You Sure to Delete this Record?'))
        {
            window.location.href = 'index.php?controller='+controller+'&action=delete&id=' + id;
        }
    }
    </script>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
            <!-- Left navbar links -->

            <!-- SEARCH FORM -->
            <form class="form-inline" method="get" action="">

                <div class="form-group mx-sm-2 mb-2">
                    <label class="sr-only"> Nhập ID </label>
                    <input type="text" class="form-control" name="product_id" value="" placeholder="Nhập Id">
                </div>

                <div class="form-group mx-sm-2 mb-2">
                    <label class="sr-only"> Nhập tên sản phẩm </label>
                    <input type="text" value="" class="form-control" placeholder="Nhập tên sản phẩm" name="name">
                </div>

                <div class="form-group mx-sm-2 mb-2">
                    <label class="sr-only"> Nhập tags sản phẩm </label>
                    <input type="text" value="" class="form-control" placeholder="Nhập tags sản phẩm" name="tags">
                </div>

                <div class="form-group mx-sm-2 mb-2">
                    <label class="sr-only"> Nhập tên sản phẩm </label>
                    <select class="form-control" name="category_id">
                        <option value="">Chọn danh mục sản phẩm</option>

                    </select>
                </div>


                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->