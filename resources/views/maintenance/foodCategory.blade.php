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
  Food Category
@endsection

<h2>maintenance/Food Category</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Food Category</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createFoodCategory">Add Food Category</button>
      <br><br>
      <div class="pull-right">
        <label class="checkbox-inline">
      			<input type="checkbox" id="show_deletedType">
      			Show Deleted Items
      		</label>
      </div>
      <br>
      <table class="table table-hover" id="tblFoodCategory">
        <thead>
          <tr>
            <th>Food Category ID</th>
            <th>Food Category Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if(count($foodCategories) === 0)
            <tr>
              <td colspan="6" align="center"><strong>Nothing to show</strong></td>
            </tr>
          @else
          @foreach($foodCategories as $foodCategory)
            <tr>
              <td>{{ $foodCategory->strFoodCateId }}</td>
              <td>{{ $foodCategory->strFoodCateName }}</td>
              <td>{{ $foodCategory->created_at }}</td>
              <td>{{ $foodCategory->updated_at }}</td>
              <td>{{ $foodCategory->deleted_at }}</td>
              <td class="btn-group clearfix" align="center" nowrap>
                 <button type="button" value="{{ $foodCategory->strFoodCateId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                 <a href="#edit{{ $foodCategory->strFoodCateId }}" class="btn btn-info edit-detail" onclick="$('#edit{{ $foodCategory->strFoodCateId }}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                 @if(is_null($foodCategory->deleted_at))
                  <a href="#del{{ $foodCategory->strFoodCateId }}" class="btn btn-danger" onclick="$('#del{{ $foodCategory->strFoodCateId }}').modal('show')"><span class="glyphicon glyphicon-trash"></span></button>
                 @else
                  <a href="#restore{{ $foodCategory->strFoodCateId }}" class="btn btn-warning" onclick="$('#restore{{ $foodCategory->strFoodCateId }}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></button>
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

@if(count($foodCategories) > 0)
  @foreach($foodCategories as $foodCategory)
  <div id="del{{$foodCategory->strFoodCateId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Food Category</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to delete <strong>{{ $foodCategory->strFoodCateName }}</strong>?</h5>
          </div>
          <div class="modal-footer">

            {!! Form::open(['url' => '/foodCategory/' . $foodCategory->strFoodCateId, 'method' => 'delete']) !!}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="restore{{$foodCategory->strFoodCateId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Restore Food Category</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to restore <strong>{{ $foodCategory->strFoodCateId }}</strong>?</h5>
          </div>
          <div class="modal-footer">
            {!! Form::open(['url' => '/foodCategory/foodCategory_restore']) !!}
              {{ Form::hidden('category_id', $foodCategory->strFoodCateId) }}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="edit{{$foodCategory->strFoodCateId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Food Category</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['url' => 'foodCategory/foodCategory_update/']) !!}
            {{ Form::hidden('category_id', $foodCategory->strFoodCateId) }}
            <div class="form-group">
            {{ Form::label('category_name', 'Food Category Name') }}
            {{ Form::text('category_name', $foodCategory->strFoodCateName, ['placeholder' => 'Type Food Category Name', 'class' => 'form-control']) }}
            </div>

            <div class="form-group">
            {{ Form::label('category_description', 'Description') }}
            {{ Form::textarea('category_description', $foodCategory->txtFoodCateDesc, ['placeholder' => 'Type Equipment Type Description', 'class' => 'form-control']) }}
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

        {!! Form::open(['url' => '/foodCategory']) !!}
          <div class="form-group">
          {{ Form::label('category_id', 'Food Category ID') }}
          {{ Form::text('category_id', $newID, ['placeholder' => 'Example: FOODCATE0000', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('category_name', 'Food Category Name') }}
          {{ Form::text('category_name', '', ['placeholder' => 'Example: Chicken', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('category_description', 'Category Description') }}
          {{ Form::textarea('cateogory_description', '', ['placeholder' => 'Type the description', 'class' => 'form-control']) }}
          </div>
        </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div id="showFoodCate" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Food Category Details</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          {{ Form::label('category_id', 'Equipment Type ID') }}
          {{ Form::text('category_id', '', ['class' => 'form-control', 'id' => 'cateId', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('category_name', 'Equipment Type Name') }}
          {{ Form::text('category_name', '', ['class' => 'form-control', 'id' => 'cateName', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('category_description', 'Description') }}
          {{ Form::textarea('category_description', '', ['class' => 'form-control', 'id' => 'cateDesc', 'disabled' => 'true']) }}
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

      $('#foodCategory').addClass("active");

      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tblFoodCategory').DataTable();

      $('#show_deletedType').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deletedType:checked').length;
				if (!show_deleted) return aData[4] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/foodCategory') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#cateId').val(data.strFoodCateId);
            $('#cateName').val(data.strFoodCateName);
            $('#cateDesc').val(data.txtFoodCateDesc);
            $('#showFoodCate').modal('show');
        })
      });
    });
  </script>
  @endsection
