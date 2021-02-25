<div class="page-wrapper">
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#">Transmittal</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('transmittal/all') ?>">All Transmittal</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Transmittal</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-block">
                        <h4 class="page-title card-title font-weight-bold">View Transmittal</h4><hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-group form-focus mb-0 select-focus" style="width: 160px;">
                                <label class="focus-label">Company Name</label>
                                <select class="select2" style="width: 100%" id="filter_company_name">
                                    <option value="all" default selected>All</option>
                                    <?php foreach($companies as $company) { ?>
                                        <option value="<?= $company['companyName'] ?>"><?= $company['companyName'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <h4 class="date" id="date" date="<?= $date ?>" company_name="all"><?= date("F d, Y", strtotime($date)) ?></h4>
                        </div>

                        <div class="my-3" id="table_ncr_transmittal_parent"></div>
                        <div class="my-3" id="table_nationwide_transmittal_parent"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
            <h4><h4>Do you want to move these transmittal to <span id="move_to"></span>?</h4></h4>
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
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Inspected</label>
                        <input type="text" class="form-control" id="edit_inspected">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Rider</label>
                        <input type="text" class="form-control" id="edit_rider">
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


<!-- ----- EDIT RIDER TRANSMITTAL MODAL ----- -->
<div class="modal fade" id="modal_edit_rider_transmittal" tabindex="-1" role="dialog" aria-labelledby="modal_edit_rider_transmittal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title text-light my-0" id="my-modal-title">UPDATE RIDER</h4>
            <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body pb-2">
            <div class="form-group">
                <label for="">Rider</label>
                <input type="text" class="form-control" id="edit_rider2">
            </div>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_edit_rider_transmittal_update"><i class="fas fa-paper"></i> UPDATE</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END EDIT RIDER TRANSMITTAL MODAL ----- -->


<!-- ----- EDIT INSPECTED TRANSMITTAL MODAL ----- -->
<div class="modal fade" id="modal_edit_inspected_transmittal" tabindex="-1" role="dialog" aria-labelledby="modal_edit_inspected_transmittal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-min" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title text-light my-0" id="my-modal-title">UPDATE INSPECTED</h4>
            <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body pb-2">
            <div class="form-group">
                <label for="">Inspected</label>
                <input type="text" class="form-control" id="edit_inspected2">
            </div>
        </div>
        <div class="modal-footer">
            <div class="text-center w-100">
                <button type="button" class="btn btn-primary shadow-none" id="modal_edit_inspected_transmittal_update"><i class="fas fa-paper"></i> UPDATE</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- ----- END EDIT INSPECTED TRANSMITTAL MODAL ----- -->


<script>

    $(document).ready(function() {

        // ----- SELECT2 -----
        $(".select2").select2();
        // ----- END SELECT2 -----


        // ----- GLOBAL VARIABLES -----
        let ncrCheckboxData = [], nationwideCheckboxData = [];
        const preloader = `
                <div class="spinner spinner-3 my-4">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>`;
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        reloadDatatable();
        function reloadDatatable() {
            if ($.fn.DataTable.isDataTable('#table_ncr_transmittal')){
                $('#table_ncr_transmittal').DataTable().destroy();
            }

            if ($.fn.DataTable.isDataTable('#table_nationwide_transmittal')){
                $('#table_nationwide_transmittal').DataTable().destroy();
            }
            var datatableOptions = {
                stateSave:      true,
                scrollX:        true,
                scrollY:        "400px",
                scrollCollapse: true,
                paging:         false,
                ordering:       true,
                searching:      true,
                info:           true,
                columnDefs: [
                    { targets: 0,  width: 20, orderable: false  },
                    { targets: 1,  width: 20, },
                    { targets: 2,  width: 120 },
                    { targets: 3,  width: 150 },
                    { targets: 4,  width: 120 },
                    { targets: 5,  width: 120 },
                    { targets: 6,  width: 150 },
                    { targets: 7,  width: 120 },
                    { targets: 8,  width: 120 },
                    { targets: 9,  width: 120 },
                    { targets: 10, width: 120 },
                    { targets: 11, width: 100 },
                    { targets: 12, width: 120 },
                    { targets: 13, width: 100 },
                    { targets: 14, width: 50  },
                ],
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            }
            var tableNCR = $('#table_ncr_transmittal').css({"min-width": "100%"}).removeAttr('width').DataTable(datatableOptions);
            var tableNationwide = $('#table_nationwide_transmittal').css({"min-width": "100%"}).removeAttr('width').DataTable(datatableOptions);
        }
        // ----- END DATATABLES -----

        
        // ----- REUSABLE VARIABLE AND FUNCTIONS ----- 
        const resetCheckboxData = () => {
            ncrCheckboxData        = [];
            nationwideCheckboxData = [];
        }

        const clearInputs = () => {
            $("#company_name").val("");
            $("#excel_file").val("");
            $("#company_name").removeClass("is-valid").removeClass("is-invalid");
            $("#excel_file").removeClass("is-valid").removeClass("is-invalid");
            $("#edit_rider2").val("");
            $("#edit_inspected2").val("");
        }

        const hideModals = () => {
            $('#modal_confirmation_import_files').modal('hide');
            $("#modal_import_files").modal("hide");
            $('#modal_confirmation_clear_transmittal').modal('hide');
            $("#modal_confirmation_delete_transmittal").modal("hide");
            $("#modal_confirmation_move_transmittal").modal("hide");
            $("#modal_edit_transmittal").modal("hide");
            $("#modal_confirmation_save_transmittal").modal("hide");
            $("#modal_edit_rider_transmittal").modal("hide");
            $("#modal_edit_inspected_transmittal").modal("hide");
            clearInputs();
        }

        const isExisting = (array, item) => {
            const found = array.some(el => 
                    item.transmittalID     !=  el.transmittalID &&
                    item.companyName       === el.companyName &&
                    item.receiverName      === el.receiverName  &&
                    item.receiverTelephone === el.receiverTelephone && 
                    item.receiverAddress   === el.receiverAddress && 
                    item.receiverProvince  === el.receiverProvince && 
                    item.receiverCity      === el.receiverCity && 
                    item.receiverRegion    === el.receiverRegion && 
                    item.isMetroManila     === el.isMetroManila && 
                    item.parcelName        === el.parcelName && 
                    item.totalParcel       === el.totalParcel && 
                    item.COD               === el.COD && 
                    item.remarks           === el.remarks &&
                    item.inspected         === el.inspected &&
                    item.rider             === el.rider
            );
            return found ? "bg-duplicate" : "";
        }
        // ----- END REUSABLE VARIABLE AND FUNCTIONS -----


        // ----- GET TRANSMITTAL DATA -----
        reloadTable();
        function reloadTable() {
            const date        = $("#date").attr("date");
            const companyName = $("#date").attr("company_name");
            $.ajax({
                method:   "POST",
                url:      "getTransmittalByDate",
                data:     {date, companyName},
                dataType: "json",
                beforeSend: function() {
                    $("#table_ncr_transmittal_parent").html(preloader);
                    $("#table_nationwide_transmittal_parent").html("");
                },
                success: function(data) {
                    let buttons     = "",
                    ncrRows         = "",
                    nationwideRows  = "",
                    ncrTable        = "",
                    nationwideTable = "";

                    ncrTable += `
                    <div class="bg-primary w-100 text-center py-2 mb-2 font-weight-bold" style="font-size: 1rem; color: black;">Metro Manila</div>
                    <table class="table table-striped table-hover thead-primary" id="table_ncr_transmittal">
                        <thead>
                            <tr class="text-center">
                                <th>
                                <input 
                                    type          = "checkbox" 
                                    class         = "form-control cb_all_transmittal"
                                    ismetromanila = "1">
                                </th>
                                <th>#</th>`;
                    nationwideTable += `
                    <div class="bg-primary w-100 text-center py-2 mb-2 font-weight-bold" style="font-size: 1rem; color: black;">Nationwide</div>
                    <table class="table table-striped table-hover thead-primary" id="table_nationwide_transmittal">
                        <thead>
                            <tr class="text-center">
                                <th>
                                <input 
                                    type          = "checkbox" 
                                    class         = "form-control cb_all_transmittal"
                                    ismetromanila = "0">
                                </th>
                                <th>#</th>`;

                    let html = `<th>Receiver Name</th>
                                <th>Receiver Telephone</th>
                                <th>Receiver Address</th>
                                <th>Receiver Province</th>
                                <th>Receiver City</th>
                                <th>Receiver Region</th>
                                <th>Parcel Name</th>
                                <th>Total Parcel</th>
                                <th>COD</th>
                                <th>Remarks</th>
                                <th>Inspected</th>
                                <th>Rider</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>`;

                    ncrTable += html;
                    nationwideTable += html;

                    if (data.length > 0) {
                        let countNCR = 0, countNationwide = 0;
                        data.map((item, index, array) => {
                            let classForExisting = isExisting(array, item);
                            let temp = `
                            <tr class         = "${classForExisting}"
                                transmittalid = "${item.transmittalID}"
                                ismetromanila = "${item.isMetroManila}">
                                <td class="text-center">
                                    <input 
                                        type              = "checkbox" 
                                        class             = "form-control cb_transmittal" 
                                        transmittalid     = "${item.transmittalID}"
                                        ismetromanila     = "${item.isMetroManila}">
                                </td>
                                <td class="text-center">${item.isMetroManila == "1" ? ++countNCR : ++countNationwide}</td>
                                <td class="text-center">
                                    <div>(${item.companyName}) ${item.receiverName}</div>
                                </td>
                                <td class="text-center">${item.receiverTelephone}</td>
                                <td class="text-left">${item.receiverAddress}</td>
                                <td class="text-center">${item.receiverProvince}</td>
                                <td class="text-center">${item.receiverCity}</td>
                                <td class="text-center">${item.receiverRegion}</td>
                                <td class="text-left">${item.parcelName}</td>
                                <td class="text-center">${item.totalParcel}</td>
                                <td class="text-center">${item.COD}</td>
                                <td class="text-center">${item.remarks}</td>
                                <td class="text-center">${item.inspected ? item.inspected : "-"}</td>
                                <td class="text-center">${item.rider ? item.rider : "-"}</td>
                                <td class="text-center">
                                    <button 
                                        class             = "btn btn-secondary btn_edit_transmittal"
                                        transmittalid     = "${item.transmittalID}"
                                        companyname       = "${item.companyName}"
                                        receivername      = "${item.receiverName}"
                                        receivertelephone = "${item.receiverTelephone}"
                                        receiveraddress   = "${item.receiverAddress}"
                                        receiverprovince  = "${item.receiverProvince}"
                                        receivercity      = "${item.receiverCity}"
                                        receiverregion    = "${item.receiverRegion}"
                                        parcelname        = "${item.parcelName}"
                                        totalparcel       = "${item.totalParcel}"
                                        cod               = "${item.COD}"
                                        remarks           = "${item.remarks}"
                                        inspected         = "${item.inspected ? item.inspected : ""}"
                                        rider             = "${item.rider ? item.rider : ""}"
                                        ismetromanila     = "${item.isMetroManila}">
                                        <i class="fas fa-pencil-alt"></i>   
                                    </button>
                                </td>
                            </tr>`;
                            if (item.isMetroManila == "1") {
                                ncrRows += temp;
                            } else {
                                nationwideRows += temp;
                            }
                        })

                        ncrTable += ncrRows;
                        nationwideTable += nationwideRows;
                    }

                    ncrTable += `</table>`;
                    nationwideTable += `</table>`;

                    let endTableNCR = `
                        <div class="btn-group my-2">
                            <button class="btn btn-danger btn_delete_transmittal" region="1" disabled>
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="btn btn-warning btn_move_transmittal" region="1" disabled>
                                <i class="fas fa-exchange-alt"></i>
                            </button>  
                            <button class="btn btn-info btn_assign_inspected_transmittal" region="1" disabled>Inspected</button>
                            <button class="btn btn-success btn_assign_rider_transmittal" region="1" disabled>Rider</button>
                        </div>`;
                    let endTableNationwide = `
                        <div class="btn-group my-2">
                            <button class="btn btn-danger btn_delete_transmittal" region="0" disabled>
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="btn btn-warning btn_move_transmittal" region="0" disabled>
                                <i class="fas fa-exchange-alt"></i>
                            </button>  
                            <button class="btn btn-info btn_assign_inspected_transmittal" region="0" disabled>Inspected</button>
                            <button class="btn btn-success btn_assign_rider_transmittal" region="0" disabled>Rider</button>
                        </div>`;

                    ncrTable += endTableNCR;
                    nationwideTable += endTableNationwide;

                    setTimeout(() => {
                        $("#table_ncr_transmittal_parent").html(ncrTable);
                        $("#table_nationwide_transmittal_parent").html(nationwideTable);
                        reloadDatatable();
                    }, 500);
                }
            })
        }
        // ----- END GET TRANSMITTAL DATA -----


        // ----- COMPANY NAME -----
        $(document).on("change", "#filter_company_name", function() {
            $("#date").attr("company_name", $(this).val());
            reloadTable();
        })
        // ----- END COMPANY NAME -----


        // ----- EDIT TRANSMITTAL -----
        $(document).on("click", "#modal_edit_transmittal_update", function() {
            const transmittalid     = $(this).attr("transmittalid");
            const companyname       = $("#edit_company_name").val();
            const receivername      = $("#edit_receiver_name").val();
            const receivertelephone = $("#edit_receiver_telephone").val();
            const receiveraddress   = $("#edit_receiver_address").val();
            const receiverprovince  = $("#edit_receiver_province").val();
            const receivercity      = $("#edit_receiver_city").val();
            const receiverregion    = $("#edit_receiver_region").val();
            const parcelname        = $("#edit_parcel_name").val();
            const totalparcel       = $("#edit_total_parcel").val();
            const cod               = $("#edit_cod").val();
            const remarks           = $("#edit_remarks").val();
            const inspected         = $("#edit_inspected").val();
            const rider             = $("#edit_rider").val();
            const data = {transmittalid, companyname, receivername, receivertelephone, receiveraddress, receiverprovince, receivercity, receiverregion, parcelname, totalparcel, cod, remarks, inspected, rider, type:"all"};
            
            $.ajax({
                method:   "POST",
                url:      "updateTransmittal",
                data,
                success: function(data) {
                    if (data) {
                        hideModals();
                        showSuccessToast("Transmittal updated successfully");
                    } else {
                        showErrorToast("There was an error updating transmittal");
                    }
                }
            }).done(function() {
                clearInputs();
                reloadTable();
                resetCheckboxData();
            })
        })

        $(document).on("click", ".btn_edit_transmittal", function() {
            const transmittalid     = $(this).attr("transmittalid");
            const companyname       = $(this).attr("companyname");
            const receivername      = $(this).attr("receivername");
            const receivertelephone = $(this).attr("receivertelephone");
            const receiveraddress   = $(this).attr("receiveraddress");
            const receiverprovince  = $(this).attr("receiverprovince");
            const receivercity      = $(this).attr("receivercity");
            const receiverregion    = $(this).attr("receiverregion");
            const parcelname        = $(this).attr("parcelname");
            const totalparcel       = $(this).attr("totalparcel");
            const cod               = $(this).attr("cod");
            const remarks           = $(this).attr("remarks");
            const inspected         = $(this).attr("inspected");
            const rider             = $(this).attr("rider");
            const ismetromanila     = $(this).attr("ismetromanila");

            $("#edit_company_name").val(companyname);
            $("#edit_receiver_name").val(receivername);
            $("#edit_receiver_telephone").val(receivertelephone);
            $("#edit_receiver_address").val(receiveraddress);
            $("#edit_receiver_province").val(receiverprovince);
            $("#edit_receiver_city").val(receivercity);
            $("#edit_receiver_region").val(receiverregion);
            $("#edit_parcel_name").val(parcelname);
            $("#edit_total_parcel").val(totalparcel);
            $("#edit_cod").val(cod);
            $("#edit_remarks").val(remarks);
            $("#edit_inspected").val(inspected);
            $("#edit_rider").val(rider);

            $("#modal_edit_transmittal_update").attr("transmittalid", transmittalid);
            $("#modal_edit_transmittal").modal("show");
        })
        // ----- END EDIT TRANSMITTAL -----


        // ----- ACTIVATE BUTTONS -----
        const activateButtons = (type) => {
            const countData = type == "1" ? ncrCheckboxData.length : nationwideCheckboxData.length;
            if (countData > 0) {
                $(".btn_delete_transmittal[region="+type+"]").removeAttr("disabled");
                $(".btn_move_transmittal[region="+type+"]").removeAttr("disabled");
                $(".btn_assign_rider_transmittal[region="+type+"]").removeAttr("disabled");
                $(".btn_assign_inspected_transmittal[region="+type+"]").removeAttr("disabled");
            } else {
                $(".btn_delete_transmittal[region="+type+"]").attr("disabled", true);
                $(".btn_move_transmittal[region="+type+"]").attr("disabled", true);
                $(".btn_assign_rider_transmittal[region="+type+"]").attr("disabled", true);
                $(".btn_assign_inspected_transmittal[region="+type+"]").attr("disabled", true);
            }
        }
        // ----- END ACTIVATE BUTTONS -----


        // ----- CHECKBOX -----
        const highlightRow = () => {
            $("tr").removeClass("bg-selected");
            $(".cb_transmittal").prop("checked", false);

            ncrCheckboxData.map(transmittalid => {
                $("tr[transmittalid="+transmittalid+"]").removeClass("bg-selected").addClass("bg-selected");
                $(".cb_transmittal[transmittalid="+transmittalid+"]").prop("checked", true);
            });
            nationwideCheckboxData.map(transmittalid => {
                $("tr[transmittalid="+transmittalid+"]").removeClass("bg-selected").addClass("bg-selected");
                $(".cb_transmittal[transmittalid="+transmittalid+"]").prop("checked", true);
            });
        }

        const updateCheckboxData = (isCheck, type, transmittalid) => {
            const newData = (type, transmittalid) => {
                let arr    = type == "1" ? [...ncrCheckboxData] : [...nationwideCheckboxData];
                let newArr = arr.filter((item, index) => {
                    return item != transmittalid;
                });
                if (type == "1") {
                    ncrCheckboxData = newArr;
                } else {
                    nationwideCheckboxData = newArr;
                }
            }
            const isExists = (arr, transmittalid) => {
                return arr.includes(transmittalid) ? true : false;
            }
            const validateData = (transmittalid) => {
                if (type == "1") {
                    !isExists(ncrCheckboxData, transmittalid) && ncrCheckboxData.push(transmittalid);
                } else {
                    !isExists(nationwideCheckboxData, transmittalid) && nationwideCheckboxData.push(transmittalid);
                }
            }
            if (isCheck == "1") {
                validateData(transmittalid);
            } else {
                newData(type, transmittalid);
            }
        }

        const getCheckedData = (type) => {
            return type == "1" ? ncrCheckboxData : nationwideCheckboxData;
        }

        const changeCheckbox = (attr, type) => {
        $(".cb_transmittal[ismetromanila="+type+"]").each(function() {
            this.checked = attr;
            const transmittalid = $(this).attr("transmittalid"); 
            this.checked ? $(this).addClass("hasChecked") : $(this).removeClass("hasChecked");
            const isCheck = this.checked ? "1" : "0";
            updateCheckboxData(isCheck, type, transmittalid);
            highlightRow();
            activateButtons(type);
        });
        }

        $(document).on("click", ".sorting, .sorting_asc, .sorting_desc", function() {
            highlightRow();
        })

        $(document).on("keyup", "[aria-controls=table_ncr_transmittal], [aria-controls=table_nationwide_transmittal]", function() {
            highlightRow();
        })

        $(document).on("click", ".cb_all_transmittal", function() {
            const type = $(this).attr("ismetromanila"); 
            const attr = this.checked ? true : false;
            changeCheckbox(attr, type);
        })

        $(document).on("click", ".cb_transmittal", function() {
            const type          = $(this).attr("ismetromanila"); 
            const transmittalid = $(this).attr("transmittalid"); 
            this.checked ? $(this).addClass("hasChecked") : $(this).removeClass("hasChecked");
            const isCheck = this.checked ? "1" : "0";
            updateCheckboxData(isCheck, type, transmittalid);
            highlightRow();
            activateButtons(type);
        })
        // ----- END CHECKBOX -----


        // ----- ASSIGN RIDER / INSPECTED -----
        const assignTransmittal = (data, assign, field) => {
            $.ajax({
                method:   "POST",
                url:      "assignTransmittal",
                data:     {data, assign, field, type:"all"},
                success: function(data) {
                    if (data) {
                        hideModals();
                        showSuccessToast("Transmittal assigned successfully");
                    } else {
                        showErrorToast("There was an error assigning transmittal");
                    }
                }
            }).done(function() {
                clearInputs();
                reloadTable();
                resetCheckboxData();
            })
        }

        $(document).on("click", "#modal_edit_rider_transmittal_update", function() {
            const type  = $(this).attr("region");
            const data  = getCheckedData(type);
            const rider = $("#edit_rider2").val().trim();
            if (rider) {
                assignTransmittal(data, rider, "rider");
            }
        });

        $(document).on("click", ".btn_assign_rider_transmittal", function() {
            const region = $(this).attr("region");
            $("#modal_edit_rider_transmittal_update").attr("region", region);
            $("#modal_edit_rider_transmittal").modal("show");
        });

        $(document).on("click", "#modal_edit_inspected_transmittal_update", function() {
            const type      = $(this).attr("region");
            const data      = getCheckedData(type);
            const inspected = $("#edit_inspected2").val().trim();
            if (inspected) {
                assignTransmittal(data, inspected, "inspected");
            }
        });

        $(document).on("click", ".btn_assign_inspected_transmittal", function() {
            const region = $(this).attr("region");
            $("#modal_edit_inspected_transmittal_update").attr("region", region);
            $("#modal_edit_inspected_transmittal").modal("show");
        });
        // ----- END ASSIGN RIDER / INSPECTED -----
        

        // ----- DELETE TRANSMITTAL -----
        const deleteTransmittal = data => {
            $.ajax({
                method:   "POST",
                url:      "deleteTransmittal",
                data:     {data, type:"all"},
                success: function(data) {
                    if (data) {
                        hideModals();
                        showSuccessToast("Transmittal deleted successfully");
                    } else {
                        showErrorToast("There was an error deleting transmittal");
                    }
                }
            }).done(function() {
                clearInputs();
                reloadTable();
                resetCheckboxData();
            })
        }

        $(document).on("click", "#modal_confirmation_delete_transmittal_yes", function() {
            const type = $(this).attr("region");
            const data = getCheckedData(type);
            deleteTransmittal(data);
        })

        $(document).on("click", ".btn_delete_transmittal", function() {
            const type = $(this).attr("region");
            $("#modal_confirmation_delete_transmittal_yes").attr("region", type);
            $("#modal_confirmation_delete_transmittal").modal("show");
        })
        // ----- END DELETE TRANSMITTAL -----


        // ----- MOVE TRANSMITTAL -----
        const moveTransmittal = (data, type) => {
            const ismetromanila = type == '1' ? '0' : '1';
            $.ajax({
                method:   "POST",
                url:      "moveTransmittal",
                data:     {data, ismetromanila, type:"all"},
                success: function(data) {
                    if (data) {
                        hideModals();
                        showSuccessToast("Transmittal moved successfully");
                    } else {
                        showErrorToast("There was an error moving transmittal");
                    }
                }
            }).done(function() {
                clearInputs();
                reloadTable();
                resetCheckboxData();
            })
        }

        $(document).on("click", "#modal_confirmation_move_transmittal_yes", function() {
            const type = $(this).attr("region");
            const data = getCheckedData(type);
            moveTransmittal(data, type);
        })

        $(document).on("click", ".btn_move_transmittal", function() {
            const type = $(this).attr("region");
            const moveTo = type == 0 ? "Metro Manila" : "Nationwide";
            $("#modal_confirmation_move_transmittal_yes").attr("region", type);
            $("#modal_confirmation_move_transmittal").modal("show");
            $("#move_to").html(moveTo);
        })
        // ----- END MOVE TRANSMITTAL -----
    })

</script>