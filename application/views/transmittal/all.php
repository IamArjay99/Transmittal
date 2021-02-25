<div class="page-wrapper">
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#">Transmittal</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Transmittal</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-block">
                        <h4 class="page-title card-title text-bold font-weight-bold">All Transmittal</h4><hr>

                        <div id="table_all_transmittal_parent"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {

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
        function reloadDatatable() {
            if ($.fn.DataTable.isDataTable('#table_all_transmittal')){
                $('#table_all_transmittal').DataTable().destroy();
            }
            $("#table_all_transmittal").css({"min-width": "100%"}).removeAttr('width').DataTable({
                scrollX:        true,
                scrollY:        "400px",
                scrollCollapse: true,
                paging:         false,
                ordering:       true,
                searching:      true,
                info:           true,
                columnDefs: [
                    { targets: 0,  width: 50  },
                    { targets: 1,  width: "auto" },
                    { targets: 2,  width: 70 },
                ],
            });  
        }
        
        // ----- END DATATABLES ----- 


        // ----- GET ALL TRANSMITTAL -----
        getAllTransmittal();
        function getAllTransmittal() {
            $.ajax({
                method:   "POST",
                url:      "getAllTransmittal",
                data:     true,
                dataType: "json",
                beforeSend: function() {
                    $("#table_all_transmittal_parent").html(preloader);
                },
                success: function(data) {
                    let html = `
                    <table class="table table-striped table-hover thead-primary" id="table_all_transmittal">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>`;
                        if (data.length > 0) {
                            data.map((item, index) => {
                                html += `
                                <tr class="text-center">
                                    <td>${++index}</td>
                                    <td>${moment(new Date(item.dateCreated)).format("MMMM DD, YYYY")}</td>
                                    <td><a href="view?date=${moment(new Date(item.dateCreated)).format("YYYY-MM-DD")}" class="btn btn-primary">View</a></td>
                                </tr>`;
                            })
                        }
                    html += `</tbody>
                    </table>`;

                    setTimeout(() => {
                        $("#table_all_transmittal_parent").html(html);
                        reloadDatatable();
                    }, 500);
                }
            })
        }
        // ----- END GET ALL TRANSMITTAL -----

    })

</script>