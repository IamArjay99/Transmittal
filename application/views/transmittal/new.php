<div class="page-wrapper">
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#">Transmittal</a></li>
                <li class="breadcrumb-item active" aria-current="page">New Transmittal</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-block">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="page-title card-title text-bold font-weight-bold mb-0">New Transmittal</h6>
                            <button class="btn btn-primary" id="btn_import_files"><i class="fas fa-file-upload"></i> Upload File</button>
                        </div><hr>

                        <div class="my-3" id="table_ncr_transmittal_parent"></div>
                        <div class="my-3" id="table_nationwide_transmittal_parent"></div>
                        <div id="buttons_element"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ----- IMPORT FILES MODAL ----- -->
<div class="modal fade" id="modal_import_files" tabindex="-1" role="dialog" aria-labelledby="modal_import_files" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary d-flex justify-content-between align-items-center">
            <h4 class="text-light my-0">UPLOAD FILE</h4>
            <button type="button" class="close" id="modal_import_files_no" aria-label="Close"><span aria-hidden="true" class="text-ligth">&times;</span></button>
        </div>
        <div class="modal-body pb-3">
            <div class="form-group">
                <label for="company_name" class="d-block">Company Name</label>
                <input id="company_name" class="form-control form-control-sm" type="text" name="">
                <div class="invalid-feedback d-block" id="invalid-company_name"></div>
            </div>
            <div class="form-group">
                <label for="excel_file">File</label>
                <input id="excel_file" class="form-control form-control-sm" type="file" accept=".xlsx,.xls">
                <div class="invalid-feedback d-block" id="invalid-excel_file"></div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_import_files_yes"><i class="fas fa-save "></i> Save</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END IMPORT FILES MODAL ----- -->


<!-- ----- CONFIRMATION IMPORT FILES MODAL ----- -->
<div class="modal fade" id="modal_confirmation_import_files" tabindex="-1" role="dialog" aria-labelledby="modal_confirmation_import_files" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-body pb-2 text-center">
            <img src="<?= base_url().'assets/img/modals/question.png' ?>" alt="Question" style="width: 80%; max-width: 100%; height: 250px;">
            <h4>Do you really want to upload this file?</h4>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_confirmation_import_files_yes"><i class="fas fa-check"></i> YES</button>
                <button type="button" class="btn btn-danger shadow-none" id="modal_confirmation_import_files_no"><i class="fas fa-times"></i> NO</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END CONFIRMATION IMPORT FILES MODAL ----- -->


<!-- ----- CONFIRMATION CLEAR TRANSMITTAL MODAL ----- -->
<div class="modal fade" id="modal_confirmation_clear_transmittal" tabindex="-1" role="dialog" aria-labelledby="modal_confirmation_clear_transmittal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-body pb-2 text-center">
            <img src="<?= base_url().'assets/img/modals/question.png' ?>" alt="Question" style="width: 80%; max-width: 100%; height: 250px;">
            <h4>Do you really want to clear all transmittal?</h4>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_confirmation_clear_transmittal_yes"><i class="fas fa-check"></i> YES</button>
                <button type="button" class="btn btn-danger shadow-none" data-dismiss="modal" id="modal_confirmation_clear_transmittal_no"><i class="fas fa-times"></i> NO</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END CONFIRMATION CLEAR TRANSMITTAL MODAL ----- -->


<!-- ----- CONFIRMATION DELETE TRANSMITTAL MODAL ----- -->
<div class="modal fade" id="modal_confirmation_delete_transmittal" tabindex="-1" role="dialog" aria-labelledby="modal_confirmation_delete_transmittal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-body pb-2 text-center">
            <img src="<?= base_url().'assets/img/modals/question.png' ?>" alt="Question" style="width: 80%; max-width: 100%; height: 250px;">
            <h4>Do you really want to delete these transmittal?</h4>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_confirmation_delete_transmittal_yes"><i class="fas fa-check"></i> YES</button>
                <button type="button" class="btn btn-danger shadow-none" data-dismiss="modal" id="modal_confirmation_delete_transmittal_no"><i class="fas fa-times"></i> NO</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END CONFIRMATION DELETE TRANSMITTAL MODAL ----- -->


