@extends('layouts.app')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection

@section('title')
  Event Type
@endsection

@section('content')

<h2>maintenance/Event Type</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Event Type</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createEventType">Add Event Type</button>
      <br><br>
      <div class="pull-right">
        <label class="checkbox-inline">
      			<input type="checkbox" id="show_deleted">
      			Show Deleted Items
      		</label>
      </div>
      <br>
      <table class="table table-hover" id="tbleventtype">
        <thead>
          <tr>
            <th>Event Type ID</th>
            <th>Event Type Name</th>

            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>

            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>EVNTTYPE0001</td>
            <td>Birthday</td>
            <td>
              lol
            </td>
          </tr>
          @if(count($eventTypes) == 0)
            <tr>
              <td colspan="6" align="center"><strong>Nothing to show</strong></td>
            </tr>
          @else
            @foreach($eventTypes as $eventType)
              <tr>
                <td>{{ $eventType->strEvenTypeId }}</td>
                <td>{{ $eventType->strEvenTypeName }}</td>
                <td>{{ $eventType->created_at }}</td>
                <td>{{ $eventType->updated_at }}</td>
                <td>{{ $eventType->deleted_at }}</td>
                <td class="btn-group clearfix" align="center" nowrap>
                  <button type="button" value="{{ $eventType->strEvenTypeId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                  <a href="#edit{{ $eventType->strEvenTypeId }}" class="btn btn-info edit-detail" onclick="$('#edit{{ $eventType->strEvenTypeId }}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                  @if(is_null($eventType->deleted_at))
                   <a href="#del{{$eventType->strEvenTypeId}}" class="btn btn-danger" onclick="$('#del{{$eventType->strEvenTypeId}}').modal('show')"><span class="glyphicon glyphicon-trash"></span></button>
                  @else
                   <a href="#restore{{$eventType->strEvenTypeId}}" class="btn btn-warning" onclick="$('#restore{{$eventType->strEvenTypeId}}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></button>
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

@if(count($eventTypes) > 0)
  @foreach($eventTypes as $eventType)
  <div id="del{{$eventType->strEvenTypeId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Event Type</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to delete <strong>{{ $eventType->strEvenTypeName }}</strong>?</h5>
          </div>
          <div class="modal-footer">

            {!! Form::open(['url' => '/eventType/' . $eventType->strEvenTypeId, 'method' => 'delete']) !!}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="restore{{$eventType->strEvenTypeId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Restore Event Type</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to restore <strong>{{ $eventType->strEvenTypeName }}</strong>?</h5>
          </div>
          <div class="modal-footer">
            {!! Form::open(['url' => '/eventType/eventType_restore']) !!}
              {{ Form::hidden('event_type_id', $eventType->strEvenTypeId) }}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="edit{{$eventType->strEvenTypeId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Event Type</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['url' => 'eventType/eventType_update/']) !!}
            {{ Form::hidden('event_type_id', $eventType->strEvenTypeId) }}
            <div class="form-group">
            {{ Form::label('event_type_name', 'Event Type Name') }}
            {{ Form::text('event_type_name', $eventType->strEvenTypeName, ['placeholder' => 'Type Event Type Name', 'class' => 'form-control']) }}
            </div>

            <div class="form-group">
            {{ Form::label('event_type_description', 'Description') }}
            {{ Form::textarea('event_type_description', $eventType->strEvenTypeDesc, ['placeholder' => 'Type Event Type Description', 'class' => 'form-control']) }}
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
<div id="createEventType" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Event Type</h4>
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

        {!! Form::open(['url' => '/eventType']) !!}
          <div class="form-group">
          {{ Form::label('event_type_id', 'Event Type ID') }}
          {{ Form::text('event_type_id', $newID, ['placeholder' => 'Example: EVNTYPE0000', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('event_type_name', 'Event Type Name') }}
          {{ Form::text('event_type_name', '', ['placeholder' => 'Type Event Type Name', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('event_type_description', 'Event Type Description') }}
          {{ Form::textarea('event_type_description', '', ['placeholder' => 'Type the description', 'class' => 'form-control']) }}
          </div>
        </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div id="showEventType" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Event Type Details</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          {{ Form::label('category_id', 'Equipment Type ID') }}
          {{ Form::text('category_id', '', ['class' => 'form-control', 'id' => 'eventTypeId', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('category_name', 'Equipment Type Name') }}
          {{ Form::text('category_name', '', ['class' => 'form-control', 'id' => 'eventTypeName', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('category_description', 'Description') }}
          {{ Form::textarea('category_description', '', ['class' => 'form-control', 'id' => 'eventTypeDesc', 'disabled' => 'true']) }}
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
      $('#eventType').addClass("active");
      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tbleventtype').DataTable();

      $('#show_deleted').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deleted:checked').length;
				if (!show_deleted) return aData[4] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/eventType') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#eventTypeId').val(data.strEvenTypeId);
            $('#eventTypeName').val(data.strEvenTypeName);
            $('#eventTypeDesc').val(data.txtEvenTypeDesc);
            $('#showEventType').modal('show');
        })
      });
    });
  </script>
@endsection
