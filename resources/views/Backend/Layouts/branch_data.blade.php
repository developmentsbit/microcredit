<div class="row">
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card bg-danger">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/trend.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের ঋণ আদায়যোগ্য</b><br>
                    <h5>00/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/attachment.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের ঋণ আদায়</b><br>
                    <h5>{{$totals['total_loan_recived']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card bg-danger">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/coins.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের ঋণ বকেয়া</b><br>
                    <h5>00/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card bg-danger">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/receipt (1).png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>Regular Recover</b><br>
                    <h5>00/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card bg-danger">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/coin.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>Due Recover</b><br>
                    <h5>00/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card bg-danger">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/money-sack.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>Advance Recover</b><br>
                    <h5>00/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card bg-danger">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/receipt.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>Expire Recover</b><br>
                    <h5>00/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card bg-danger">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/dollar-symbol.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>Todays Disbursment</b><br>
                    <h5>00/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/cheque.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের ডিপোজিট আদায়</b><br>
                    <h5>{{$totals['total_deposit_collection']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend')}}/images/icon/payment-check.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের ডিপোজিট ফেরত</b><br>
                    <h5>{{$totals['total_deposit_provide']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend')}}/images/icon/save-money.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের সঞ্চয় আদায়</b><br>
                    <h5>{{$totals['total_saving_collection']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend')}}/images/icon/invest.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের সঞ্চয় ফেরত</b><br>
                    <h5>{{$totals['total_saving_provide']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/data-collection.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের  H/O আদায়</b><br>
                    <h5>{{$totals['ho_collections']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/payment.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের  H/O প্রদান</b><br>
                    <h5>{{$totals['ho_provides']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/wallet (1).png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের নগদ আদায়</b><br>
                    <h5>{{$totals['total_cash_recived']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/credit-card.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের নগদ প্রদান</b><br>
                    <h5>{{$totals["total_cash_payment"]}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/invoice.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের আয়</b><br>
                    <h5>{{$totals['total_income']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/bill.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>আজকের ব্যায়</b><br>
                    <h5>{{$totals['total_expense']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-md-4 col-sm-2 card-body">
                     <img src="{{asset('Backend/images/icon')}}/cash-machine.png" alt="">
                </div>
                <div class="col-sm-8 card-body" id="ticket">
                <div class="text-center">
                    <b>হাতে নগদ</b><br>
                    <h5>{{$totals['cash_in_hand']}}/-</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
