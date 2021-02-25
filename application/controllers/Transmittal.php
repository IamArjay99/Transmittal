<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transmittal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Transmittal_model", "transmittal");
        $this->load->model("TransmittalReport_model", "transmittal_report");
    }

    public function getNewTransmttal()
    {
        echo json_encode($this->transmittal->getNewTransmittal());
    }

	public function new()
	{
        $data["title"] = "New Transmittal";

		$this->load->view('template/header', $data);
		$this->load->view('transmittal/new', $data);
		$this->load->view('template/footer');
    }

    public function all()
	{
        $data["title"]        = "All Transmittal";
        $data["transmittals"] = $this->transmittal->getAllTransmittal();

		$this->load->view('template/header', $data);
		$this->load->view('transmittal/all', $data);
		$this->load->view('template/footer');
    }

    public function view()
    {
        $date     = $this->input->get("date") ? $this->input->get("date") : redirect(base_url("transmittal/all"));
        $dateFrom = $date." 00:00:00";
        $dateTo   = $date." 23:59:59";
        $dateArr     = explode("-", $date);
        $isValidDate = checkdate($dateArr[1], $dateArr[2], $dateArr[0]);
        $data["title"]        = "View Transmittal";
        $data["date"]         = $isValidDate ? $date : redirect(base_url("transmittal/all"));
        $data["transmittals"] = $this->transmittal->getTransmittalByDate($dateFrom, $dateTo, "all");
        $data["companies"]    = $this->transmittal_report->getCompanies();

        $this->load->view('template/header', $data);
		$this->load->view('transmittal/view', $data);
		$this->load->view('template/footer');
    }

    public function getAllTransmittal()
    {
        echo json_encode($this->transmittal->getAllTransmittal());
    }

    public function getTransmittalByDate()
    {
        $date     = $this->input->post("date") ? $this->input->post("date") : redirect(base_url("transmittal/all"));
        $dateFrom = $date." 00:00:00";
        $dateTo   = $date." 23:59:59";
        $companyName = $this->input->post("companyName");
        echo json_encode($this->transmittal->getTransmittalByDate($dateFrom, $dateTo, $companyName));
    }

    public function saveTransmittal()
    {
        $transmittalData = $this->input->post("transmittalData");
		$itemLength      = $this->input->post("itemLength");
		$data = [];
		for($i=0; $i<$itemLength; $i++) {
            $companyName       = $transmittalData[$i]["CompanyName"];
            $receiverName      = $transmittalData[$i]["ReceiverName"];
            $receiverTelephone = $transmittalData[$i]["ReceiverTelephone"];
            $receiverAddress   = $transmittalData[$i]["ReceiverAddress"];
            $receiverProvince  = $transmittalData[$i]["ReceiverProvince"];
            $receiverCity      = $transmittalData[$i]["ReceiverCity"];
            $receiverRegion    = $transmittalData[$i]["ReceiverRegion"];
            $isMetroManila     = $transmittalData[$i]["isMetroManila"];
            $parcelName        = $transmittalData[$i]["ParcelName"];
            $totalParcel       = $transmittalData[$i]["TotalParcel"];
            $COD               = $transmittalData[$i]["COD"];
            $remarks           = $transmittalData[$i]["Remarks"];

            $temp = [
                "companyName"       => $companyName,
                "receiverName"      => $receiverName,
                "receiverTelephone" => $receiverTelephone,
                "receiverAddress"   => $receiverAddress,
                "receiverProvince"  => $receiverProvince,
                "receiverCity"      => $receiverCity,
                "receiverRegion"    => $receiverRegion,
                "isMetroManila"     => $isMetroManila,
                "parcelName"        => $parcelName,
                "totalParcel"       => $totalParcel,
                "COD"               => $COD,
                "remarks"           => $remarks
            ];
			array_push($data, $temp);
		}
		echo $this->transmittal->saveTransmittal($data);
    }

    public function clearTransmittal()
    {
        echo $this->transmittal->clearTransmittal();
    }

    public function deleteTransmittal()
    {
        $data = $this->input->post("data");
        $type = $this->input->post("type");
        echo $this->transmittal->deleteTransmittal($data, $type);
    }

    public function moveTransmittal()
    {
        $ismetromanila = $this->input->post("ismetromanila");
        $data = $this->input->post("data");
        $type = $this->input->post("type");
        echo $this->transmittal->moveTransmittal($data, $ismetromanila, $type);
    }

    public function updateTransmittal()
    {
        $transmittalID     = $this->input->post("transmittalid");
        $companyName       = $this->input->post("companyname");
        $receiverName      = $this->input->post("receivername");
        $receiverTelephone = $this->input->post("receivertelephone");
        $receiverAddress   = $this->input->post("receiveraddress");
        $receiverProvince  = $this->input->post("receiverprovince");
        $receiverCity      = $this->input->post("receivercity");
        $receiverRegion    = $this->input->post("receiverregion");
        $parcelName        = $this->input->post("parcelname");
        $totalParcel       = $this->input->post("totalparcel");
        $COD               = $this->input->post("cod");
        $remarks           = $this->input->post("remarks");
        $inspected         = $this->input->post("inspected") != "" ? $this->input->post("inspected") : NULL;
        $rider             = $this->input->post("rider") != "" ? $this->input->post("rider") : NULL;
        $type              = $this->input->post("type");
        
        $updatedData = $type == "new" ? 
            [
                "companyName"       => $companyName,
                "receiverName"      => $receiverName,
                "receiverTelephone" => $receiverTelephone,
                "receiverAddress"   => $receiverAddress,
                "receiverProvince"  => $receiverProvince,
                "receiverCity"      => $receiverCity,
                "receiverRegion"    => $receiverRegion,
                "parcelName"        => $parcelName,
                "totalParcel"       => $totalParcel,
                "COD"               => $COD,
                "remarks"           => $remarks
            ] 
            : 
            [
                "companyName"       => $companyName,
                "receiverName"      => $receiverName,
                "receiverTelephone" => $receiverTelephone,
                "receiverAddress"   => $receiverAddress,
                "receiverProvince"  => $receiverProvince,
                "receiverCity"      => $receiverCity,
                "receiverRegion"    => $receiverRegion,
                "parcelName"        => $parcelName,
                "totalParcel"       => $totalParcel,
                "COD"               => $COD,
                "remarks"           => $remarks,
                "inspected"         => $inspected,
                "rider"             => $rider,
            ];
        echo $this->transmittal->updateTransmittal($transmittalID, $updatedData, $type);
    }

    public function submitTransmittal()
    {
        echo $this->transmittal->submitTransmittal();
    }
    
    public function assignTransmittal()
    {
        $data   = $this->input->post("data");
        $assign = $this->input->post("assign");
        $field  = $this->input->post("field");
        $type   = $this->input->post("type");
        echo $this->transmittal->assignTransmittal($data, $assign, $field, $type);
    }

}
