<!-- Modal -->
<div class="modal fade modal-danger text-start" id="deleteModal" tabindex="-1" aria-labelledby="myModalLabel120"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title deleteTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <p>You cannot undo this operation after it is excuted</p>
                </div>
                <input type="hidden" id="delete_id" />
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal"
                        aria-label="Close">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger me-1 mt-1" id="delete_btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
