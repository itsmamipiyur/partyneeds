@extends('layouts.app')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection

@section('title')
  Equipment Type
@endsection

@section('content')
<h2>maintenance/Equipment Type</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Equipment Type</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createEquipmentType">Add Equipment Type</button>
      <br><br>
      <div class="pull-right">
        <label class="checkbox-inline">
      			<input type="checkbox" id="show_deletedType">
      			Show Deleted Items
      		</label>
      </div>
      <br>
      <table class="table table-hover" id="tblEquipmentType">
        <thead>
          <tr>
            <th>Equipment Type ID</th>
            <th>Equipment Type Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if(count($equipmentTypes) === 0)
            <tr>
              <td colspan="6" align="center"><strong>Nothing to show</strong></td>
            </tr>

          <!--IF tbl equipmentType is not null-->
          @else
            @foreach($equipmentTypes as $equipmentType)
              <tr>
                <td>{{ $equipmentType->strEquiTypeId }}</td>
                <td>{{ $equipmentType->strEquiTypeName }}</td>
                <td>{{ $equipmentType->created_at }}</td>
                <td>{{ $equipmentType->updated_at }}</td>
                <td>{{ $equipmentType->deleted_at }}</td>
                <td class="btn-group clearfix" align="center" nowrap>
                   <button type="button" value="{{ $equipmentType->strEquiTypeId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                   <a href="#edit{{ $equipmentType->strEquiTypeId }}" class="btn btn-info edit-detail" onclick="$('#edit{{$equipmentType->strEquiTypeId}}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                   @if(is_null($equipmentType->deleted_at))
                    <a href="#del{{$equipmentType->strEquiTypeId}}" class="btn btn-danger" onclick="$('#del{{$equipmentType->strEquiTypeId}}').modal('show')"><span class="glyphicon glyphicon-trash"></span></button>
                   @else
                    <a href="#restore{{$equipmentType->strEquiTypeId}}" class="btn btn-warning" onclick="$('#restore{{$equipmentType->strEquiTypeId}}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></button>
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

@if(count($equipmentTypes) > 0)
@foreach($equipmentTypes as $equipmentType)
<div id="del{{$equipmentType->strEquiTypeId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Equipment Type</h4>
        </div>
        <div class="modal-body">
          <h5>Are you sure to delete <strong>{{ $equipmentType->strEquiTypeName }}</strong>?</h5>
        </div>
        <div class="modal-footer">

          {!! Form::open(['url' => '/equipmentType/' . $equipmentType->strEquiTypeId, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
          {!! Form::close() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>

<div id="restore{{$equipmentType->strEquiTypeId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Restore Equipment Type</h4>
        </div>
        <div class="modal-body">
          <h5>Are you sure to restore <strong>{{ $equipmentType->strEquiTypeName }}</strong>?</h5>
        </div>
        <div class="modal-footer">
          {!! Form::open(['url' => '/equipmentType/equipmentType_restore']) !!}
            {{ Form::hidden('equipment_type_id', $equipmentType->strEquiTypeId) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
          {!! Form::close() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>

<div id="edit{{$equipmentType->strEquiTypeId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Equipment Type</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url' => 'equipmentType/equipmentType_update/']) !!}
          {{ Form::hidden('equipment_type_id', $equipmentType->strEquiTypeId) }}
          <div class="form-group">
          {{ Form::label('equipment_type_name', 'Equipment Type Name') }}
          {{ Form::text('equipment_type_name', $equipmentType->strEquiTypeName, ['placeholder' => 'Type Equipment Type Name', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_type_description', 'Description') }}
          {{ Form::textarea('equipment_type_description', $equipmentType->txtEquiTypeDesc, ['placeholder' => 'Type Equipment Type Description', 'class' => 'form-control']) }}
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

<div id="showEquiType" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Equipment Type Details</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          {{ Form::label('equipment_type_id', 'Equipment Type ID') }}
          {{ Form::text('equipment_type_id', '', ['class' => 'form-control', 'id' => 'equiTypeId', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_type_name', 'Equipment Type Name') }}
          {{ Form::text('equipment_type_name', '', ['class' => 'form-control', 'id' => 'equiTypeName', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_type_desc', 'Description') }}
          {{ Form::textarea('equipment_type_desc', '', ['class' => 'form-control', 'id' => 'equiTypeDesc', 'disabled' => 'true']) }}
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

        {!! Form::open(['url' => '/equipmentType']) !!}
          <div class="form-group">
          {{ Form::label('equipment_type_id', 'Equipment Type ID') }}
          {{ Form::text('equipment_type_id', $newTypeID, ['class' => 'form-control']) }}
          </div>

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

@section('js')
  <script>
    $(document).ready( function(){
      setTimeout(function(){
          $('.alert').fadeOut("slow");
      }, 2000);

      $('#maintenance').addClass("in");

      $('#equipmentType').addClass("active");

      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tblEquipmentType').DataTable();

      $('#show_deletedType').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deletedType:checked').length;
				if (!show_deleted) return aData[4] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/equipmentType') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#equiTypeId').val(data.strEquiTypeId);
            $('#equiTypeName').val(data.strEquiTypeName);
            $('#equiTypeDesc').val(data.txtEquiTypeDesc);
            $('#showEquiType').modal('show');
        })
      });
    });
  </script>
  @endsection
