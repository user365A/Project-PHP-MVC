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

            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr style="background-color:darkgray">
                        <th>Id</th>
                        <th>CustomerID</th>
                        <th>OrderDate</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($orders as $order): ?>
                      <tr>
                        <td><?php echo $order['id'] ?></td>
                        <td><?php echo $order['customer_id'] ?></td>
                        <td><?php echo $order['order_date'] ?></td>
                        <td><?php echo $order['total'] ?></td>
                        <td><?php echo $order['status'] ?></td>
                        <td>
                            <a href="index.php?controller=checkout&action=showDetail&id=<?php echo $order['id'] ?>"  class="btn btn-warning">View</a>
                            <a href="javascript:delete_record('checkout',<?php echo $order['id'] ?>)" data-url="" class="btn btn-danger action_delete">Delete</a>
                        </td>
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