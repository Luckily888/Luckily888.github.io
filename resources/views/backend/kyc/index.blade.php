@extends('backend.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>@lang('pages.kyc-submission')</h1>
        </div>
        <div class="col-12">
            @if(session('status'))
                <div class="alert alert-{{session('status.class')}}">
                    <i class="fas fa-fw fa-info-circle"></i>
                    {{session('status.message')}}
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="fas fa-fw fa-info-circle"></i> @lang('pages.kyc-message')
                </div>
            @endif
        </div>
        <form class="row" action="{{ route('user.kyc.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>@lang('pages.address-proof')<span style="font-size: 0.5em;">@lang('pages.address-proof-sub')</span> </h4>
                        @if($oldKyc->address)
                        <div class="text-center mb-3">
                            <img src="{{$oldKyc->address}}" style="max-height: 400px;" class="img-fluid" alt="">
                        </div>
                        @endif
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" lang="{{App::getLocale()}}" name="address" style="z-index: 10;"
                                       id="inputGroupFile01"
                                       aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">@lang('pages.choose-file')</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>@lang('pages.id-proof')<span style="font-size: 0.5em;">@lang('pages.id-proof-sub')</span></h4>
                        @if($oldKyc->id_card)
                            <div class="text-center mb-3">
                                <img src="{{$oldKyc->id_card}}" style="max-height: 400px;" class="img-fluid" alt="">
                            </div>
                        @endif
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" lang="{{App::getLocale()}}" id="inputGroupFile02"
                                       aria-describedby="inputGroupFileAddon02" name="id">
                                <label class="custom-file-label" for="inputGroupFile02">@lang('pages.choose-file')</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>@lang('pages.photo-proof')</h4>
                        <p>@lang('pages.photo-proof-sub')</p>
                        @if($oldKyc->photo)
                            <p class="text-center mb-3">
                                <img src="{{$oldKyc->photo}}" height="450px">
                            </p>
                        @else
                            <p class="text-center mb-3">
                                <img src="https://ico.inphibit.com/img/id-card.png" height="450px">
                            </p>
                        @endif
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" lang="{{App::getLocale()}}" id="inputGroupFile03"
                                       aria-describedby="inputGroupFileAddon03" name="photo">
                                <label class="custom-file-label" for="inputGroupFile03">@lang('pages.choose-file')</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <button type="submit" class="w-100 btn btn-success">@lang('pages.submit-kyc')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
