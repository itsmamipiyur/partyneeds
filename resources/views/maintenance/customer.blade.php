@extends('layouts.app')

@section('error')
  @if ($alert = Session::get('alert-success'))
    <div class="alert alert-success">
        <strong>{{ $alert }}</strong>
    </div>
  @endif
@endsection

@section('title')
  Customer
@endsection


@section('content')

<h2>maintenance/Customer</h2>
<hr size="5">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Customer List</h3>
  </div>
  <div class="panel-body">
    <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#create">Add Customer</button>
    <br><br>
    <div class="pull-right">
      <label class="checkbox-inline">
    			<input type="checkbox" id="show_deleted">
    			Show Deleted Items
    		</label>
    </div>
    <br>

    <table class="table table-hover" id="tblCustomer">
      <thead>
        <tr>
          <th>Customer ID</th>
          <th>Customer Name</th>
          <th>Customer Address</th>
          <th>Contact Number</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Deleted At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!--IF tbl customer is null-->
        @if($customers->count() == 0)
          <tr>
            <td colspan="8" align="center"><strong>Nothing to show</strong></td>
          </tr>

        <!--IF tbl customer is not null-->
        @else
          @foreach($customers as $customer)
            <tr>
              <td>{{ $customer->strCustId }}</td>
              <td>{{ $customer->strCustFirst .' '. $customer->strCustMiddle .' '.$customer->strCustLast  }}</td>
              <td>{{ $customer->strCustAddress }}</td>
              <td>{{ $customer->strCustContact }}</td>
              <td>{{ $customer->created_at }}</td>
              <td>{{ $customer->updated_at }}</td>
              <td>{{ $customer->deleted_at }}</td>
              <td class="btn-group clearfix" align="center" nowrap>
                 <button type="button" value="{{ $customer->strCustId }}" class="btn btn-success open-detail"><span class="glyphicon glyphicon-eye-open"></span></button>
                 <a href="#edit{{ $customer->strCustId }}" class="btn btn-info edit-detail" onclick="$('#edit{{$customer->strCustId}}').modal('show')"><span class="glyphicon glyphicon-pencil"></span></a>
                 @if(is_null($customer->deleted_at))
                  <a href="#del{{$customer->strCustId}}" class="btn btn-danger" onclick="$('#del{{$customer->strCustId}}').modal('show')"><span class="glyphicon glyphicon-trash"></span></a>
                 @else
                  <a href="#restore{{$customer->strCustId}}" class="btn btn-warning" onclick="$('#restore{{$customer->strCustId}}').modal('show')"><span class="glyphicon glyphicon-repeat"></span></a>
                @endif
              </td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@foreach($customers as $customer)
<div id="del{{$customer->strCustId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Customer</h4>
        </div>
        <div class="modal-body">
          <h5>Are you sure to delete <strong>{{ $customer->strCustId }}</strong>?</h5>
        </div>
        <div class="modal-footer">

          {!! Form::open(['url' => '/customer/' . $customer->strCustId, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-danger']) }}
          {!! Form::close() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>

<div id="restore{{$customer->strCustId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Restore Customer</h4>
        </div>
        <div class="modal-body">
          <h5>Are you sure to restore <strong>{{ $customer->strCustId }}</strong>?</h5>
        </div>
        <div class="modal-footer">
          {!! Form::open(['url' => '/customer/customer_restore']) !!}
            {{ Form::hidden('customer_id', $customer->strCustId) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'btn btn-warning']) }}
          {!! Form::close() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
    </div>
  </div>
</div>

<div id="edit{{$customer->strCustId}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Customer</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url' => 'customer/customer_update/']) !!}
          {{ Form::hidden('customer_id', $customer->strCustId) }}
          <div class="form-group">
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', $customer->strCustFirst, ['placeholder' => 'Example: Juan', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('middle_name', 'Middle Name') }}
          {{ Form::text('middle_name', $customer->strCustMiddle, ['placeholder' => 'Example: Dela', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', $customer->strCustLast, ['placeholder' => 'Example: Cruz', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('address', 'Address') }}
          {{ Form::textarea('address', $customer->strCustAddress, ['placeholder' => 'Example: 123 Rizal Ave., Tondo, Manila', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('contact', 'Contact Number') }}
          {{ Form::text('contact', $customer->strCustContact, ['placeholder' => 'Example: 09225458545', 'class' => 'form-control']) }}
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


<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Customer</h4>
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

        {!! Form::open(['url' => '/customer']) !!}
          <div class="form-group">
          {{ Form::label('customer_id', 'Customer ID') }}
          {{ Form::text('customer_id',  $newID, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', '', ['placeholder' => 'Example: Juan', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('middle_name', 'Middle Name') }}
          {{ Form::text('middle_name', '', ['placeholder' => 'Example: Dela', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', '', ['placeholder' => 'Example: Cruz', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('address', 'Address') }}
          {{ Form::textarea('address', '', ['placeholder' => 'Example: 123 Rizal Ave., Tondo, Manila', 'class' => 'form-control']) }}
          </div>

          <div class="form-group">
          {{ Form::label('contact', 'Contact Number') }}
          {{ Form::text('contact', '', ['placeholder' => 'Example: 09225458545', 'class' => 'form-control']) }}
          </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-info', 'id' => 'btn-save']) }}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div id="showDetail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Show Customer Datails</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          {{ Form::label('customer_id', 'Customer ID') }}
          {{ Form::text('customer_id',  '', ['class' => 'form-control', 'id' => 'custId', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', '', ['class' => 'form-control', 'id' => 'custFirst', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('middle_name', 'Middle Name') }}
          {{ Form::text('middle_name', '', ['class' => 'form-control', 'id' => 'custMiddle', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', '', ['class' => 'form-control', 'id' => 'custLast', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('address', 'Address') }}
          {{ Form::textarea('address', '', ['class' => 'form-control', 'id' => 'custAddress', 'disabled' => 'true']) }}
          </div>

          <div class="form-group">
          {{ Form::label('contact', 'Contact Number') }}
          {{ Form::text('contact', '', ['class' => 'form-control', 'id' => 'custContact', 'disabled' => 'true']) }}
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
      $('#customer').addClass("active");
      $('#transMenu').on('click', function(){
        $('#maintenance').collapse("hide");
      });

      var table = $('#tblCustomer').DataTable();

      $('#show_deleted').on('change', function () {
				table.draw();
			});

      $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
				var show_deleted = $('#show_deleted:checked').length;
				if (!show_deleted) return aData[6] == '';
				return true;
			});
			table.draw();

      var url = "{{ url('/customer') }}";
      var bid = 0;

      $('.open-detail').click(function(){
        var id = $(this).val();
        console.log(id);

        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#custId').val(data.strCustId);
            $('#custFirst').val(data.strCustFirst);
            $('#custMiddle').val(data.strCustMiddle);
            $('#custLast').val(data.strCustLast);
            $('#custAddress').val(data.strCustAddress);
            $('#custContact').val(data.strCustContact);
            $('#showDetail').modal('show');
        })
      });
    });
  </script>
  @endsection
