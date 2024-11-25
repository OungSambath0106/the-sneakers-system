<div id="delete-gallery-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Delete Item</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 d-flex " style="gap: 1rem">
                    <p>Are you sure you want to delete this photo?</p>
                    <img style="width: 8rem;height:5rem" id="image-to-delete" src="" alt="Image to delete"
                        class="img-fluid" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Yes</button>
            </div>
        </div>
    </div>
</div>
