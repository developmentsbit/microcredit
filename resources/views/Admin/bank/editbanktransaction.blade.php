
<form method="post" class="row myinput" action="{{ url("updatebanktransaction/".$data->id) }}">

  @csrf


  @php
  $bank = DB::table('bank_information')->get();
  @endphp

  <div class="form-group col-md-12">
    <label>Bank Account:</label>
    <div class="input-group">

      <select class="form-control" name="account_id" id="account_id" required="">
        <option value="">Select Bank Account</option>
        @if(isset($bank))
        @foreach($bank as $c)
        <option value="{{ $c->id }}" <?php if ($c->id == $data->account_id) {
          echo "selected";
        } ?>>{{ $c->bank_name }} -> {{ $c->account_type }} -> {{ $c->account_number }}</option>
        @endforeach
        @endif

      </select>
    </div>
  </div>




  <div class="form-group col-md-4">
    <label>তারিখ:</label>
    <div class="input-group">

      <input class="form-control" type="date" name="deposit_withdraw_date" id="deposit_withdraw_date" required="" value="{{ $data->deposit_withdraw_date }}">
    </div>
  </div>



  <div class="form-group col-md-4">
    <label>লেনদেন ধরণ:</label>
    <div class="input-group">

      <select class="form-control" name="transaction_type" id="transaction_type">
        <option value="{{ $data->transaction_type }}">{{ $data->transaction_type }}</option>
        <option value="Deposit">Deposit</option>
        <option value="Withdraw">Withdraw</option>
        <option value="Bank-Cost">Bank Account Cost</option>
        <option value="Bank-Insterest">Bank Account Interest</option>
      </select>
    </div>
  </div>


  <div class="form-group col-md-4">
    <label>পরিমাণ:</label>
    <div class="input-group">

      <input class="form-control" type="text" name="deposit_withdraw_amount" id="deposit_withdraw_amount" required="" value="{{ $data->deposit_withdraw_amount }}">
    </div>
  </div>




  <div class="form-group col-md-8">
    <label>ভাউচার/চেক/ট্রানজেকশন আইডি:</label>
    <div class="input-group">

      <textarea rows="3" class="form-control" placeholder="" name="vouchar_cheque_no" id="vouchar_cheque_no">{{ $data->vouchar_cheque_no }}</textarea>
    </div>
  </div>







  <div class="modal-footer border-0 ml-auto col-12">
    <button type="button" class="btn btn-secondary border-0" data-dismiss="modal">x</button>
    <button type="submit" class="btn btn-success border-0">আপডেট</button>

  </div>
</form>






<script type="text/javascript">

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


  $('.loading').hide();
  $(".btn-submit").submit(function(e){
    e.preventDefault();

    var data = $(this).serialize();
    var id = $(this).data("id");

    $.ajax({
      url:"{{ url('updatebanktransaction') }}/"+id,
      method:'POST',
      data:data,

      beforeSend:function(response) {

        $('.loading').show();
        $('.button').hide();

      },


      success:function(response){

       Command:toastr["info"]("Data Update Successfully Done")
       toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

      $('.loading').hide();
      $('.button').show();
      $('#exampleModalCenters').modal('hide');

      window.location.href="";





    },

    error:function(error){
      console.log(error)
    }
  });
  });



</script>
