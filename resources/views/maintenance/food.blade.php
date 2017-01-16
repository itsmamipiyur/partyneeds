@extends('layouts.app')

@section('content')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection


@section('title')
  Food
@endsection

<h2>maintenance/Food</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Food List</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Food</button>
      <br><br>
      <div class="pull-right">
        <label class="checkbox-inline">
      			<input type="checkbox" id="show_deletedType">
      			Show Deleted Items
      		</label>
      </div>
      <br>
      <table class="table table-hover" id="tblFood">
        <thead>
          <tr>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Food Category</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if(count($foods) === 0)
          <tr>
            <td colspan="7" align="center"><strong>Nothing to show</strong></td>
          </tr>
          @else
            @foreach($foods as $food)
            <tr>
              <td>{{ $food->strFoodId }}</td>
              <td>{{ $food->strFoodName }}</td>
              <td>{{ $food->foodCategory->strFoodCateName }}</td>
              <td>{{ $food->created_at }}</td>
              <td>{{ $food->updated_at }}</td>
              <td>{{ $food->deleted_at }}</td>
              <td class="btn-group clearfix" align="center" nowrap>
                 <button type="button" value="{{ $food->strFoodId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                 <a href="#edit{{ $food->strFoodId }}" class="btn btn-info edit-detail" onclick="$('#edit{{$food->strFoodId}}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                 @if(is_null($food->deleted_at))
                  <a href="#del{{$food->strFoodId}}" class="btn btn-danger" onclick="$('#del{{$food->strFoodId}}').modal('show')"><span class="glyphicon glyphicon-trash"></span></button>
                 @else
                  <a href="#restore{{$food->strFoodId}}" class="btn btn-warning" onclick="$('#restore{{$food->strFoodId}}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></button>
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

@if(count($foods) > 0)
  @foreach($foods as $food)
  <div id="del{{$food->strFoodId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Food</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to delete <strong>{{ $food->strFoodName }}</strong>?</h5>
          </div>
          <div class="modal-footer">

            {!! Form::open(['url' => '/food/' . $food->strFoodId, 'method' => 'delete']) !!}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="restore{{ $food->strFoodId }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Restore Food</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to restore <strong>{{ $food->strFoodName }}</strong>?</h5>
          </div>
          <div class="modal-footer">
            {!! Form::open(['url' => '/food/food_restore']) !!}
              {{ Form::hidden('food_id', $food->strFoodId) }}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="edit{{$food->strFoodId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Food</h4>
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
          {!! Form::open(['url' => 'food/food_update/']) !!}
            {{ Form::hidden('food_id', $food->strFoodId) }}

            <div class="form-group">
            {{ Form::label('food_name', 'Food Name') }}
            {{ Form::text('food_name', $food->strFoodName, ['placeholder' => 'Example: Trays', 'class' => 'form-control']) }}
            </div>

            <div class="control-group">
            {{ Form::label('food_category', 'Food Category', ['class' => 'control-label']) }}
            {{ Form::select('food_category', $foodCategories, $food->strFoodFoodCateId, ['placeholder' => 'Choose Food Category', 'class' => 'form-control', 'id' => 'category']) }}
            </div>

            <div class="form-group">
            {{ Form::label('food_description', 'Food Description') }}
            {{ Form::textarea('food_description', $food->txtFoodDesc, ['placeholder' => 'Type Food Description', 'class' => 'form-control']) }}
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
          {{ Form::label('food_id', 'Food ID') }}
          {{ Form::text('food_id', $newID, ['placeholder' => 'Example: FOOD0000', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('food_name', 'Food Name') }}
          {{ Form::text('food_name', '', ['placeholder' => 'Type Food Name', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('food_description', 'Food Description') }}
          {{ Form::text('food_description', '', ['placeholder' => 'Type Food Description', 'class' => 'form-control']) }}
          </div>

          <div class="control-group">
          {{ Form::label('food_category', 'Food Category', ['class' => 'control-label']) }}
          {{ Form::select('food_category', $foodCategories, null, ['placeholder' => 'Choose Food Category', 'class' => 'form-control', 'id' => 'category']) }}
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

      var table = $('#tblFood').DataTable();

      $('#show_deletedType').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deletedType:checked').length;
				if (!show_deleted) return aData[5] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/foodType') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#equiTypeId').val(data.strFoodTypeId);
            $('#equiTypeName').val(data.strFoodTypeName);
            $('#equiTypeDesc').val(data.txtFoodTypeDesc);
            $('#showEquiType').modal('show');
        })
      });
    });
  </script>
  @endsection
