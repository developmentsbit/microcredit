<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select Branchs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<style>
    div#box {
    background: #f1f1f1;
    padding: 14px;
}

.box-title {
    text-align: center;
    text-transform: uppercase;
}

.branch_link {
    margin-top: 35px;
}

.branch_link a {
    text-decoration: none !important;
    text-transform: uppercase;
    color: black;
    border: 1px solid lightgray;
    padding: 9px 26px;
    background: #f6eded;
    transition: .3s;
}

.branch_link a:hover {
    background: none;
}
</style>
<body>

    <div class="container" id="box">
        <div class="box-title">
            <h2>Select Your Branch</h2>
        </div>
        <div class="row">
            @if($branches)
            @foreach($branches as $showbranch)
            <div class="col-lg-4 col-md-6 col-6">
                <div class="branch_link">
                    <a href="{{url('dashboard')}}/{{$showbranch->branch_name}}/{{$showbranch->id}}" class="btn btn-block">{{$showbranch->branch_name}}</a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>