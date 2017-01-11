<?php $__env->startSection('content'); ?>

<h2>maintenance/Customer</h2>
<hr size="5">

<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Customer</button>
<br><br>

<div class="panel panel-default">
  <div class="panel-body">
    <table class="table table-hover" id="tblBranch">
      <thead>
        <tr>
          <th>Customer ID</th>
          <th>Customer Name</th>
          <th>Customer Address</th>
          <th>Contact Number</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>CUST0001</td>
          <td>Ate Girl</td>
          <td>Tondo, Manila</td>
          <td>02985685</td>
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
        <h4 class="modal-title">Add Customer</h4>
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

        <?php echo Form::open(['url' => '/customer']); ?>

          <div class="form-group">
          <?php echo e(Form::label('first_name', 'First Name')); ?>

          <?php echo e(Form::text('first_name', '', ['placeholder' => 'Example: Juan', 'class' => 'form-control'])); ?>

          </div>

          <div class="form-group">
          <?php echo e(Form::label('middle_name', 'Middle Name')); ?>

          <?php echo e(Form::text('middle_name', '', ['placeholder' => 'Example: Dela', 'class' => 'form-control'])); ?>

          </div>

          <div class="form-group">
          <?php echo e(Form::label('last_name', 'Last Name')); ?>

          <?php echo e(Form::text('last_name', '', ['placeholder' => 'Example: Cruz', 'class' => 'form-control'])); ?>

          </div>

          <div class="form-group">
          <?php echo e(Form::label('address', 'Address')); ?>

          <?php echo e(Form::textarea('address', '', ['placeholder' => 'Example: 123 Rizal Ave., Tondo, Manila', 'class' => 'form-control'])); ?>

          </div>

          <div class="form-group">
          <?php echo e(Form::label('contact', 'Contact Number')); ?>

          <?php echo e(Form::text('contact', '', ['placeholder' => 'Example: 09225458545', 'class' => 'form-control'])); ?>

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