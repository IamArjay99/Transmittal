<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border: 1px solid #30acc0;
    }
</style>

<div class="page-wrapper">
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transmittal</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-block">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="page-title card-title font-weight-bold mb-0">Transmittal Report</h4>
                            <div class="">
                                <button 
                                    id           = "btn_excel"
                                    class        = "btn btn-primary btn_excel"
                                    company_name = "all"
                                    date_from    = "<?= $first_date ?>"
                                    date_to      = "<?= date('M d, Y') ?>">
                                    <i class="fas fa-file-excel"></i> EXCEL
                                </button>
                                <button 
                                    id           = "btn_print"
                                    class        = "btn btn-primary btn_print"
                                    company_name = "all"
                                    date_from    = "<?= $first_date ?>"
                                    date_to      = "<?= date('M d, Y') ?>">
                                    <i class="fas fa-print"></i> PRINT
                                </button>
                            </div>
                        </div>
                        <hr>


                        <!-- ----- FILTERING ----- -->
                        <div class="row filter-row mb-3">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group form-focus mb-0 select-focus">
                                    <label class="focus-label">Company Name <code>*</code></label>
                                    <select class="select2" style="width: 100%" id="company_name">
                                        <option value="all" default selected>All</option>
                                        <?php foreach($companies as $company) { ?>
                                            <option value="<?= $company['companyName'] ?>"><?= $company['companyName'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="invalid-feedback d-block" id="invalid-company_name"></div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group form-focus mb-0">
                                    <label class="focus-label">From <code>*</code></label>
                                    <div class="cal-icon">
                                        <input class="form-control floating datetimepicker" type="text" id="date_from" value="<?= $first_date ?>">
                                    </div>
                                </div>
                                <div class="invalid-feedback d-block" id="invalid-date_from"></div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group form-focus mb-0">
                                    <label class="focus-label">To <code>*</code></label>
                                    <div class="cal-icon">
                                        <input class="form-control floating datetimepicker" type="text" id="date_to" value="<?= date('M d, Y') ?>">
                                    </div>
                                </div>
                                <div class="invalid-feedback d-block" id="invalid-date_to"></div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <button class="btn btn-success btn-block" id="btn_search_filter"><i class="fas fa-search"></i> Search </button>
                            </div>
                        </div>
                        <!-- ----- END FILTERING ----- -->

                        <!-- ----- TABLES ----- -->
                        <div id="table_ncr_transmittal_parent"></div>
                        <div id="table_nationwide_transmittal_parent"></div>
                        <!-- ----- END TABLES ----- -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        
        // ----- SELECT2 -----
        $(".select2").select2();
        // ----- END SELECT2 -----


        // ----- GLOBAL VARIABLES -----
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
                paging:         true,
                ordering:       true,
                searching:      true,
                info:           true,
                columnDefs: [
                    { targets: 0,  width: 20  },
                    { targets: 1,  width: 120 },
                    { targets: 2,  width: 150 },
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
                ],
                fixedColumns: {
                    leftColumns: 1
                }
            }
            var tableNCR = $('#table_ncr_transmittal').css({"min-width": "100%"}).removeAttr('width').DataTable(datatableOptions);
            var tableNationwide = $('#table_nationwide_transmittal').css({"min-width": "100%"}).removeAttr('width').DataTable(datatableOptions);
        }
        // ----- END DATATABLES -----


        // ----- GET TRANSMITTAL DATA -----
        reloadTable();
        function reloadTable() {
            const companyName = $("#company_name").val();
            const dateFrom    = moment($("#date_from").val()).format("YYYY-MM-DD") != "Invalid date" ? moment($("#date_from").val()).format("YYYY-MM-DD") : "";
            const dateTo      = moment($("#date_to").val()).format("YYYY-MM-DD") != "Invalid date" ? moment($("#date_to").val()).format("YYYY-MM-DD") : "";
            const data = {companyName, dateFrom, dateTo};
            $.ajax({
                method:   "POST",
                url:      "getAllTransmittal",
                data,
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
                    <div class="w-100 text-right">
                        <button 
                            id           = "btn_excel"
                            class        = "btn btn-primary btn_excel"
                            company_name = "${companyName}"
                            date_from    = "${$("#date_from").val()}"
                            date_to      = "${$("#date_to").val()}"
                            region       = "1">
                            <i class="fas fa-file-excel"></i> EXCEL
                        </button>
                        <button 
                            id           = "btn_print"
                            class        = "btn btn-primary btn_print"
                            company_name = "${companyName}"
                            date_from    = "${$("#date_from").val()}"
                            date_to      = "${$("#date_to").val()}"
                            region       = "1">
                            <i class="fas fa-print"></i> PRINT
                        </button>
                    </div>
                    <table class="table table-striped table-hover thead-primary" id="table_ncr_transmittal">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>`;
                    nationwideTable += `
                    <div class="bg-primary w-100 text-center py-2 mb-2 font-weight-bold" style="font-size: 1rem; color: black;">Nationwide</div>
                    <div class="w-100 text-right">
                        <button 
                            id           = "btn_excel"
                            class        = "btn btn-primary btn_excel"
                            company_name = "${companyName}"
                            date_from    = "${$("#date_from").val()}"
                            date_to      = "${$("#date_to").val()}"
                            region       = "0">
                            <i class="fas fa-file-excel"></i> EXCEL
                        </button>
                        <button 
                            id           = "btn_print"
                            class        = "btn btn-primary btn_print"
                            company_name = "${companyName}"
                            date_from    = "${$("#date_from").val()}"
                            date_to      = "${$("#date_to").val()}"
                            region       = "0">
                            <i class="fas fa-print"></i> PRINT
                        </button>
                    </div>
                    <table class="table table-striped table-hover thead-primary" id="table_nationwide_transmittal">
                        <thead>
                            <tr class="text-center">
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
                            </tr>
                        </thead>
                        <tbody>`;

                    ncrTable += html;
                    nationwideTable += html;

                    if (data.length > 0) {
                        let countNCR = 0, countNationwide = 0;
                        data.map((item, index, array) => {
                            let temp = `
                            <tr class         = ""
                                transmittalid = "${item.transmittalID}"
                                ismetromanila = "${item.isMetroManila}">
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

                    setTimeout(() => {
                        $("#table_ncr_transmittal_parent").html(ncrTable);
                        $("#table_nationwide_transmittal_parent").html(nationwideTable);
                        reloadDatatable();
                    }, 500);
                }
            })
        }
        // ----- END GET TRANSMITTAL DATA -----


        // ---- SEARCH FILTER -----
        const checkInputs = (companyName, dateFrom, dateTo) => {
            let countErrors = 0, toastError = [];

            if (companyName) {
                $("#company_name").next().children().children().removeClass("has-error").addClass("no-error");
                $("#invalid-company_name").html("");
            } else {
                $("#company_name").next().children().children().removeClass("no-error").addClass("has-error");
                $("#invalid-company_name").html("Please select company name");
                toastError.push("Please fill in required fields");
                countErrors++;
            }
            
            if (dateFrom) {
                $("#date_from").removeClass("is-invalid").addClass("is-valid");
                $("#invalid-date_from").html("");
            } else {
                $("#date_from").removeClass("is-valid").addClass("is-invalid");
                $("#invalid-date_from").html("Please select date from");
                toastError.push("Please fill in required fields");
                countErrors++;
            }

            if (dateTo) {
                $("#date_to").removeClass("is-invalid").addClass("is-valid");
                $("#invalid-date_to").html("");
            } else {
                $("#date_to").removeClass("is-valid").addClass("is-invalid");
                $("#invalid-date_to").html("Please select date to");
                toastError.push("Please fill in required fields");
                countErrors++;
            }

            if (dateFrom && dateTo) {
                if (new Date(dateFrom) > new Date(dateTo)) {
                    $("#date_from").removeClass("is-valid").addClass("is-invalid");
                    $("#date_to").removeClass("is-valid").addClass("is-invalid");
                    toastError.push("Please select valid date range");
                    countErrors++;
                } else {
                    $("#date_from").removeClass("is-invalid").addClass("is-valid");
                    $("#date_to").removeClass("is-invalid").addClass("is-valid");
                }
            }

            if (countErrors > 0) {
                showErrorToast(toastError[0]);
                return false;
            } else {
                return true;
            }
        }

        $(document).on("click", "#btn_search_filter", function() {
            const companyName = $("#company_name").val();
            const dateFrom    = $("#date_from").val();
            const dateTo      = $("#date_to").val();
            const validate    = checkInputs(companyName, dateFrom, dateTo);
            if (validate) {

                // ----- UPDATE EXCEL, PRINT BUTTON ATTRIBUTES -----
                $(".btn_excel").attr("company_name", companyName);
                $(".btn_excel").attr("date_from",    dateFrom);
                $(".btn_excel").attr("date_to",      dateTo);

                $(".btn_print").attr("company_name", companyName);
                $(".btn_print").attr("date_from",    dateFrom);
                $(".btn_print").attr("date_to",      dateTo);
                // ----- END UPDATE EXCEL, PRINT BUTTON ATTRIBUTES -----

                reloadTable();
            }
        })
        // ---- END SEARCH FILTER -----


        // ----- PRINT, EXCEL -----
        $(document).on("click", ".btn_excel", function() {
            const companyName = $(this).attr("company_name");
            const dateFrom    = moment($(this).attr("date_from")).format("YYYY-MM-DD");
            const dateTo      = moment($(this).attr("date_to")).format("YYYY-MM-DD");
            const region      = $(this).attr("region") ? $(this).attr("region") : "";

            window.open("downloadExcelTransmittal?companyName="+companyName+"&dateFrom="+dateFrom+"&dateTo="+dateTo+"&region="+region, "_blank"); 
        })

        $(document).on("click", ".btn_print", function() {
            const companyName = $(this).attr("company_name");
            const dateFrom    = moment($(this).attr("date_from")).format("YYYY-MM-DD");
            const dateTo      = moment($(this).attr("date_to")).format("YYYY-MM-DD");
            const region      = $(this).attr("region") ? $(this).attr("region") : "";
            const data = {companyName, dateFrom, dateTo, region};

            $.ajax({
                method: "GET",
                url: "printTransmittal",
                data,
                success: function(data) {
                    var left  = ($(window).width()/2)-(900/2),
                        top   = ($(window).height()/2)-(600/2),
                        mywindow = window.open ("", "PRINT", "width=900, height=600, top="+top+", left="+left);

                    mywindow.document.write(data);
                    mywindow.document.close(); 
                    mywindow.focus();
                }
            })
        })
        // ----- END PRINT, EXCEL -----

    })

</script>