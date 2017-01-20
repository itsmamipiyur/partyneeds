@extends('layouts.app')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection


@section('title')
  Drink
@endsection

@section('content')

<h2>maintenance/Drink</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Drink List</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createDrink">Add Drink</button>
      <br>
      <table class="table table-hover" id="tblDrink">
        <thead>
          <tr>
            <th>Drink ID</th>
            <th>Drink Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if(count($drinks) == 0)
            <tr>
              <td colspan="6" align="center">
                <strong>Nothing to show.</strong>
              </td>
            </tr>
          @else
            @foreach($drinks as $drink)
              <tr>
                <td>{{ $drink->strDrinkId }}</td>
                <td>{{ $drink->strDrinkName }}</td>
                <td>{{ $drink->created_at }}</td>
                <td>{{ $drink->updated_at }}</td>
                <td>{{ $drink->deleted_At }}</td>
                <td class="btn-group clearfix" align="center" nowrap>
                   <button type="button" value="{{ $drink->strDrinkId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                   <a href="#edit{{ $drink->strDrinkId }}" class="btn btn-info edit-detail" onclick="$('#edit{{$drink->strDrinkId}}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                   @if(is_null($drink->deleted_at))
                    <a href="#del{{$drink->strDrinkId}}" class="btn btn-danger" onclick="$('#del{{$drink->strDrinkId}}').modal('show')"><span class="glyphicon glyphicon-trash"></span></button>
                   @else
                    <a href="#restore{{$drink->strDrinkId}}" class="btn btn-warning" onclick="$('#restore{{$drink->strDrinkId}}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></button>
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
          {{ Form::label('drink_id', 'Drink ID') }}
          {{ Form::text('drink_id', $newID, ['placeholder' => 'Example: DNK0000', 'class' => 'form-control']) }}
          </div>

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

      $('#drink').addClass("active");

      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tbldrink').DataTable();

      $('#show_deletedType').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deletedType:checked').length;
				if (!show_deleted) return aData[4] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/drink') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#equiTypeId').val(data.strDrinkId);
            $('#equiTypeName').val(data.strDrinkName);
            $('#equiTypeDesc').val(data.txtEquiTypeDesc);
            $('#showEquiType').modal('show');
        })
      });
    });
  </script>
  @endsection
