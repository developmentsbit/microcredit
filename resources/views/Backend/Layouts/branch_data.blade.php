<div class="row mt-4">
    <div class="col-md-12 col-xl-4">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>মোট ঋণ আদায়</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$grandtotals['loan_recived']}} /-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>মোট ঋণ প্রদান</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$grandtotals['loan_provide']}} /-</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>মোট সঞ্চয় আদায়</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$grandtotals['saving_collection']}} /-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>মোট সঞ্চয় ফেরত</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$grandtotals['saving_provide']}} /-</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>মোট ডিপোজিট আদায়</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$grandtotals['deposit_collection']}} /-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>মোট ডিপোজিট ফেরত</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$grandtotals['deposit_provide']}} /-</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- daily --}}
<div class="row mt-4">
    <div class="col-md-12 col-xl-4">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>আজকের ঋণ আদায়</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$totals['total_loan_recived']}} /-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>আজকের ঋণ প্রদান</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$totals['total_loan_provide']}} /-</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>আজকের সঞ্চয় আদায়</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$totals['total_saving_collection']}} /-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>আজকের সঞ্চয় ফেরত</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$totals['total_saving_provide']}} /-</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>আজকের ডিপোজিট ফেরত</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$totals['total_deposit_collection']}} /-</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>আজকের ডিপোজিট প্রদান</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-md-center pt-2">
                            <h5>{{$totals['total_deposit_provide']}} /-</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
