@extends('layouts.app')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection

@section('title')
  Equipment
@endsection

@section('content')
<h2>maintenance/Equipment</h2>
<hr size="5">

<!--EQUIPMENT-->
<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Equipment List</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Equipment</button>
      <br><br>
      <div class="pull-right">
        <label class="checkbox-inline">
      			<input type="checkbox" id="show_deletedType">
      			Show Deleted Items
      		</label>
      </div>
      <br>
      <table class="table table-hover" id="tblEquipment">
        <thead>
          <tr>
            <th>Equipment ID</th>
            <th>Equipment Name</th>
            <th>Equipment Type</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if(count($equipments) === 0)
            <tr>
              <td colspan="7" align="center"><strong>Nothing to show</strong></td>
            </tr>

          <!--IF tbl equipmentType is not null-->
          @else
            @foreach($equipments as $equipment)
              <tr>
                <td>{{ $equipment->strEquiId }}</td>
                <td>{{ $equipment->strEquiName }}</td>
                <td>{{ $equipment->equipmentType->strEquiTypeName }}</td>
                <td>{{ $equipment->created_at }}</td>
                <td>{{ $equipment->updated_at }}</td>
                <td>{{ $equipment->deleted_at }}</td>
                <td class="btn-group clearfix" align="center" nowrap>
                   <button type="button" value="{{ $equipment->strEquiId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                   <a href="#edit{{ $equipment->strEquiId }}" class="btn btn-info edit-detail" onclick="$('#edit{{$equipment->strEquiId}}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                   @if(is_null($equipment->deleted_at))
                    <a href="#del{{$equipment->strEquiId}}" class="btn btn-danger" onclick="$('#del{{$equipment->strEquiId}}').modal('show')"><span class="glyphicon glyphicon-trash"></span></button>
                   @else
                    <a href="#restore{{$equipment->strEquiId}}" class="btn btn-warning" onclick="$('#restore{{$equipment->strEquiId}}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></button>
                  @endif
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

@if(count($equipments) > 0)
  @foreach($equipments as $equipment)
  <div id="del{{$equipment->strEquiId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Equipment</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to delete <strong>{{ $equipment->strEquiName }}</strong>?</h5>
          </div>
          <div class="modal-footer">

            {!! Form::open(['url' => '/equipment/' . $equipment->strEquiId, 'method' => 'delete']) !!}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="restore{{ $equipment->strEquiId }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Restore Equipment</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to restore <strong>{{ $equipment->strEquiName }}</strong>?</h5>
          </div>
          <div class="modal-footer">
            {!! Form::open(['url' => '/equipment/equipment_restore']) !!}
              {{ Form::hidden('equipment_id', $equipment->strEquiId) }}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="edit{{$equipment->strEquiId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Equipment</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['url' => 'equipment/equipment_update/']) !!}
            {{ Form::hidden('equipment_id', $equipment->strEquiId) }}

            <div class="form-group">
            {{ Form::label('equipment_name', 'Equipment Name') }}
            {{ Form::text('equipment_name', $equipment->strEquiName, ['placeholder' => 'Example: Trays', 'class' => 'form-control']) }}
            </div>

            <div class="control-group">
            {{ Form::label('equipment_type', 'Equipment Type', ['class' => 'control-label']) }}
            {{ Form::select('equipment_type', $equiTypes, $equipment->strEquiEquiTypeId, ['placeholder' => 'Choose Equipment Type', 'class' => 'form-control', 'id' => 'category']) }}
            </div>

            <div class="form-group">
            {{ Form::label('equipment_description', 'Equipment Description') }}
            {{ Form::textarea('equipment_description', $equipment->txtEquiDesc, ['placeholder' => 'Type Equipment Description', 'class' => 'form-control']) }}
            </div>
        </div>
        <div class="modal-footer">
          {{ Form::button('Update', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endif


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
          {{ Form::label('equipment_id', 'Equipment ID') }}
          {{ Form::text('equipment_id', $newID, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_name', 'Equipment Name') }}
          {{ Form::text('equipment_name', '', ['placeholder' => 'Example: Trays', 'class' => 'form-control']) }}
          </div>

          <div class="control-group">
          {{ Form::label('equipment_type', 'Equipment Type', ['class' => 'control-label']) }}
          {{ Form::select('equipment_type', $equiTypes, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'form-control', 'id' => 'category']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_description', 'Equipment Description') }}
          {{ Form::textarea('equipment_description', '', ['placeholder' => 'Type Equipment Description', 'class' => 'form-control']) }}
          </div>
        </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div id="showEqui" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Equipment Details</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          {{ Form::label('equipment_id', 'Equipment ID') }}
          {{ Form::text('equipment_id', '', ['class' => 'form-control', 'id' => 'equipmentId', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_name', 'Equipment Name') }}
          {{ Form::text('equipment_name', '', ['class' => 'form-control', 'id' => 'equipmentName', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_type', 'Equipment Type') }}
          {{ Form::text('equipment_type', '', ['class' => 'form-control', 'id' => 'equipmentTypess', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_description', 'Description') }}
          {{ Form::textarea('equipment_description', '', ['class' => 'form-control', 'id' => 'equipmentDesc', 'disabled' => 'true']) }}
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
  <script>
    $(document).ready( function(){
      setTimeout(function(){
          $('.alert').fadeOut("slow");
      }, 2000);

      $('#maintenance').addClass("in");

      $('#equipment').addClass("active");

      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tblEquipment').DataTable();

      $('#show_deletedType').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deletedType:checked').length;
				if (!show_deleted) return aData[5] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/equipment') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#equipmentId').val(data.strEquiId);
            $('#equipmentName').val(data.strEquiName);
            $('#equipmentDesc').val(data.txtEquiDesc);
            $('#equipmentTypess').val(data.strEquiTypeName);
            $('#showEqui').modal('show');
        })
      });
    });
  </script>
  @endsection
