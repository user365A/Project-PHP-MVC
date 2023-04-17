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
        <a href="index.php?controller=menu&action=create"  class="btn btn-primary  m-2">Add</a>

            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr style="background-color:darkgray">
                        <th>Id</th>
                        <th>Menu</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($menus as $menu): ?>
                      <tr>
                        <td><?php echo $menu['id'] ?></td>
                        <td><?php echo $menu['name'] ?></td>
                        <td>
                            <a href="javascript:delete_record('menu',<?php echo $menu['id'] ?>)" data-url="" class="btn btn-danger action_delete">Delete</a>
                            <a href="index.php?controller=menu&action=edit&id=<?php echo $menu['id'] ?>"  class="btn btn-primary">Edit</a>
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