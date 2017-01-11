@extends('layouts.admin')

@section('content')

<h2>maintenance/Menu</h2>
<hr size="5">

<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Food</button>
<br><br>

<div class="panel panel-default">
  <div class="panel-body">
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
          <td>Filipino Dish</td>
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
@endsection
