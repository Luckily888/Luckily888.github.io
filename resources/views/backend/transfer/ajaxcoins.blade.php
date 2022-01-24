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