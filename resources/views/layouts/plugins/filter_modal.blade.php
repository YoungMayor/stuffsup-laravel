@push('scripts')
@js_m(vue_apps/filter)
@endpush

<div class="modal fade" role="dialog" tabindex="-1" id="market_filter_modal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Filter Results
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('market', [
                    'type' => 'filter'
                ]) }}" method="GET" id="filter-market-item">
                    <styled-input
                        name="search"
                        type="search"
                        label="Search"
                        placeholder="Leave empty to skip searching"
                    ></styled-input>

                    <small class="form-text text-center text-muted">
                        Search is optional. Leave empty to skip Stuff Searching
                    </small>

                    <state-select></state-select>

                    <category-select
                        method="buttons"
                    ></category-select>


                    <div class="form-group text-right">
                        <button class="btn btn-primary" type="submit">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
