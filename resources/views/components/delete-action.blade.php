
@props([
    'action',
    'name',
    'type' => 'record',
    'id'
])

<!-- DELETE BUTTON -->
<button
    type="button"
    class="btn btn-sm btn-outline-danger"
    data-bs-toggle="modal"
    data-bs-target="#deleteModal{{ $id }}"
>
    Delete
</button>

<!-- DELETE CONFIRMATION MODAL -->
@push('delete-modals')

<div
    class="modal fade"
    id="deleteModal{{ $id }}"
    tabindex="-1"
    aria-labelledby="deleteTitle{{ $id }}"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div
            class="modal-content text-white"
            style="
                background: #141b30;
                border: 1px solid #303b59;
                border-radius: 16px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            "
        >

            <!-- MODAL HEADER -->
            <div class="modal-header border-secondary">

                <h5
                    class="modal-title fw-bold"
                    id="deleteTitle{{ $id }}"
                >
                    Confirm Deletion
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>

            <!-- MODAL BODY -->
            <div class="modal-body">

                <p class="mb-3">
                    Are you sure you want to delete this {{ $type }}?
                </p>

                <div
                    class="p-3 rounded"
                    style="
                        background: #202a45;
                        border: 1px solid #354365;
                    "
                >
                    <strong>{{ $name }}</strong>
                </div>

                <p class="small text-warning mt-3 mb-0">
                    This action cannot be undone.
                </p>

            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer border-secondary">

                <!-- CANCEL BUTTON -->
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Cancel
                </button>

                <!-- CONFIRM DELETE -->
                <form
                    method="POST"
                    action="{{ $action }}"
                    class="m-0"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Delete
                    </button>
                </form>

            </div>

        </div>

    </div>
</div>

@endpush
