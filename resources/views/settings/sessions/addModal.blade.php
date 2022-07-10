
<!-- add new card modal  -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h2 class="text-center mb-1" id="addNewCardTitle">Add New Session</h2>
               
                <div id="error_list"><ul ></ul></div>
                <!-- form -->
                <form class="row gy-1 gx-2 mt-75">
                    <div class="col-12">
                        <label class="form-label" for="modalAddCardNumber">Session Name</label>
                        <input id="name" class="form-control" type="text" placeholder="Session Name"  />
                    </div>
    
            
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-1 mt-1" id="add_btn">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!--/ add new card modal  -->