<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/bootstrap.min.css' ?>">
    <style>
        td, th {
            vertical-align: middle !important;
        }
        /* @media print{@page {size: landscape}} */
        th {
            font-size: .8rem !important;
            padding: .2rem .5rem !important;
        }
        td {
            font-size: .7rem !important;
            padding: .2rem !important;
        }
    </style>
</head>
<body onload="window.print()">

    <!---------------- HEADER ----------------->
    <div class="d-flex justify-content-center align-items-center flex-column mb-2">
        <h4>TRANSMITTAL REPORT</h4>
        <div class="d-flex justify-content-center align-items-center">
            <div class="d-block mx-1">
                DATE:
                <span><?= $dateRange ?></span>
            </div>
        </div>
    </div> 
    <!---------------- END HEADER ----------------->


    <!---------------- TABLE ----------------->
    <table class="table table-bordered text-center">
        <thead>
            <?php 
                if ($region != "") { 
                $regionText = $region == "0" ? "NATIONWIDE" : "METRO MANILA";
            ?>
                <tr>
                    <th colspan="12"><?= $regionText ?></th>
                </tr>
            <?php } ?>
            <tr>
                <th>RECEIVER</th>
                <th>RECEIVER TELELPHONE</th>
                <th>RECEIVER ADDRESS</th>
                <th>RECEIVER PROVINCE</th>
                <th>RECEIVER CITY</th>
                <th>RECEIVER REGION</th>
                <th>PARCEL NAME</th>
                <th>TOTAL PARCEL</th>
                <th>COD</th>
                <th>REMARKS</th>
                <th>INSPECTED</th>
                <th>RIDER</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($transmittals as $transmittal) { 
                    if ($region != "") {
                        if ($transmittal["isMetroManila"] == $region) { ?>
                            <tr>
                                <td><?= "(".$transmittal["companyName"].") ".$transmittal["receiverName"] ?></td>
                                <td><?= $transmittal["receiverTelephone"] ?></td>
                                <td><?= $transmittal["receiverAddress"] ?></td>
                                <td><?= $transmittal["receiverProvince"] ?></td>
                                <td><?= $transmittal["receiverCity"] ?></td>
                                <td><?= $transmittal["receiverRegion"] ?></td>
                                <td><?= $transmittal["parcelName"] ?></td>
                                <td><?= $transmittal["totalParcel"] ?></td>
                                <td><?= $transmittal["COD"] ?></td>
                                <td><?= $transmittal["remarks"] ?></td>
                                <td><?= $transmittal["inspected"] ?></td>
                                <td><?= $transmittal["rider"] ?></td>
                            </tr>
            <?php
                        }
                    } else {
            ?>
                <tr>
                    <td><?= "(".$transmittal["companyName"].") ".$transmittal["receiverName"] ?></td>
                    <td><?= $transmittal["receiverTelephone"] ?></td>
                    <td><?= $transmittal["receiverAddress"] ?></td>
                    <td><?= $transmittal["receiverProvince"] ?></td>
                    <td><?= $transmittal["receiverCity"] ?></td>
                    <td><?= $transmittal["receiverRegion"] ?></td>
                    <td><?= $transmittal["parcelName"] ?></td>
                    <td><?= $transmittal["totalParcel"] ?></td>
                    <td><?= $transmittal["COD"] ?></td>
                    <td><?= $transmittal["remarks"] ?></td>
                    <td><?= $transmittal["inspected"] ?></td>
                    <td><?= $transmittal["rider"] ?></td>
                </tr>
            <?php
                    }
                } 
            ?>
        </tbody>
    </table>
    <!---------------- END TABLE ----------------->

</body>
</html>