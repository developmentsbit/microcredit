

<form method="post" action="{{  url("updatebankinformation/".$data->id) }}" class="row">

  @csrf

    <div class="form-group col-md-12">
      <label>ব্যাংক নাম:</label>
      <div class="input-group">

        <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="Bank Name" required="" value="{{ $data->bank_name }}">
      </div>
    </div>



    <div class="form-group col-md-12">
      <label>একাউন্ট নাম্বার:</label>
      <div class="input-group">

        <input class="form-control" type="number" name="account_number" id="account_number" placeholder="Account No." required="" value="{{ $data->account_number }}">
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>একাউন্ট ধরণ:</label>
      <div class="input-group">

        <input class="form-control" type="text" name="account_type" id="account_type" placeholder="Account Type" value="{{ $data->account_type }}">
      </div>
    </div>


    <div class="form-group col-md-6">
      <label>ফোন নাম্বার:</label>
      <div class="input-group">

        <input class="form-control" type="text" name="contact" id="contact" placeholder="Account Type" value="{{ $data->contact }}">
      </div>
    </div>




    <div class="form-group col-md-6">
      <label>ব্যাংকিং ধরণ:</label>
      <div class="input-group">

        <input class="form-control" type="text" name="bankingType" id="bankingType" placeholder="Banking Type" value="{{ $data->bankingType }}">
      </div>
    </div>


    <div class="form-group col-md-12">
      <label>বিস্তারিত:</label>
      <div class="input-group">

        <textarea rows="3" name="details" id="details" class="form-control" placeholder="Details">{{ $data->details }}</textarea>
      </div>
    </div>






  <div class="modal-footer border-0 ml-auto">
    <button type="button" class="btn btn-secondary border-0" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success button border-0">Update</button>
  </div>
</form>




