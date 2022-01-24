@extends('backend.layouts.main')

@section('content')
<div class="container">
    <h2 class="font-weight-400 text-center mt-3 mb-4">Payment</h2>
    <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
            <!-- Send Money Success
            ============================================= -->
            <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
                <div class="text-center my-5">
                    <p class="text-center text-success text-20 line-height-07" style="font-size: 5rem;"><i class="fas fa-check-circle"></i></p>
                    <p class="text-center text-success text-8 line-height-07">Success!</p>
                    <p class="text-center text-4">Transactions Complete</p>
                </div>
                <div class="row">
                    <div class="col-3 text-right"><img src="{{asset('landing/assets/images/payment-sender.svg')}}" width="30" height="30" alt=""> </div>
                    <div class="col-9">{{auth()->user()->name}}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-3 text-right"><img src="{{asset('landing/assets/images/payment-receiver.png')}}" width="30" height="30" alt=""> </div>
                    <div class="col-9">{{$receiveUser?$receiveUser->name:''}}</div>
                </div>

                <p class="text-center text-3 mb-4">{{$history->amount}} {{strtoupper($currency->symbol)}}</p>
                <a href="/payments" class="btn btn-primary btn-block">Send Money Again</a>
            </div>
        </div>
    </div>
</div>
@endsection