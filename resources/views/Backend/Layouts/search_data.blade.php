@if($member)
@foreach ($member as $v)

<div class="row" style="border-bottom: 1px solid lightgray;color:black !important;">
    <div class="col-lg-3 col-md-3 col-12" style="border-right: 1px solid black;">
        <b>গ্রাহক তথ্য : ‍</b>
        <div class="member-link">
            <b>{{$v->member_id}}</b> : {{$v->aplicant_name}}
            <p>ফোন : {{$v->phone}}</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12" style="border-right: 1px solid black;color:black !important;">
        <b>সঞ্চয় তথ্য : ‍</b>
        @if($v->saving_id != NULL)
        <a href="{{route('saving_registration.show',$v->saving_pk_id)}}" style="color: black;">
            <div class="member-link">
                <b>{{$v->saving_id}}</b> : {{$v->aplicant_name}}
                <p>ফোন : {{$v->phone}}</p>
            </div>
        </a>
        @endif
    </div>
    <div class="col-lg-3 col-md-3 col-12" style="border-right: 1px solid black;color:black !important;">
        <b>ফিক্সড ডিপোজিট তথ্য : ‍</b>
        @if($v->fixed_deposit_id != NULL)
        <a style="color: black;">
            <div class="member-link">
                <b>{{$v->fixed_deposit_id}}</b> : {{$v->aplicant_name}}
                <p>ফোন : {{$v->phone}}</p>
            </div>
        </a>
        @endif
    </div>
    <div class="col-lg-3 col-md-3 col-12" style="border-right: 1px solid black;color:black !important;">
        <b>বিনিয়োগ তথ্য : ‍</b>
        @if($v->investor_id != NULL)
        <a target="_blank" href="{{url('viewinvestment')}}/{{$v->invest_id}}" style="color: black;">
            <div class="member-link">
                <b>{{$v->investor_id}}</b> : {{$v->aplicant_name}}
                <p>ফোন : {{$v->phone}}</p>
            </div>
        </a>
        @endif
    </div>
</div>
@endforeach
@endif
