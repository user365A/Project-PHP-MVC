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
        <a href="index.php?controller=category&action=create"  class="btn btn-primary  m-2">Add</a>

            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr style="background-color:darkgray">
                        <th>Id</th>
                        <th>Name</th>
                        <th>MenuID</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($categories as $category): ?>
                      <tr>
                        <td><?php echo $category['id'] ?></td>
                        <td><?php echo $category['name'] ?></td>
                        <td><?php echo $category['menu_id'] ?></td>
                        <td>
                            <a href="javascript:delete_record('category',<?php echo $category['id'] ?>)" data-url="" class="btn btn-danger action_delete">Delete</a>
                            <a href="index.php?controller=category&action=edit&id=<?php echo $category['id'] ?>"  class="btn btn-primary">Edit</a>
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