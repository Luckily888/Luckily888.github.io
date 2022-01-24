@extends('backend.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('menu.digital-currency-transfer')</h1>
    </div>

    

    <div class="card shadow mb-4">
        <div class="card-header row" style="margin:0px;">
            <div class="col-md-9 col-lg-7 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@lang('pages.balance')</h6>
            </div>
            <div class="col-md-4 col-lg-2" style="padding-top:5px;"><label for="chkhidezerobalance"><input type="checkbox" id="chkhidezerobalance" name="chkhidezerobalance" value="1" checked="checked" />&nbsp;Hide 0 Balance</label></div>
            <div class="col-md-4 col-lg-2"><input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search" /></div>
            <div class="col-md-4 col-lg-1" style="padding-left:0px;padding-top:5px;font-size:20px;"><a href="javascript:void(0);" class="fa fa-search"  id="btnsearch" style="text-decoration:none">&nbsp;</a></div>
        </div>
        <div class="card-body" style="overflow: scroll;" id="coins">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    {{--<th>#</th>--}}
                    <th>@lang('pages.coin-name')</th>
                    {{--<th>@lang('pages.coin-id')</th>--}}
                    <th>@lang('pages.balance')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                    {{--<td>-</td>--}}
                        <td>{{ $result->coin_name=='Alicorn'?'Elicoin':$result->coin_name }}</td>

                        {{--<td>{{ $result->coin_id }}</td>--}}
                        <td>{{ number_format($result->balance,8) }}</td>
                        <td><a href="{{ route('user.transfers.show',['coin_id' => $result->coin_id]) }}" class="btn btn-primary">@lang('pages.send-coin')</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('#chkhidezerobalance').change(function() {
                var hidezerobalance = 0;
                if($(this).is(":checked"))
                {
                    hidezerobalance = 1;
                }
                var keyword = $('#keyword').val();

                $.get( "<?= URL::to('/'); ?>/coins?keyword="+keyword+"&hidezerobalance="+hidezerobalance, function( resp ) {
                    $('#coins').html(resp);
                });
            });

            $('#btnsearch').click(function() {
                var hidezerobalance = 0;
                if($('#chkhidezerobalance').is(":checked"))
                {
                    hidezerobalance = 1;
                }
                var keyword = $('#keyword').val();

                $.get( "<?= URL::to('/'); ?>/coins?keyword="+keyword+"&hidezerobalance="+hidezerobalance, function( resp ) {
                    $('#coins').html(resp);
                });
            });

           
        })
    </script>
@endsection