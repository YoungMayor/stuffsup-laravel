@extends('layouts.main')

@push('styles')

@endpush

@section('title')
Agent Profile
@endsection

@section('content')

<h3 class="text-dark mb-4">
    Edit Profile
</h3>

<div class="row mb-3" id="agent-profile-edit">
    <div class="col-lg-5">
        <div class="card mb-3">
            <div class="card-body text-center shadow">
                <img
                    class="rounded-circle img-fluid mb-3 mt-4"
                    src="{{ $user->profile->avatar_url }}"
                    width="160px"
                    height="auto" />

                <div class="mb-3">
                    <button
                        class="btn btn-primary btn-sm"
                        type="button">
                        Change Photo
                    </button>
                </div>
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

                    <x-split-button
                        icon="fas fa-user"
                        label="View Profile"
                        :link="route('profile.self')"
                    ></x-split-button>
                </div>
            </div>
        </div>

        <x-account-summary
            :user="$user"
        ></x-account-summary>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary m-0 font-weight-bold">
                    About You
                </h6>
            </div>

            <div class="card-body">
                <textarea-form
                    target="{{ $user->profile->edit_about_link }}"
                    heading="Describe yourself and what you deal on"
                    placeholder="Make it descriptive"
                    field="about"
                    submit="Save about"
                    value="{{ $user->profile->about }}"
                    data-dontreset="true"
                ></textarea-form>
            </div>
        </div>
        <!-- End: Basic Card -->
    </div>
    <div class="col-lg-7">
        {{-- <!-- Start: Unused Cards -->
        <div class="row mb-3 d-none">
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
                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
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
                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Unused Cards --> --}}

        <div class="row">
            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">
                            Contact Settings
                        </p>
                    </div>

                    <div class="card-body">
                        <axios-form
                            action="{{ $user->profile->edit_contact_link }}"
                            method="POST"
                            loading="Updating your profile"
                            data-dontreset="true"
                            submit="Update Profile">

                            <protected-field
                                unlock_button="Modify Settings"
                                unlock_action="modify your email address and/or username">

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="username">
                                                <strong>
                                                    Username
                                                </strong>
                                            </label>

                                            <input
                                                class="form-control"
                                                type="text"
                                                placeholder="user.name_123"
                                                name="name"
                                                pattern="{{ $user->username_regex() }}"
                                                required=""
                                                value="{{ $user->name }}" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">
                                                <strong>
                                                    Email
                                                </strong>
                                            </label>

                                            <input
                                                class="form-control"
                                                type="email"
                                                placeholder="user@example.com"
                                                name="email"
                                                required=""
                                                value="{{ $user->email }}" />
                                        </div>
                                    </div>

                                    <div class="col col-12 col-sm-auto">
                                        <div class="form-group">
                                            <label for="email">
                                                <strong>
                                                    Password
                                                </strong>
                                            </label>

                                            <input
                                                class="form-control"
                                                type="password"
                                                placeholder="Enter you password"
                                                name="password"
                                                required=""
                                                value="" />

                                            <div class="small text-center">
                                                <span>
                                                    Your password is needed to modify your username or email
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </protected-field>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first_name">
                                            <strong>
                                                First Name
                                            </strong>
                                        </label>

                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder="John"
                                            name="first_name"
                                            id="first_name"
                                            required=""
                                            pattern="{{ $user->name_regex() }}"
                                            value="{{ $user->profile->first_name }}" />
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="last_name">
                                            <strong>
                                                Last Name
                                            </strong>
                                        </label>

                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder="Doe"
                                            name="last_name"
                                            id="last_name"
                                            required=""
                                            pattern="{{ $user->name_regex() }}"
                                            value="{{ $user->profile->last_name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <small class="text-warning">
                                    * Changes to your username may create some
                                    unexpected side-effects. All previously shared
                                    profile and account link would be rendered ineffective.
                                </small>
                            </div>

                            <div class="form-row">
                                <small class="text-warning">
                                    * Changing your email address would require
                                    email validation
                                </small>
                            </div>
                        </axios-form>
                    </div>
                </div>

                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">
                            Location Settings
                        </p>
                    </div>

                    <div class="card-body">
                        <axios-form
                            action="{{ $user->profile->edit_location_link }}"
                            method="POST"
                            loading="Updating your location"
                            data-dontreset="true"
                            submit="Update Location">
                            <styled-input
                                label="Address"
                                :required="true"
                                name="address"
                                placeholder="Your address"
                                value="{{ $user->profile->address }}"
                            ></styled-input>

                            <styled-input
                                label="City"
                                :required="true"
                                name="city"
                                placeholder="Your city name"
                                value="{{ $user->profile->city }}"
                            ></styled-input>

                            <state-select
                                :with_nation="false"
                                value="{{ $user->profile->state }}"
                            ></state-select>

                            <div class="form-group text-center">
                                <small>
                                    Contact Details are not disclosed to users
                                </small>
                            </div>
                        </axios-form>
                    </div>
                </div>

                <!-- Start: Basic Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary m-0 font-weight-bold">
                            Change Password
                        </h6>
                    </div>
                    <div class="card-body">
                        <protected-field
                            unlock_button="Change Password"
                            unlock_action="change your password">
                            <axios-form
                                action="{{ $user->profile->edit_password_link }}"
                                method="POST"
                                loading="Performing Password Change"
                                submit="Change Password">
                                <div class="form-group text-center">
                                    <small class="form-text text-warning">
                                        Create a new secure password and enter your
                                        current password to change your password.
                                    </small>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <input
                                                class="form-control rounded-pill shadow-none"
                                                type="password"
                                                name="password"
                                                placeholder="Create new password"
                                                required="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <input
                                                class="form-control rounded-pill shadow-none"
                                                type="password"
                                                name="password_confirmation"
                                                placeholder="Enter your password to confirm"
                                                required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row align-items-center">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label
                                                class="small font-weight-bold"
                                                for="current_password">
                                                Enter current password
                                            </label>

                                            <input
                                                type="password"
                                                class="form-control rounded-pill shadow-none"
                                                name="current_password"
                                                placeholder="Your current password" />
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label
                                                class="small font-weight-bold">
                                                This will log you out of all your
                                                logged in devices
                                            </label>

                                            <div class="custom-control custom-switch">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="logout_others"
                                                    required="true"
                                                    name="logout_others" />

                                                <label
                                                    class="custom-control-label"
                                                    for="logout_others">
                                                    I understand
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <small class="form-text text-muted">
                                        Becareful to use a secure yet memorable
                                        password for your account.
                                    </small>
                                </div>
                            </axios-form>
                        </protected-field>
                    </div>
                </div>
                <!-- End: Basic Card -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@js_m(vue_apps/profile-edit)
@endpush
