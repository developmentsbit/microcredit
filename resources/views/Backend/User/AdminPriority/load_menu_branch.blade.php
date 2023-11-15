@php 
use App\Models\main_menu_priority;
use App\Models\sub_menu_priority;
use App\Models\admin_branch_info;
use App\Models\admin_area_info;
@endphp
<div class="col-12" style="text-align: center;margin-top:10px;background:rgb(8, 7, 31);color:white;">
    <h5 style="color: white;">ব্রাঞ্চ নির্বাচন করুন</h5>
    </div>
<div class="col-12">
    <div class="menus mt-4">
        @if($branch)
        @foreach($branch as $showbranch)
        @php
        

        $branch_check = admin_branch_info::where('branch_id',$showbranch->id)
                      ->where('admin_id',$admin_id)
                      ->pluck('branch_id')
                      ->first();
        @endphp
        <div class="main_menus">
            <div class="custom-control custom-checkbox">
                <input @if($branch_check == $showbranch->id) checked @endif name="branch_id[]" onclick="branchCheck({{$showbranch->id}})" value="{{$showbranch->id}}" type="checkbox" class="" id="branch{{$showbranch->id}}">
                <label class="" for="branch{{$showbranch->id}}">{{$showbranch->branch_name}}</label>
            </div>
        </div>
        <div class="sub_menus row">
            @if($area)
            @foreach($area as $showarea)
            @if($showarea->branch_id == $showbranch->id)
            @php 
            $area_check = admin_area_info::where('admin_id',$admin_id)
                      ->where('branch_id',$showbranch->id)
                      ->where('area_id',$showarea->id)
                      ->pluck('area_id')
                      ->first();
            @endphp
            <div class="col-2">
                <div class="custom-control custom-checkbox">
                    <input @if($area_check == $showarea->id) checked @else disabled @endif name="area_id[]" value="{{$showbranch->id}}and{{$showarea->id}}" type="checkbox" class="" id="area_id{{$showbranch->id}}">
                    <label class="" for="">{{$showarea->area_name}}</label>
                </div>
            </div>
            @endif
            @endforeach
            @endif
        </div>
        @endforeach
        @endif
    </div>
</div>
<div class="col-12" style="text-align: center;margin-top:10px;background:rgb(8, 7, 31);color:white;">
<h5 style="color: white;">মেনু নির্বাচন করুন</h5>
</div>
<div class="col-sm-12 mb-3" id="check_all_menu">
    <div class="custom-control custom-checkbox">
        <input onclick="chkAll()" value="" type="checkbox" class="custom-control-input" id="check">
        <label class="custom-control-label" for="check">Check All Menu</label>
    </div>
</div>
<div class="col-12">
    <div class="menus mt-4">
        @if($main_menu)
        @foreach($main_menu as $show_main_menu)
        @php
        

        $main_check = main_menu_priority::where('main_menu_id',$show_main_menu->id)
                      ->where('admin_id',$admin_id)
                      ->pluck('main_menu_id')
                      ->first();
        @endphp
        <div class="main_menus">
            <div class="custom-control custom-checkbox">
                <input @if($main_check == $show_main_menu->id) checked @endif name="main_menu_id[]" onclick="menucheck({{$show_main_menu->id}})" value="{{$show_main_menu->id}}" type="checkbox" class="chk_main" id="main_menu{{$show_main_menu->id}}">
                <label class="" for="main_menu{{$show_main_menu->id}}">{{$show_main_menu->main_menu}}</label>
            </div>
        </div>
        <div class="sub_menus row">
            @if($sub_menu)
            @foreach($sub_menu as $show_sub_menu)
            @if($show_sub_menu->main_menu_id == $show_main_menu->id)
            @php 
            $sub_check = sub_menu_priority::where('admin_id',$admin_id)
                      ->where('main_menu_id',$show_main_menu->id)
                      ->where('sub_menu_id',$show_sub_menu->id)
                      ->pluck('sub_menu_id')
                      ->first();
            @endphp
            <div class="col-4">
                <div class="custom-control custom-checkbox">
                    <input @if($sub_check == $show_sub_menu->id) checked @else disabled @endif name="sub_menu_id[]" value="{{$show_main_menu->id}}and{{$show_sub_menu->id}}" type="checkbox" class="chk_sub" id="sub_menu-{{$show_main_menu->id}}">
                    <label class="" for="">{{$show_sub_menu->sub_menu}}</label>
                </div>
            </div>
            @endif
            @endforeach
            @endif
        </div>
        @endforeach
        @endif
    </div>
</div>
<script>
    function chkAll() {
        if ($("#check").is(':checked')) {
            $('.chk_main').prop('disabled', false);
            $('.chk_main').prop('checked', true);
            $('.chk_sub').prop('disabled', false);
            $('.chk_sub').prop('checked', true);
        } else {
            $('.chk_main').prop('checked', false);
            $('.chk_sub').prop('disabled', true);
            $('.chk_sub').prop('checked', false);
        }
    }

    function menucheck(id) {
        // alert(id);
        // $('#sub_menu'+id).prop('disabled',false);

        if ($("#main_menu" +id).is(':checked')) {
            $('input#sub_menu-' +id).prop('disabled', false);
            $('input#sub_menu-' +id).prop('checked', true);
        } else {
            $('input#sub_menu-' + id).prop('disabled', true);
            $('input#sub_menu' + id).prop('checked', false);
        }
    }


    function branchCheck(id) {
        // alert(id);
        // $('#sub_menu'+id).prop('disabled',false);

        if ($("#branch" +id).is(':checked')) {
            $('input#area_id' +id).prop('disabled', false);
            $('input#area_id' +id).prop('checked', true);
        } else {
            $('input#area_id' + id).prop('disabled', true);
            $('input#area_id' + id).prop('checked', false);
        }
    }
</script>