@extends('layouts.app')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection


@section('title')
  Drink
@endsection

@section('content')

<h2>maintenance/Drink</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Drink List</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createDrink">Add Drink</button>
      <br><br>
      <div class="pull-right">
        <label class="checkbox-inline">
      			<input type="checkbox" id="show_deleted">
      			Show Deleted Items
      		</label>
      </div>
      <br>
      <table class="table table-hover" id="tblDrink">
        <thead>
          <tr>
            <th>Drink ID</th>
            <th>Drink Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if(count($drinks) == 0)
            <tr>
              <td colspan="6" align="center">
                <strong>Nothing to show.</strong>
              </td>
            </tr>
          @else
            @foreach($drinks as $drink)
              <tr>
                <td>{{ $drink->strDrinkId }}</td>
                <td>{{ $drink->strDrinkName }}</td>
                <td>{{ $drink->created_at }}</td>
                <td>{{ $drink->updated_at }}</td>
                <td>{{ $drink->deleted_at }}</td>
                <td class="btn-group clearfix" align="center" nowrap>
                   <button type="button" value="{{ $drink->strDrinkId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                   <a href="#edit{{ $drink->strDrinkId }}" class="btn btn-info edit-detail" onclick="$('#edit{{$drink->strDrinkId}}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                   @if(is_null($drink->deleted_at))
                    <a href="#del{{$drink->strDrinkId}}" class="btn btn-danger" onclick="$('#del{{$drink->strDrinkId}}').modal('show')"><span class="glyphicon glyphicon-trash"></span></button>
                   @else
                    <a href="#restore{{$drink->strDrinkId}}" class="btn btn-warning" onclick="$('#restore{{$drink->strDrinkId}}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></button>
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

@if(count($drinks) > 0)
@foreach($drinks as $drink)
<div id="del{{$drink->strDrinkId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Drink</h4>
        </div>
        <div class="modal-body">
          <h5>Are you sure to delete <strong>{{ $drink->strDrinkName }}</strong>?</h5>
        </div>
        <div class="modal-footer">

          {!! Form::open(['url' => '/drink/' . $drink->strDrinkId, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
          {!! Form::close() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>

<div id="restore{{$drink->strDrinkId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Restore Drink</h4>
        </div>
        <div class="modal-body">
          <h5>Are you sure to restore <strong>{{ $drink->strDrinkName }}</strong>?</h5>
        </div>
        <div class="modal-footer">
          {!! Form::open(['url' => '/drink/drink_restore']) !!}
            {{ Form::hidden('drink_id', $drink->strDrinkId) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
          {!! Form::close() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>

<div id="edit{{$drink->strDrinkId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Drink</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url' => 'drink/drink_update/']) !!}
          {{ Form::hidden('drink_id', $drink->strDrinkId) }}
          <div class="form-group">
          {{ Form::label('drink_name', 'Drink Name') }}
          {{ Form::text('drink_name', $drink->strDrinkName, ['placeholder' => 'Type Drink Name', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('drink_description', 'Description') }}
          {{ Form::textarea('drink_description', $drink->txtDrinkDesc, ['placeholder' => 'Type Drink Description', 'class' => 'form-control']) }}
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


<div id="createDrink" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Drink</h4>
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

        {!! Form::open(['url' => '/drink']) !!}
          <div class="form-group">
          {{ Form::label('drink_id', 'Drink ID') }}
          {{ Form::text('drink_id', $newID, ['placeholder' => 'Example: DNK0000', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('drink_name', 'Drink Name') }}
          {{ Form::text('drink_name', '', ['placeholder' => 'Example: Iced Tea', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('drink_description', 'Drink Description') }}
          {{ Form::textarea('drink_description', '', ['placeholder' => 'Type the description', 'class' => 'form-control']) }}
          </div>
        </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div id="showDrink" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Drink Details</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          {{ Form::label('equipment_type_id', 'Drink ID') }}
          {{ Form::text('equipment_type_id', '', ['class' => 'form-control', 'id' => 'drinkId', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_type_name', 'Drink Name') }}
          {{ Form::text('equipment_type_name', '', ['class' => 'form-control', 'id' => 'drinkName', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('equipment_type_desc', 'Description') }}
          {{ Form::textarea('equipment_type_desc', '', ['class' => 'form-control', 'id' => 'drinkDesc', 'disabled' => 'true']) }}
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

      $('#drink').addClass("active");

      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tblDrink').DataTable();

      $('#show_deleted').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deleted:checked').length;
				if (!show_deleted) return aData[4] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/drink') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#drinkId').val(data.strDrinkId);
            $('#drinkName').val(data.strDrinkName);
            $('#drinkDesc').val(data.txtDrinkDesc);
            $('#showDrink').modal('show');
        })
      });
    });
  </script>
  @endsection
