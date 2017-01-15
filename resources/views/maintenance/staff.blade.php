@extends('layouts.app')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection

@section('title')
  Staff
@endsection


@section('content')

<h2>maintenance/Staff</h2>
<hr size="5">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Staff List</h3>
  </div>
  <div class="panel-body">
    <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#create">Add Staff</button>
    <br><br>
    <div class="pull-right">
      <label class="checkbox-inline">
    			<input type="checkbox" id="show_deleted">
    			Show Deleted Items
    		</label>
    </div>
    <br>

    <table class="table table-hover" id="tblStaff">
      <thead>
        <tr>
          <th>Staff ID</th>
          <th>Staff Name</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Deleted At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!--IF tbl staff is null-->
        @if($staffs->count() == 0)
          <tr>
            <td colspan="8" align="center"><strong>Nothing to show</strong></td>
          </tr>

        <!--IF tbl staff is not null-->
        @else
          @foreach($staff as $staff)
            <tr>
              <td>{{ $staff->strStafId }}</td>
              <td>{{ $staff->strStafFirst .' '. $staff->strStafMiddle .' '.$staff->strStafLast  }}</td>
              <td>{{ $staff->created_at }}</td>
              <td>{{ $staff->updated_at }}</td>
              <td>{{ $staff->deleted_at }}</td>
              <td class="btn-group clearfix" align="center" nowrap>
                 <button type="button" value="{{ $staff->strStafId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                 <a href="#edit{{ $staff->strStafId }}" class="btn btn-info edit-detail" onclick="$('#edit{{$staff->strStafId}}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                 @if(is_null($staff->deleted_at))
                  <a href="#del{{$staff->strStafId}}" class="btn btn-danger" onclick="$('#del{{$staff->strStafId}}').modal('show')"><span class="glyphicon glyphicon-trash"></span></a>
                 @else
                  <a href="#restore{{$staff->strCStafId}}" class="btn btn-warning" onclick="$('#restore{{$staff->strStafId}}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></a>
                @endif
              </td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@foreach($staffs as $staff)
<div id="del{{$staff->strStafId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Staff</h4>
        </div>
        <div class="modal-body">
          <h5>Are you sure to delete <strong>{{ $staff->strStafId }}</strong>?</h5>
        </div>
        <div class="modal-footer">

          {!! Form::open(['url' => '/staff/' . $staff->strStafId, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
          {!! Form::close() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>

<div id="restore{{$staff->strStafId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Restore Staff</h4>
        </div>
        <div class="modal-body">
          <h5>Are you sure to restore <strong>{{ $staff->strStafId }}</strong>?</h5>
        </div>
        <div class="modal-footer">
          {!! Form::open(['url' => '/staff/staff_restore']) !!}
            {{ Form::hidden('staff_id', $staff->strStafId) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
          {!! Form::close() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>

<div id="edit{{$staff->strStafId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Staff</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url' => 'staff/staff_update/']) !!}
          {{ Form::hidden('customer_id', $staff->strStafId) }}
          <div class="form-group">
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', $staff->strStafFirst, ['placeholder' => 'Example: Juan', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('middle_name', 'Middle Name') }}
          {{ Form::text('middle_name', $staff->strStafMiddle, ['placeholder' => 'Example: Dela', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', $staff->strStafLast, ['placeholder' => 'Example: Cruz', 'class' => 'form-control']) }}
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


<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Staff</h4>
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

        {!! Form::open(['url' => '/staff']) !!}
          <div class="form-group">
          {{ Form::label('staff_id', 'Staff ID') }}
          {{ Form::text('staff_id',  $newID, ['class' => 'form-control']) }}
          </div>

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

      </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div id="showDetail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Show Staff Datails</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          {{ Form::label('staff_id', 'Staff ID') }}
          {{ Form::text('staff_id',  '', ['class' => 'form-control', 'id' => 'stafId', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', '', ['class' => 'form-control', 'id' => 'stafFirst', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('middle_name', 'Middle Name') }}
          {{ Form::text('middle_name', '', ['class' => 'form-control', 'id' => 'stafMiddle', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', '', ['class' => 'form-control', 'id' => 'stafLast', 'disabled' => 'true']) }}
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
      $('#staff').addClass("active");
      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tblStaff').DataTable();

      $('#show_deleted').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deleted:checked').length;
				if (!show_deleted) return aData[6] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/staff') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#stafId').val(data.strStafId);
            $('#stafFirst').val(data.strStafFirst);
            $('#stafMiddle').val(data.strStafMiddle);
            $('#stafLast').val(data.strStafLast);
            $('#showDetail').modal('show');
        })
      });
    });
  </script>
  @endsection
