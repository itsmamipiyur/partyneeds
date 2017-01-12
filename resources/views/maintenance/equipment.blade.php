@extends('layouts.admin')

@section('content')
<h2>maintenance/Equipment</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Equipment Type</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createEquipmentType">Add Equipment Type</button>
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Equipment Type ID</th>
            <th>Equipment Type Name</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>EQUIPTYPE0001</td>
            <td>Serving Equipment</td>
            <td>Catering Equipment</td>
            <td>
              lol
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Equipment List</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Equipment</button>
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Equipment ID</th>
            <th>Equipment Name</th>
            <th>Equipment Type</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>EQUIP0001</td>
            <td>Trays</td>
            <td>Serving Equipment</td>
            <td>
              lol
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Equipment</h4>
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

        {!! Form::open(['url' => '/equipment']) !!}
          <div class="form-group">
          {{ Form::label('equip_name', 'Equipment Name') }}
          {{ Form::text('equip_name', '', ['placeholder' => 'Example: Trays', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('equip_type', 'Equipment Type') }}
          {{ Form::text('equip_type', '', ['placeholder' => 'Example: Serving Equipment', 'class' => 'form-control']) }}
          </div>

          <div class="control-group">
          {{ Form::label('equip_type', 'Equipment Type', ['class' => 'control-label']) }}
          {{ Form::select('equip_type', $type, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'form-control', 'id' => 'category']) }}
          </div>
        </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<div id="createEquipmentType" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Equipment Type</h4>
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

        {!! Form::open(['url' => '/equiptype']) !!}
          <div class="form-group">
          {{ Form::label('equipment_type_name', 'Equipment Type Name') }}
          {{ Form::text('equipment_type_name', '', ['placeholder' => 'Example: Serving Equipment', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('equipment_type_description', 'Equipment Type Description') }}
          {{ Form::textarea('equipment_type_description', '', ['placeholder' => 'Type the description', 'class' => 'form-control']) }}
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
