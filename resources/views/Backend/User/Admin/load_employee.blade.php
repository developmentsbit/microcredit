<div class="col-sm-6 mb-3">
    <label>নাম</label><span class="text-danger">*</span>
    <div class="input-group">
        <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="first_name" value="{{$empData->name}}">
    </div>
    @error('first_name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="col-sm-6 mb-3">
    <label>ফোন</label><span class="text-danger">*</span>
    <div class="input-group">
        <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" placeholder="Phone" name="phone" value="{{$empData->phone}}">
    </div>
    @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="col-sm-6 mb-3">
    <label>ই-মেইল</label><span class="text-danger">*</span>
    <div class="input-group">
        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" aria-describedby="inputGroupPrepend" placeholder="Email" name="email" value="{{$empData->email}}">
    </div>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="col-sm-6 mb-3">
    <label>পাসওয়ার্ড</label><span class="text-danger">*</span>
    <div class="input-group">
        <input type="text" class="form-control form-control-sm @error('password') is-invalid @enderror" aria-describedby="inputGroupPrepend" placeholder="Password" name="password" value="{{old('password')}}">
    </div>
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="col-sm-6 mb-3">
    <label>স্ট্যাটাস</label><span class="text-danger">*</span>
    <div class="input-group">
        <select class="form-control form-control-sm @error('status') is-invalid @enderror" name="status">
            <option @if(old('status') == '1') selected @endif value="1">Active</option>
            <option @if(old('status') == '0') selected @endif value="0">Inactive</option>
        </select>
    </div>
    @error('status')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="col-sm-6">
    <img src="{{asset('Backend/images/EmployeeImage')}}/{{$empData->image}}" class="img-fluid" style="height: 100px;width:100px;border-radius:100%;">
    <input type="hidden" name="image" value="{{$empData->image}}">
</div>
