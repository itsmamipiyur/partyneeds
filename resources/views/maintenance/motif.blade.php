@extends('layouts.app')

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
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Motif ID</th>
            <th>Motif Name</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>MOTF0001</td>
            <td>Black/Yellow</td>
            <td>Black and Yellow theme</td>
            <td>
              lol
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>


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

        var table = $('#tblStaff').DataTable();

        $('#show_deleted').on('change', function () {
  				table.draw();
  			});

        $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
  				var show_deleted = $('#show_deleted:checked').length;
  				if (!show_deleted) return aData[6] == '';
  				return true;
  			});
  			table.draw();

        var url = "{{ url('/staff') }}";
        var bid = 0;

        $('.open-detail').click(function(){
          var id = $(this).val();
          console.log(id);

          $.get(url + '/' + id, function (data) {
              //success data
              console.log(data);
              $('#stafId').val(data.strStafId);
              $('#stafFirst').val(data.strStafFirst);
              $('#stafMiddle').val(data.strStafMiddle);
              $('#stafLast').val(data.strStafLast);
              $('#showDetail').modal('show');
          })
        });
      });
    </script>
    @endsection




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
          {{ Form::label('motif_name', 'Motif Name') }}
          {{ Form::text('motif_name', '', ['placeholder' => 'Example: Black/Yellow', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('package_desc', ' Description') }}
          {{ Form::textarea('package_desc', '', ['placeholder' => 'Type your Description', 'class' => 'form-control']) }}
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
