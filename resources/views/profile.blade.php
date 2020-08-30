@extends('layouts.main')

@push('styles')

@endpush

@section('title')
Agent Profile
@endsection

@section('content')

<h3 class="text-dark mb-4">
    Profile
</h3>
<div id="agent-profile">
    <div class="row mb-3">
        <div class="col-lg-5">
            <div class="card mb-3">
                <div class="card-body text-center shadow">
                    <img
                        class="rounded-circle img-fluid mb-3 mt-4"
                        src="{{ $user->profile->avatar_url }}"
                        width="160px"
                        height="auto" />

                    <div class="mb-3">
                        <h3 class="font-weight-bold">
                            {{ $user->profile->full_name }}
                        </h3>

                        <p>
                            {{ $user->profile->about ?? "No Profile Summary" }}
                        </p>
                    </div>

                    <link-copy
                        link="{{ $user->user_link }}"
                    ></link-copy>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold m-0">
                        Links
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <x-split-button
                            icon="fas fa-store-alt"
                            label="Sales"
                            :link="$user->user_sales_link"
                        ></x-split-button>

                        @auth
                            @if (Auth::id() == $user->id)
                                <x-split-button
                                    icon="fas fa-user-edit"
                                    label="Edit"
                                    :link="route('profile.edit')"
                                ></x-split-button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

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
        </div>

        <div class="col-lg-7">
            {{-- <div class="row mb-3 d-none">
                <div class="col">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i> 5% since last month</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i> 5% since last month</p>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- System not yet built --}}
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary m-0 font-weight-bold">
                                Reviews and Rating
                            </h6>
                        </div>

                        <div class="card-body">
                            {{-- Statr of Review Card --}}
                            <div class="media bg-white border rounded border-white shadow-sm p-1 mb-2">
                                <img
                                    class="rounded-circle img-fluid mr-3"
                                    src="profile.jpg"
                                    width="48px"
                                    loading="lazy" />
                                <div class="media-body">
                                    <h6 class="font-weight-bold">
                                        Meyoron Aghogho
                                        <a
                                            class="btn btn-outline-success btn-sm float-right"
                                            role="button"
                                            href="profile.html"
                                            target="_blank">
                                            View Profile
                                        </a>
                                    </h6>

                                    <small>
                                        Lorem ipsum
                                        dolor sit amet, consectetur adipiscing elit. Duis maximus nisl ac diam feugiat,
                                        non vestibulum libero posuere. Vivamus pharetra leo non nulla egestas, nec
                                        malesuada orci finibus.<br />
                                    </small>
                                </div>
                            </div>
                            {{-- End of Review Card --}}

                            <button
                                class="btn btn-primary d-block m-auto"
                                type="button">
                                More Reviews
                            </button>

                            <div class="text-white bg-secondary rounded-pill overflow-hidden m-2">
                                <h5 class="text-center">
                                    Rating
                                </h5>

                                <div class="progress">
                                    <div
                                        class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                        aria-valuenow="80"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        style="width: 80%;">
                                        <span class="sr-only">
                                            80%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shadow card mb-4">
        <a
            class="btn btn-link text-left card-header font-weight-bold"
            data-toggle="collapse"
            aria-expanded="true"
            aria-controls="ongoing_sales_collapse"
            href="#ongoing_sales_collapse"
            role="button">
            Ongoing Sales...
        </a>

        <div class="collapse show" id="ongoing_sales_collapse">
            <div class="row no-gutters p-2">
                <sales-card
                    v-for="item, key in sales"
                    :key="key"
                    :item="item"
                ></sales-card>

                <content-loader
                    :list="sales"
                    icon="fas fa-store-alt"
                    label="More Sales"
                    target="{{ $user->user_sales_peek_link }}"
                    class="d-none"
                ></content-loader>
            </div>
        </div>
    </div>

    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Inform The Community</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <h4 class="font-weight-bold">Review User</h4>
                        <div class="form-group"><label for="review"><strong>Review</strong><br /></label><textarea
                                class="form-control" rows="4" name="review"></textarea></div>
                        <div class="form-group"><label class="d-block"
                                for="rating"><strong>Rating</strong><br /></label><input type="number"
                                class="form-control d-inline w-auto rounded-pill" name="rating" value="3.0" min="1.0"
                                max="5.0" step="0.5" required /><span>stars</span></div>
                        <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Submit
                                Review</button></div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="text-white bg-danger border rounded p-3">
                        <h4 class="font-weight-bold">Report User</h4>
                        <div class="form-group"><label for="title"><strong>Title</strong><br /></label><input type="text"
                                class="form-control" name="title" placeholder="Short and Descriptive Title" /></div>
                        <div class="form-group"><label for="description"><strong>Description</strong><br /></label><textarea
                                class="form-control" rows="4" name="description"
                                placeholder="Describe the wrong doing  of this user"></textarea></div>
                        <div class="form-group"><button class="btn btn-danger btn-sm border rounded border-white shadow-sm"
                                type="submit">Send
                                Report</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@js_m(vue_apps/profile)
@endpush
