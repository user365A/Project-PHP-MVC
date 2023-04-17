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
        <a href="index.php?controller=user&action=create"  class="btn btn-primary  m-2">Add</a>

            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr style="background-color:darkgray">
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($users as $user): ?>
                      <tr>
                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo $user['name'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['address'] ?></td>
                        <td><?php echo $user['phone'] ?></td>
                        <td>
                            <a href="javascript:delete_record('user',<?php echo $user['id'] ?>)" data-url="" class="btn btn-danger action_delete">Delete</a>
                            <a href="index.php?controller=user&action=edit&id=<?php echo $user['id'] ?>"  class="btn btn-primary">Edit</a>
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