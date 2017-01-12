@extends('layouts.admin')

@section('content')

<h2>maintenance/Package</h2>
<hr size="5">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Package</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Package</button>
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Package ID</th>
            <th>Package Name</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>PACK0001</td>
            <td>Package1</td>
            <td>1,895</td>
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
        <h4 class="modal-title">Add Package</h4>
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

        {!! Form::open(['url' => '/package']) !!}
          <div class="form-group">
          {{ Form::label('package_name', 'Package Name') }}
          {{ Form::text('package_name', '', ['placeholder' => 'Example: Package1', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('package_desc', ' Description') }}
          {{ Form::textarea('package_desc', '', ['placeholder' => 'Example: 1,895', 'class' => 'form-control']) }}
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
