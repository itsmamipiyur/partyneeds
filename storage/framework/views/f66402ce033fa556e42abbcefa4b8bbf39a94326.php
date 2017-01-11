<?php $__env->startSection('content'); ?>

<h2>maintenance/Menu</h2>
<hr size="5">

<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Food</button>
<br><br>

<div class="panel panel-default">
  <div class="panel-body">
    <table class="table table-hover" id="tblBranch">
      <thead>
        <tr>
          <th>Food ID</th>
          <th>Food Name</th>
          <th>Food Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>FOOD0001</td>
          <td>Menudo</td>
          <td>Filipino Dish</td>
          <td>
            lol
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Menu</h4>
      </div>
      <div class="modal-body">
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo Form::open(['url' => '/menu']); ?>

          <div class="form-group">
          <?php echo e(Form::label('food_name', 'Food Name')); ?>

          <?php echo e(Form::text('food_name', '', ['placeholder' => 'Example: Chicken Curry', 'class' => 'form-control'])); ?>

          </div>


          <div class="form-group">
          <?php echo e(Form::label('food_desc', 'Food Description')); ?>

          <?php echo e(Form::text('food_desc', '', ['placeholder' => 'Example: Masarap', 'class' => 'form-control'])); ?>

          </div>

          <div class="control-group">
          <?php echo e(Form::label('food_category', 'Category', ['class' => 'control-label'])); ?>

          <?php echo e(Form::select('food_category', $categories, null, ['placeholder' => 'Choose Food Category', 'class' => 'form-control', 'id' => 'category'])); ?>

          </div>
        </div>
      <div class="modal-footer">
        <?php echo e(Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save'])); ?>

      <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>