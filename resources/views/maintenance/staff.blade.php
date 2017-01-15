@extends('layouts.app')

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
    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Staff</button>
    <br>
    <table class="table table-hover" id="tblBranch">
      <thead>
        <tr>
          <th>Staff ID</th>
          <th>Staff Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>STFF0001</td>
          <td>Kuya Boy</td>
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
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', '', ['placeholder' => 'Example: Mommy', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('middle_name', 'Middle Name') }}
          {{ Form::text('middle_name', '', ['placeholder' => 'Example: Dela', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', '', ['placeholder' => 'Example: Pure', 'class' => 'form-control']) }}
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

      $('#staff').addClass("active");

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
