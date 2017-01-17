@extends('layouts.app')

@section('content')

@section('title')
  Menu Type
@endsection

<h2>maintenance/Menu Type</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Menu Type</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createMenuType">Add Menu Type</button>
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Menu Type ID</th>
            <th>Menu Type Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>MENUTYPE0001</td>
            <td>Breakfast Menu</td>
            <td>
              lol
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div id="createMenuType" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Menu Type</h4>
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

        {!! Form::open(['url' => '/menutype']) !!}
          <div class="form-group">
          {{ Form::label('menu_type_name', 'Menu Type Name') }}
          {{ Form::text('menu_type_name', '', ['placeholder' => 'Example: Breakfast Menu', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('menu_type_description', 'Menu Type Description') }}
          {{ Form::textarea('menu_type_description', '', ['placeholder' => 'Type the description', 'class' => 'form-control']) }}
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

      $('#menuType').addClass("active");

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