<!-- ----- CONFIRMATION MOVE TRANSMITTAL MODAL ----- -->
<div class="modal fade" id="modal_confirmation_move_transmittal" tabindex="-1" role="dialog" aria-labelledby="modal_confirmation_move_transmittal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-body pb-2 text-center">
            <img src="<?= base_url().'assets/img/modals/question.png' ?>" alt="Question" style="width: 80%; max-width: 100%; height: 250px;">
            <h4>Do you want to move these transmittal to <span id="move_to"></span>?</h4>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_confirmation_move_transmittal_yes"><i class="fas fa-check"></i> YES</button>
                <button type="button" class="btn btn-danger shadow-none" data-dismiss="modal" id="modal_confirmation_move_transmittal_no"><i class="fas fa-times"></i> NO</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END CONFIRMATION MOVE TRANSMITTAL MODAL ----- -->


<!-- ----- CONFIRMATION SAVE TRANSMITTAL MODAL ----- -->
<div class="modal fade" id="modal_confirmation_save_transmittal" tabindex="-1" role="dialog" aria-labelledby="modal_confirmation_save_transmittal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-body pb-2 text-center">
            <img src="<?= base_url().'assets/img/modals/question.png' ?>" alt="Question" style="width: 80%; max-width: 100%; height: 250px;">
            <h4>Do you really want to save these transmittal?</h4>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_confirmation_save_transmittal_yes"><i class="fas fa-check"></i> YES</button>
                <button type="button" class="btn btn-danger shadow-none" data-dismiss="modal" id="modal_confirmation_save_transmittal_no"><i class="fas fa-times"></i> NO</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END CONFIRMATION SAVE TRANSMITTAL MODAL ----- -->


<!-- ----- EDIT TRANSMITTAL MODAL ----- -->
<div class="modal fade" id="modal_edit_transmittal" tabindex="-1" role="dialog" aria-labelledby="modal_edit_transmittal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title text-light my-0" id="my-modal-title">UPDATE TRANSMITTAL</h4>
            <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body pb-2">
            <div class="form-group">
                <label for="">Company Name</label>
                <input type="text" class="form-control" id="edit_company_name">
            </div>
            <div class="form-group">
                <label for="">Receiver Name</label>
                <input type="text" class="form-control" id="edit_receiver_name">
            </div>
            <div class="form-group">
                <label for="">Receiver Telephone</label>
                <input type="text" class="form-control" id="edit_receiver_telephone">
            </div>
            <div class="form-group">
                <label for="">Receiver Address</label>
                <input type="text" class="form-control" id="edit_receiver_address">
            </div>
            <div class="form-group">
                <label for="">Receiver Province</label>
                <input type="text" class="form-control" id="edit_receiver_province">
            </div>
            <div class="form-group">
                <label for="">Receiver City</label>
                <input type="text" class="form-control" id="edit_receiver_city">
            </div>
            <div class="form-group">
                <label for="">Receiver Region</label>
                <input type="text" class="form-control" id="edit_receiver_region">
            </div>
            <div class="form-group">
                <label for="">Parcel Name</label>
                <input type="text" class="form-control" id="edit_parcel_name">
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Total Parcel</label>
                        <input type="text" class="form-control" id="edit_total_parcel">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">COD</label>
                        <input type="text" class="form-control" id="edit_cod">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Remarks</label>
                        <input type="text" class="form-control" id="edit_remarks">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_edit_transmittal_update"><i class="fas fa-paper"></i> UPDATE</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END EDIT TRANSMITTAL MODAL ----- -->


<!-- ----- REQUIRED FOR UPLOADING FILE ----- -->
<script src="<?= base_url().'assets/js/xlsx.full.min.js' ?>"></script> 
<!-- ----- END REQUIRED FOR UPLOADING FILE ----- -->


<!-- ----- VIEW'S JAVASCRIPT ----- -->
<script src="<?= base_url().'assets/js/custom/new.transmittal.js' ?>"></script>
<!-- ----- END VIEW'S JAVASCRIPT ----- -->