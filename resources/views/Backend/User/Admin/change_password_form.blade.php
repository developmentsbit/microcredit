
<div class="col-sm-12 mb-3">
    <label for="validationCustomUsername">নতুন পাসওয়ার্ড</label>
    <div class="input-group">
        <input type="password" class="form-control form-control-sm @error('new_password') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="new_password" value="" id="password">
    </div>
    <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
    @error('new_password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="submit-btn">
    <input type="submit" class="btn btn-success" value="সেভ করুন" id="submit-btn">
</div>


