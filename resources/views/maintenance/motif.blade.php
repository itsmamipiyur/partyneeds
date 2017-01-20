@extends('layouts.app')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection

@section('title')
  Motif
@endsection

@section('content')

<h2>maintenance/Motif</h2>
<hr size="5">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Motif</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#create">Add Motif</button>
      <br><br>
      <div class="pull-right">
        <label class="checkbox-inline">
      			<input type="checkbox" id="show_deleted">
      			Show Deleted Items
      		</label>
      </div>
      <br>
      <table class="table table-hover" id="tblMotif">
        <thead>
          <tr>
            <th>Motif ID</th>
            <th>Motif Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Deleted At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if(count($motifs) == 0)
            <tr>
              <td colspan="6" align="center"><strong>Nothing to show.</strong></td>
            </tr>
          @else
            @foreach($motifs as $motif)
              <tr>
                <td>{{ $motif->strMotiId }}</td>
                <td>{{ $motif->strMotiName }}</td>
                <td>{{ $motif->created_at }}</td>
                <td>{{ $motif->updated_at }}</td>
                <td>{{ $motif->deleted_at }}</td>
                <td class="btn-group clearfix" align="center" nowrap>
                   <button type="button" value="{{ $motif->strMotiId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                   <a href="#edit{{ $motif->strMotiId }}" class="btn btn-info edit-detail" onclick="$('#edit{{ $motif->strMotiId }}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                   @if(is_null($motif->deleted_at))
                    <a href="#del{{ $motif->strMotiId }}" class="btn btn-danger" onclick="$('#del{{ $motif->strMotiId }}').modal('show')"><span class="glyphicon glyphicon-trash"></span></button>
                   @else
                    <a href="#restore{{ $motif->strMotiId }}" class="btn btn-warning" onclick="$('#restore{{ $motif->strMotiId }}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></button>
                  @endif
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>

@if(count($motifs) > 0)
  @foreach($motifs as $motif)
  <div id="del{{$motif->strMotiId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Motif</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to delete <strong>{{ $motif->strMotiName }}</strong>?</h5>
          </div>
          <div class="modal-footer">

            {!! Form::open(['url' => '/motif/' . $motif->strMotiId, 'method' => 'delete']) !!}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="restore{{$motif->strMotiId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Restore Motif</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to restore <strong>{{ $motif->strMotiId }}</strong>?</h5>
          </div>
          <div class="modal-footer">
            {!! Form::open(['url' => '/motif/motif_restore']) !!}
              {{ Form::hidden('motif_id', $motif->strMotiId) }}
              {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
            {!! Form::close() !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>

  <div id="edit{{$motif->strMotiId}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Motif</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['url' => 'motif/motif_update/']) !!}
            {{ Form::hidden('motif_id', $motif->strMotiId) }}
            <div class="form-group">
            {{ Form::label('motif_name', 'Motif Name') }}
            {{ Form::text('motif_name', $motif->strMotiName, ['placeholder' => 'Type Motif Name', 'class' => 'form-control']) }}
            </div>

            <div class="form-group">
            {{ Form::label('motif_description', 'Description') }}
            {{ Form::textarea('motif_description', $motif->strMotiDesc, ['placeholder' => 'Type Motif Description', 'class' => 'form-control']) }}
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
        <h4 class="modal-title">Add Motif</h4>
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

        {!! Form::open(['url' => '/motif']) !!}
          <div class="form-group">
          {{ Form::label('motif_id', 'Motif ID') }}
          {{ Form::text('motif_id', $newID, ['placeholder' => 'Type Motif ID', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('motif_name', 'Motif Name') }}
          {{ Form::text('motif_name', '', ['placeholder' => 'Type Motif Name', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('motif_desc', ' Description') }}
          {{ Form::textarea('motif_description', '', ['placeholder' => 'Type your Description', 'class' => 'form-control']) }}
          </div>


        </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div id="showMotif" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Motif Details</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          {{ Form::label('motif_id', 'Motif ID') }}
          {{ Form::text('motif_id', '', ['class' => 'form-control', 'id' => 'motifId', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('motif_name', 'Motif Name') }}
          {{ Form::text('motif_name', '', ['class' => 'form-control', 'id' => 'motifName', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('motif_description', 'Description') }}
          {{ Form::textarea('motif_description', '', ['class' => 'form-control', 'id' => 'motifDesc', 'disabled' => 'true']) }}
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
      $('#motif').addClass("active");
      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tblMotif').DataTable();

      $('#show_deleted').on('change', function () {
        table.draw();
      });

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
        var show_deleted = $('#show_deleted:checked').length;
        if (!show_deleted) return aData[4] == '';
        return true;
      });
      table.draw();

      var url = "{{ url('/motif') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#motifId').val(data.strMotiId);
            $('#motifName').val(data.strMotiName);
            $('#motifDesc').val(data.txtMotiDesc);
            $('#showMotif').modal('show');
        })
      });
    });
  </script>
  @endsection
