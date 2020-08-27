@extends('layouts.main')

@push('styles')

@endpush

@section('title')
New Sale
@endsection

@section('content')
<div class="row">
    <div class="col">
        <axios-form
            action="{{ route('item.create') }}"
            method="POST"
            data-dontreset="true"
            loading="Posting your sale"
            submit="Sell"
            id="create-sales-form">

            <div class="form-group">
                <h4 class="text-center">
                    Fill Item's Details Below
                </h4>
            </div>

            <div class="form-row">
                <div class="col-12 col-md-6">
                    <styled-input
                        name="title"
                        type="text"
                        label="Title"
                        :required="true"
                        placeholder="Title of sales item"
                    ></styled-input>

                    <styled-input
                        name="phone"
                        type="tel"
                        label="Phone"
                        :required="true"
                        placeholder="+234..."
                    ></styled-input>

                    <div class="form-row align-items-center">
                        <div class="col">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input
                                        class="custom-control-input"
                                        type="checkbox"
                                        id="public_negotiation"
                                        name="public_negotiation">

                                    <label
                                        class="custom-control-label text-nowrap"
                                        for="public_negotiation">
                                        Public Negotiations
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <styled-input
                                name="amount"
                                type="number"
                                label="Amount"
                                :required="true"
                                placeholder="Intended Selling Price"
                            ></styled-input>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="description">
                            Description of Sales
                        </label>

                        <textarea
                            class="form-control"
                            id="description"
                            name="description"
                            placeholder="Describe the item you are putting up for sales"
                            rows="5"
                            required=""
                        ></textarea>
                    </div>
                </div>
            </div>

            <category-select></category-select>

            <!-- Start: Locations Row -->
            <div class="form-row py-3">
                <div class="col-12">
                    <h6 class="text-center">
                        <strong>
                            Delivery Locations
                        </strong>
                    </h6>
                </div>

                <div
                    v-for="value, index in locations"
                    :key="value"
                    class="col-12 col-lg-6">
                    <div class="form-row align-items-center p-1 mb-3">
                        <div class="col-12 col-sm-5 mb-1">
                            <state-select
                                :name="`location[${index}][state]`"
                                label="State"
                                :required="true"
                            ></state-select>
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <div
                                class="form-group text-white bg-secondary d-flex align-items-center rounded-pill border m-0">
                                <label class="my-0 mx-1">
                                    Region
                                </label>

                                <input
                                    class="form-control rounded-pill border-0 shadow-none bg-white"
                                    type="text"
                                    :name="`location[${index}][region]`"
                                    placeholder="Region within the state">
                            </div>
                        </div>

                        <div class="col-12 col-sm-1 p-1 mb-1">
                            <div class="form-group mb-0">
                                <button
                                    @click="removeLocation(value)"
                                    class="btn btn-outline-danger btn-block btn-sm"
                                    type="button">
                                    <span class="d-sm-none">
                                        Remove Location
                                    </span>
                                    <i class="fa fa-close d-none d-sm-block"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group text-center">
                        <button
                            class="btn btn-outline-success btn-lg"
                            @click="addLocation"
                            type="button">
                            Add Location
                        </button>
                    </div>
                </div>
            </div>
            <!-- End: Locations Row -->

            <!-- Start: Attachments Row -->
            <div class="form-row py-3">
                <div class="col-12">
                    <h6 class="text-center">
                        <strong>
                            Attachments
                        </strong>
                    </h6>
                </div>

                <image-caption
                    v-for="image, index in images"
                    :key="image"
                    :index="index"
                    @delete_image="removeImage(image)"
                ></image-caption>

                <div class="col-12">
                    <div class="form-group text-center">
                        <button
                            class="btn btn-outline-success btn-lg"
                            @click="addImage"
                            type="button">
                            Add Attachment
                        </button>
                    </div>
                </div>
            </div>
            <!-- End: Attachments Row -->
        </axios-form>
    </div>
</div>
@endsection

@push('scripts')
    @js_m(vue_apps/create)
@endpush
