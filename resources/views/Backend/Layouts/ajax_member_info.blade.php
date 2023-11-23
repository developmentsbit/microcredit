@if($memberData['member'])
<div class="row">
    <div class="col-lg-3 col-md-6 col-12" id="accCard">
        <b>গ্রাহক তথ্য :</b><br>
        <b>{{$memberData['member']->member_id}}-{{$memberData['member']->aplicant_name}}</b><br>
        <span>ব্রাঞ্চ : </span> {{$memberData['member']->branch_name}} | <span>কেন্দ্র : </span> {{$memberData['member']->area_name}}
    </div>
    @if(count($memberData['saving']) > 0)
    <div class="col-lg-3 col-md-6 col-12" id="accCard">
        <b>সঞ্চয় তথ্য :</b><br>
        @foreach($memberData['saving'] as $saving)
        <hr>
        <b>{{$saving->registration_id}}-{{$memberData['member']->aplicant_name}}</b><br>
        <span>ব্রাঞ্চ : </span> {{$saving->branch_name}} | <span>কেন্দ্র : </span> {{$saving->area_name}}
        @endforeach
    </div>
    @endif

    @if(count($memberData['deposit']) > 0)
    <div class="col-lg-3 col-md-6 col-12" id="accCard">
        <b>ডিপোজিট তথ্য :</b><br>
        @foreach ($memberData['deposit'] as $deposit)
        <hr>
        <b>{{$deposit->registration_id}}-{{$memberData['member']->aplicant_name}}</b><br>
        <span>ব্রাঞ্চ : </span> {{$deposit->branch_name}} | <span>কেন্দ্র : </span> {{$deposit->area_name}}
        @endforeach
    </div>
    @endif

    @if(count($memberData['invest']) > 0)
    <div class="col-lg-3 col-md-6 col-12" id="accCard">
        <b>বিনিয়োগ তথ্য :</b><br>
        @foreach ($memberData['invest'] as $invest)
        <hr>
        <b>{{$invest->registration_id}}-{{$memberData['member']->aplicant_name}}</b><br>
        <span>ব্রাঞ্চ : </span> {{$invest->branch_name}} | <span>কেন্দ্র : </span> {{$invest->area_name}}
        @endforeach
    </div>
    @endif
</div>
@endif
