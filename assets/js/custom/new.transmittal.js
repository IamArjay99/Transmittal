$(document).ready(function() {

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
                { targets: 12, width: 50  },
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
    }

    const hideModals = () => {
        $('#modal_confirmation_import_files').modal('hide');
        $("#modal_import_files").modal("hide");
        $('#modal_confirmation_clear_transmittal').modal('hide');
        $("#modal_confirmation_delete_transmittal").modal("hide");
        $("#modal_confirmation_move_transmittal").modal("hide");
        $("#modal_edit_transmittal").modal("hide");
        $("#modal_confirmation_save_transmittal").modal("hide");
        clearInputs();
    }

    const isExisting = (array, item) => {
        const found = array.some(el => 
                item.new_transmittalID != el.new_transmittalID &&
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
                item.remarks           === el.remarks
        );
        return found ? "bg-duplicate" : "";
    }
    // ----- END REUSABLE VARIABLE AND FUNCTIONS -----


    // ----- LOAD TABLE -----
    reloadTable();
    function reloadTable() {
        $.ajax({
            method:   "POST",
            url:      "getNewTransmttal",
            data:     true,
            dataType: "json",
            beforeSend: function() {
                $("#table_ncr_transmittal_parent").html(preloader);
                $("#table_nationwide_transmittal_parent").html("");
            },
            success: function(data) {
                let buttons         = "",
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
                            transmittalid = "${item.new_transmittalID}"
                            ismetromanila = "${item.isMetroManila}">
                            <td class="text-center">
                                <input 
                                    type              = "checkbox" 
                                    class             = "form-control cb_transmittal" 
                                    transmittalid     = "${item.new_transmittalID}"
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
                            <td class="text-center">
                                <button 
                                    class             = "btn btn-secondary btn_edit_transmittal"
                                    transmittalid     = "${item.new_transmittalID}"
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


                    buttons += `
                        <div class="row">
                            <div class="offset-md-5 col-md-7 col-sm-12 my-3">
                                <div class="float-right">
                                    <button class="btn btn-primary" id="btn_save_transmittal">
                                        <i class="fas fa-save"></i> Save to All Transmittal
                                    </button>
                                    <button class="btn btn-danger" id="btn_clear_transmittal">
                                        <i class="fas fa-times"></i> Clear Transmittal
                                    </button>
                                </div>
                            </div>
                        </div>`;
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
                    </div>`;
                let endTableNationwide = `
                    <div class="btn-group my-2">
                        <button class="btn btn-danger btn_delete_transmittal" region="0" disabled>
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button class="btn btn-warning btn_move_transmittal" region="0" disabled>
                            <i class="fas fa-exchange-alt"></i>
                        </button>  
                    </div>`;

                ncrTable += endTableNCR;
                nationwideTable += endTableNationwide;

                setTimeout(() => {
                    $("#table_ncr_transmittal_parent").html(ncrTable);
                    $("#table_nationwide_transmittal_parent").html(nationwideTable);
                    $("#buttons_element").html(buttons);
                    reloadDatatable();
                }, 500);
            }
        })
    }
    // ----- END LOAD TABLE -----


    // ----- SAVE TRANSMITTAL -----
    $(document).on("click", "#modal_confirmation_save_transmittal_yes", function() {
        $.ajax({
            method:   "POST",
            url:      "submitTransmittal",
            data:     true,
            beforeSend: function() {
                $("#modal_confirmation_save_transmittal_yes").attr("disabled", true);
                $("#modal_confirmation_save_transmittal_yes").html('<i class="fas fa-check"></i> SAVING....');
            },
            success: function(data) {
                if (data) {
                    hideModals();
                    showSuccessToast("Transmittal saved successfully");
                } else {
                    showErrorToast("There was an error saving transmittal");
                }
            }
        }).done(function() {
            clearInputs();
            reloadTable();
            resetCheckboxData();
            $("#modal_confirmation_save_transmittal_yes").removeAttr("disabled");
            $("#modal_confirmation_save_transmittal_yes").html('<i class="fas fa-check"></i> SAVE');
        })
    })

    $(document).on("click", "#btn_save_transmittal", function() {
        $("#modal_confirmation_save_transmittal").modal("show");
    })
    // ----- END SAVE TRANSMITTAL -----


    // ----- EDIT TRANSMITTAL -----
    $(document).on("click", "#modal_edit_transmittal_update", function() {
        const transmittalid = $(this).attr("transmittalid");
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
        const data = {transmittalid, companyname, receivername, receivertelephone, receiveraddress, receiverprovince, receivercity, receiverregion, parcelname, totalparcel, cod, remarks, type: "new"};
        
        $.ajax({
            method:   "POST",
            url:      "updateTransmittal",
            data,
            beforeSend: function() {
                $("#modal_edit_transmittal_update").attr("disabled", true);
                $("#modal_edit_transmittal_update").html('<i class="fas fa-check"></i> SAVING....');
            },
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
            $("#modal_edit_transmittal_update").removeAttr("disabled");
            $("#modal_edit_transmittal_update").html('<i class="fas fa-check"></i> SAVE');
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
        } else {
            $(".btn_delete_transmittal[region="+type+"]").attr("disabled", true);
            $(".btn_move_transmittal[region="+type+"]").attr("disabled", true);
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


    // ----- DELETE TRANSMITTAL -----
    const deleteTransmittal = data => {
        clearInputs();
        $.ajax({
            method:   "POST",
            url:      "deleteTransmittal",
            data:     {data, type:"new"},
            beforeSend: function() {
                $("#modal_confirmation_delete_transmittal_yes").attr("disabled", true);
                $("#modal_confirmation_delete_transmittal_yes").html('<i class="fas fa-check"></i> SAVING....');
            },
            success: function(data) {
                if (data) {
                    hideModals();
                    showSuccessToast("Transmittal deleted successfully");
                } else {
                    showErrorToast("There was an error deleting transmittal");
                }
            }
        }).done(function() {
            reloadTable();
            resetCheckboxData();
            $("#modal_confirmation_delete_transmittal_yes").removeAttr("disabled");
            $("#modal_confirmation_delete_transmittal_yes").html('<i class="fas fa-check"></i> SAVE');
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
        clearInputs();
        $.ajax({
            method:   "POST",
            url:      "moveTransmittal",
            data:     {data, ismetromanila, type:"new"},
            beforeSend: function() {
                $("#modal_confirmation_move_transmittal_yes").attr("disabled", true);
                $("#modal_confirmation_move_transmittal_yes").html('<i class="fas fa-check"></i> SAVING....');
            },
            success: function(data) {
                if (data) {
                    hideModals();
                    showSuccessToast("Transmittal moved successfully");
                } else {
                    showErrorToast("There was an error moving transmittal");
                }
            }
        }).done(function() {
            reloadTable();
            resetCheckboxData();
            $("#modal_confirmation_move_transmittal_yes").removeAttr("disabled");
            $("#modal_confirmation_move_transmittal_yes").html('<i class="fas fa-check"></i> SAVE');
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
        $("#move_to").html(moveTo);
        $("#modal_confirmation_move_transmittal").modal("show");
    })
    // ----- END MOVE TRANSMITTAL -----


    // ----- CLEAR ALL TRANSMITTAL ------
    $(document).on("click", "#modal_confirmation_clear_transmittal_yes", function() {
        clearInputs();
        $.ajax({
            method:   "POST",
            url:      "clearTransmittal",
            data:     true,
            beforeSend: function() {
                $("#modal_confirmation_clear_transmittal_yes").attr("disabled", true);
                $("#modal_confirmation_clear_transmittal_yes").html('<i class="fas fa-check"></i> SAVING....');
            },
            success: function(data) {
                if (data) {
                    hideModals();
                    showSuccessToast("Transmittal cleared successfully");
                } else {
                    showErrorToast("There was an error clearing transmittal");
                }
            }
        }).done(function() {
            reloadTable();
            resetCheckboxData();
            $("#modal_confirmation_clear_transmittal_yes").removeAttr("disabled");
            $("#modal_confirmation_clear_transmittal_yes").html('<i class="fas fa-check"></i> SAVE');
        })
    })
    $(document).on("click", "#btn_clear_transmittal", function() {
        $("#modal_confirmation_clear_transmittal").modal("show");
    })
    // ----- END CLEAR ALL TRANSMITTAL ------


    // ----- OPENING MODAL -----
    $(document).on("click", "#btn_import_files", function() {
        $("#modal_import_files").modal("show");
    })
    // ----- END OPENING MODAL -----


    // ----- CLOSING MODAL -----
    $(document).on("click", "#modal_import_files_no", function() {
        hideModals();
    })
    // ----- END CLOSING MODAL -----


    // ----- SAVING IMPORT FILE -----
    const saveTransmittal = (transmittalData) => {
        clearInputs();
        $.ajax({
            method:   "POST",
            url:      "saveTransmittal",
            data:     {transmittalData, itemLength:transmittalData.length},
            dataType: "json",
            beforeSend: function() {
                $("#modal_confirmation_import_files_yes").attr("disabled", true);
                $("#modal_confirmation_import_files_yes").html('<i class="fas fa-check"></i> SAVING....');
            },
            success: function(data) {
                if (data) {
                    hideModals();
                    showSuccessToast("Transmittal added successfully");
                } else {
                    showErrorToast("There was an error saving transmittal");
                }
            }
        }).done(function() {
            reloadTable();
            resetCheckboxData();
            $("#modal_confirmation_import_files_yes").attr("disabled", false);
            $("#modal_confirmation_import_files_yes").html('<i class="fas fa-check"></i> YES');
        })
    }

    const validateFile = (data) => {
        let fields = ["Receiver Name", "Receiver Telephone", "Receiver Address", "Receiver Province", "Receiver City", "Receiver Region", "Parcel Name", "Total Parcel", "COD", "Remarks"];
        for (var i=0; i<data.length; i++) {
            for(var j=0; j<fields.length; j++) {
                if (!data[i].hasOwnProperty(fields[j])) {
                    return false;
                }
            }
        }
        return true;
    }

    const isCorrectInputs = async (company, file) => {
        let focusElem   = [];
        let countErrors = 0;
        if (!company) {
            $("#company_name").removeClass("is-valid").addClass("is-invalid");
            $("#invalid-company_name").html("Please company name");
            focusElem.push("company_name") && countErrors++;
        } else {
            $("#company_name").removeClass("is-invalid").addClass("is-valid");
            $("#invalid-company_name").html("");
        }

        if (!file) {
            $("#excel_file").removeClass("is-valid").addClass("is-invalid");
            $("#invalid-excel_file").html("Please input file");
            focusElem.push("excel_file") && countErrors++;
        } else {
            $("#excel_file").removeClass("is-invalid").addClass("is-valid");
            $("#invalid-excel_file").html("");
        }

        $("#"+focusElem[0]).focus();
        return await countErrors > 0 ? false : true;
    }

    $(document).on("click", "#modal_confirmation_import_files_no", function() {
        $("#modal_confirmation_import_files").modal("hide");
        $('#modal_confirmation_import_files').on('hidden.bs.modal', function () {
            const company  = $("#company_name").val().trim();
            const file     = document.getElementById("excel_file").files[0];
            if (company && file) {
                $("#modal_import_files").modal("show");
            }
        });
    })

    $(document).on("click", "#modal_confirmation_import_files_yes", function() {
        const company   = $("#company_name").val().trim();
        const file      = document.getElementById("excel_file").files[0];
        let transmittal = [];

        let fileReader = new FileReader();
        fileReader.readAsBinaryString(file);
        fileReader.onload = function(event) {
            let data = event.target.result;
            let workbook = XLSX.read(data, {type: "binary"});
            let countErrors = 0;

            workbook.SheetNames.forEach(sheet => {
                let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);

                // CHECK IF THE FILE USE THE STANDARD FORMAT
                const checkFile = validateFile(rowObject);
                !checkFile && countErrors++;
            })

            if (countErrors > 0) {
                showErrorToast("Invalid file format");
            } else {
                workbook.SheetNames.forEach(sheet => {
                    let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                    //let jsonObject = JSON.stringify(rowObject);
                    rowObject.map(item => {
                        item["CompanyName"] = company;

                        // RENAME KEY
                        item["ReceiverName"] = item["Receiver Name"];
                        delete item['Receiver Name'];
                        item["ReceiverTelephone"] = item["Receiver Telephone"];
                        delete item['Receiver Telephone'];
                        item["ReceiverAddress"] = item["Receiver Address"];
                        delete item['Receiver Address'];
                        item["ReceiverProvince"] = item["Receiver Province"];
                        delete item['Receiver Province'];
                        item["ReceiverCity"] = item["Receiver City"];
                        delete item['Receiver City'];
                        item["ReceiverRegion"] = item["Receiver Region"];
                        delete item['Receiver Region'];
                        item["ParcelName"] = item["Parcel Name"];
                        delete item['Parcel Name'];
                        item["TotalParcel"] = item["Total Parcel"];
                        delete item['Total Parcel'];

                        const receiverRegion = item["ReceiverRegion"].toLowerCase().trim();
                        if (receiverRegion == "metro manila" || receiverRegion == "ncr" || receiverRegion == "metromanila")  item["isMetroManila"] = 1;
                        else item["isMetroManila"] = 0;
                    })
                    transmittal = [...rowObject];
                });
                clearInputs();
                saveTransmittal(transmittal);
            }

        }
    })

    $(document).on("click", "#modal_import_files_yes", function() {
        const company  = $("#company_name").val().trim();
        const file     = document.getElementById("excel_file").files[0];
        const myInputs = isCorrectInputs(company, file);
        myInputs.then(res => {
            if (res) {
                $("#modal_import_files").modal("hide");
                $('#modal_import_files').on('hidden.bs.modal', function () {
                    const company  = $("#company_name").val().trim();
                    const file     = document.getElementById("excel_file").files[0];
                    if (company && file) {
                        $('#modal_confirmation_import_files').modal('show');
                    }
                })
            }
        });
    })
    // ----- END SAVING IMPORT FILE -----
    

})