<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>@lang('pages.coin-name')</th>
            <th>@lang('pages.balance')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($balances as $balance)
            <tr>
                <td>{{ $balance->coin_name }}</td>
                <td>{{ number_format($balance->balance,8) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>