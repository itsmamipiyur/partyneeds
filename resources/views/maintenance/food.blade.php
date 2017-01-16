@extends('layouts.app')

@section('content')

@section('title')
  Food
@endsection

<h2>maintenance/Food</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Food Category</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createFoodCategory">Add Food Category</button>
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Food Category ID</th>
            <th>Food Category Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>FOODCATE0001</td>
            <td>Chicken</td>
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
      <h3 class="panel-title">Food List</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Food</button>
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Food Category</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>FOOD0001</td>
            <td>Menudo</td>
            <td>Beef</td>
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
        <h4 class="modal-title">Add Food</h4>
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

        {!! Form::open(['url' => '/food']) !!}
          <div class="form-group">
          {{ Form::label('food_name', 'Food Name') }}
          {{ Form::text('food_name', '', ['placeholder' => 'Example: Chicken Curry', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('food_desc', 'Food Description') }}
          {{ Form::text('food_desc', '', ['placeholder' => 'Example: Masarap', 'class' => 'form-control']) }}
          </div>

          <div class="control-group">
          {{ Form::label('food_category', 'Category', ['class' => 'control-label']) }}
          {{ Form::select('food_category', $categories, null, ['placeholder' => 'Choose Food Category', 'class' => 'form-control', 'id' => 'category']) }}
          </div>
        </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<div id="createFoodCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Food Category</h4>
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

        {!! Form::open(['url' => '/foodcategory']) !!}
          <div class="form-group">
          {{ Form::label('food_category_name', 'Food Category Name') }}
          {{ Form::text('food_category_name', '', ['placeholder' => 'Example: Chicken', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('food_category_description', 'Food Category Description') }}
          {{ Form::textarea('food_category_description', '', ['placeholder' => 'Type the description', 'class' => 'form-control']) }}
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

      $('#food').addClass("active");

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
