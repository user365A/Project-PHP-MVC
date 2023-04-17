<?php
$this->view('partials.backend.header');
$this->view('partials.backend.sidebar')
?>

<div class="content-wrapper">

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="container mt-3">
          <div class="col-md-12">
            <div class="container">
              <h5 style="color: green;"><b>Customer Information<b></h5>
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action"><?php echo $customerInfo['name']; ?></a>
                <a href="#" class="list-group-item list-group-item-action"><?php echo $customerInfo['email']; ?></a>
                <a href="#" class="list-group-item list-group-item-action"><?php echo $customerInfo['address']; ?></a>
                <a href="#" class="list-group-item list-group-item-action"><?php echo $customerInfo['phone']; ?></a>
              </div>
              <br>
            </div>
          </div>
          <div class="col-md-12">
            <table class="table table-bordered">
              <thead>
                <tr style="background-color:darkgray">
                  <th>ProductName</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Color</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($detailcheckout as $index => $Item) : ?>
                  <tr>
                    <td><?php echo $Item['name'] ?></td>
                    <td><img src="../public/assets/image/<?php echo $Item['image'] ?>" width="200" height="200" alt=""></td>
                    <td><?php echo $Item['price'] ?></td>
                    <td><?php echo $Item['size'] ?></td>
                    <td><?php echo $Item['color'] ?></td>
                    <td><?php echo $Item['quantity'] ?></td>
                    <td><?php echo $Item['total'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="col-md-12">

          </div>
        </div>

      </div>

    </div>
  </div>

</div>

<?php
$this->view('partials.backend.footer')
?>