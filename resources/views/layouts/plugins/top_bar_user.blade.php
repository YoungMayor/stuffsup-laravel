@extends('layouts.top_bar')

@push('scripts')
    @js_m(vue_apps/notifications)
@endpush

@section('menu')
<li
    data-count-link="{{ route('api.get_notification_count', [
        'user' => Auth::user()->name
    ]) }}"
    class="nav-item dropdown no-arrow mx-1"
    role="presentation"
    id="notification-center">
    <div class="nav-item dropdown no-arrow">
        <button
            class="btn btn-primary dropdown-toggle"
            data-toggle="dropdown"
            aria-expanded="false"
            type="button">
            <span class="badge badge-danger badge-counter">
                <i class="fas fa-spinner fa-spin" v-if="getting_count"></i>
                <template v-else>
                    @{{ notification_count }}
                </template>
            </span>
            <i class="fas fa-bell fa-fw"></i>
        </button>

        <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
            role="menu">
            <h6 class="dropdown-header">
                Alerts Center
            </h6>

            <notification-card
                v-for="notification, key in notifications"
                :key="key"
                :notification="notification"
            ></notification-card>

            <a class="text-center dropdown-item small text-gray-500" href="#">
                Show All Alerts
            </a>

            <content-loader
                :list="notifications"
                target="{{ route('api.get_notifications', [
                    'user' => Auth::user()->name
                ]) }}"
                :show_button="false"
            ></content-loader>
        </div>
    </div>
</li>

<li class="nav-item dropdown no-arrow mx-1" role="presentation">
    <div class="nav-item dropdown no-arrow">
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
            aria-expanded="false" type="button">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger badge-counter">7</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
            role="menu">
            <h6 class="dropdown-header">alerts center</h6>
            <a class="d-flex align-items-center dropdown-item" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle"
                        src="@imgURL(avatars/avatar4.jpeg)">
                    <div class="bg-success status-indicator"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">
                        <span>Hi there! I am wondering if you can help me with a problem I've
                            been having.</span>
                    </div>
                    <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                </div>
            </a>
            <a class="d-flex align-items-center dropdown-item" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle"
                        src="@imgURL(avatars/avatar2.jpeg)">
                    <div class="status-indicator"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">
                        <span>I have the photos that you ordered last month!</span>
                    </div>
                    <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                </div>
            </a>
            <a class="d-flex align-items-center dropdown-item" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle"
                        src="@imgURL(avatars/avatar3.jpeg)">
                    <div class="bg-warning status-indicator"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">
                        <span>Last month's report looks great, I am very happy with the progress
                            so far, keep up the good work!</span>
                    </div>
                    <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                </div>
            </a>
            <a class="d-flex align-items-center dropdown-item" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle"
                        src="@imgURL(avatars/avatar5.jpeg)">
                    <div class="bg-success status-indicator"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">
                        <span>Am I a good boy? The reason I ask is because someone told me that
                            people say this to all dogs, even if they aren't good...</span>
                    </div>
                    <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                </div>
            </a>
            <a class="text-center dropdown-item small text-gray-500" href="#">Show All
                Alerts</a>
        </div>
    </div>
    <div class="shadow dropdown-list dropdown-menu dropdown-menu-right"
        aria-labelledby="alertsDropdown"></div>
</li>

<div class="d-none d-sm-block topbar-divider"></div>

<li class="nav-item dropdown no-arrow" role="presentation">
    <div class="nav-item dropdown no-arrow">
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
            aria-expanded="false" type="button">
            <span class="text-white d-none d-lg-inline mr-2 small">Meyoron Aghogho</span>
            <img class="border rounded-circle img-profile"
                src="@imgURL(profile.jpg)"
                style="width: 48px;height: 48px;">
        </button>
        <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
            <a class="dropdown-item" role="presentation" href="profile-self.html">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                &nbsp;Edit Profile
            </a>
            <a class="dropdown-item" role="presentation" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                &nbsp;Settings
            </a>
            <a class="dropdown-item" role="presentation" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                &nbsp;Activity log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" role="presentation" href="#">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                &nbsp;Logout
            </a>
        </div>
    </div>
</li>
@endsection
