@extends('layouts.app')

@section('title')
  Event Type
@endsection

@section('content')

<h2>maintenance/Event</h2>
<hr size="5">

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Event Type</h3>
    </div>
    <div class="panel-body">
      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#createEventType">Add Event Type</button>
      <br>
      <table class="table table-hover" id="tblBranch">
        <thead>
          <tr>
            <th>Event Type ID</th>
            <th>Event Type Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>EVNTTYPE0001</td>
            <td>Birthday</td>
            <td>
              lol
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@section('js')
  <script>
    $(document).ready( function(){
      setTimeout(function(){
          $('.alert').fadeOut("slow");
      }, 2000);

      $('#maintenance').addClass("in");
      $('#eventType').addClass("active");
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



<div id="createEventType" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Event Type</h4>
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

        {!! Form::open(['url' => '/event']) !!}
          <div class="form-group">
          {{ Form::label('event_name', 'Event Type Name') }}
          {{ Form::text('event_name', '', ['placeholder' => 'Example: Birthday', 'class' => 'form-control']) }}
          </div>


          <div class="form-group">
          {{ Form::label('event_description', 'Event Type Description') }}
          {{ Form::textarea('event_description', '', ['placeholder' => 'Type the description', 'class' => 'form-control']) }}
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
