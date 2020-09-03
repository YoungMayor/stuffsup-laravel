<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="text-primary font-weight-bold m-0">
            Account Summary
        </h6>
    </div>

    <div class="card-body">
        <h6 class="text-left">
            Member since
            <span class="float-right font-weight-bold">
                {{ $user->created_at->format('F jS, Y') }}
            </span>
        </h6>

        <h6 class="text-left">
            Total Sales
            <span class="float-right font-weight-bold">
                {{ $user->sales()->count() }}
            </span>
        </h6>

        <h6 class="text-left">
            Ongoing Sales
            <span class="float-right font-weight-bold">
                {{ $user->sales()->ongoingSales()->count() }}
            </span>
        </h6>

        <h6 class="text-left">
            Total Negotiations
            <span class="float-right font-weight-bold">
                {{ $user->offers()->count() }}
            </span>
        </h6>

        {{--
            @TODO
            Add Active Negotiations here
        --}}
    </div>
</div>
