@extends('layouts.app')

@section('content')

@section('title')
  Menu
@endsection

<h2>maintenance/Menu</h2>
<hr size="5">



<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Menu List</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Menu</button>
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Menu ID</th>
            <th>Menu Rate</th>
            <th>Menu Type</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>MENU0001</td>
            <td>400</td>
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

<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Menu</h4>
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

        {!! Form::open(['url' => '/menu']) !!}
          <div class="form-group">
          {{ Form::label('menu_rate', 'Menu Rate') }}
          {{ Form::text('menu_rate', '', ['placeholder' => 'Example: 400', 'class' => 'form-control']) }}
          </div>

          <div class="control-group">
          {{ Form::label('menu_type', 'Menu Type', ['class' => 'control-label']) }}
          {{ Form::select('menu_type', $type, null, ['placeholder' => 'Choose Menu Type', 'class' => 'form-control', 'id' => 'type']) }}
          </div>

          <div class="form-group">
          {{ Form::label('menu_desc', 'Menu Type Description') }}
          {{ Form::text('menu_desc', '', ['placeholder' => 'Example: Masarap', 'class' => 'form-control']) }}
          </div>
        </div>

      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>




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

@endsection

@section('js')
  <script>
    $(document).ready( function(){
      setTimeout(function(){
          $('.alert').fadeOut("slow");
      }, 2000);

      $('#maintenance').addClass("in");

      $('#menu').addClass("active");

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
