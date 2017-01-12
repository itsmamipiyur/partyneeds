@extends('layouts.admin')

@section('content')

<h2>maintenance/Customer</h2>
<hr size="5">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Customer List</h3>
  </div>
  <div class="panel-body">
    <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#create">Add Customer</button>
    <br><br>
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
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['url' => '/customer']) !!}
          <div class="form-group">
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', '', ['placeholder' => 'Example: Juan', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('middle_name', 'Middle Name') }}
          {{ Form::text('middle_name', '', ['placeholder' => 'Example: Dela', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', '', ['placeholder' => 'Example: Cruz', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('address', 'Address') }}
          {{ Form::textarea('address', '', ['placeholder' => 'Example: 123 Rizal Ave., Tondo, Manila', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('contact', 'Contact Number') }}
          {{ Form::text('contact', '', ['placeholder' => 'Example: 09225458545', 'class' => 'form-control']) }}
          </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
