<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transmittal_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getSpecificTransmittal($id, $type)
    {
        $sql = $type == "new" ? "SELECT * FROM new_transmittal WHERE new_transmittalID = $id" : "SELECT * FROM transmittal WHERE transmittalID = $id";
        return $this->db->query($sql)->result_array();
    }

    public function getNewTransmittal()
    {
        $sql   = "SELECT * FROM new_transmittal ORDER BY companyName ASC, receiverName ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getAllTransmittal()
    {
        $sql   = "SELECT * FROM transmittal GROUP BY DATE(dateCreated) DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getTransmittalByDate($dateFrom, $dateTo, $companyName)
    {
        $sql = $companyName == "all" ? "SELECT * FROM transmittal WHERE dateCreated BETWEEN '$dateFrom' AND '$dateTo' ORDER BY companyName ASC, receiverName ASC" : 'SELECT * FROM transmittal WHERE companyName = BINARY "'.$companyName.'" AND dateCreated BETWEEN "'.$dateFrom.'" AND "'.$dateTo.'" ORDER BY receiverName ASC';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function saveTransmittal($data)
    {
        $query = $this->db->insert_batch("new_transmittal", $data);
        return $query ? true : false;
    }

    public function clearTransmittal()
    {
        $sql   = "TRUNCATE TABLE new_transmittal";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }

    public function deleteTransmittal($data, $type)
    {
        $sql = $type == "new" ? "DELETE FROM new_transmittal WHERE new_transmittalID IN (".implode(",", $data).")" : "DELETE FROM transmittal WHERE transmittalID IN (".implode(",", $data).")";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }

    public function moveTransmittal($data, $isMetroManila, $type)
    {
        if ($type == "new") {
            foreach($data as $id) {
                $transmittal       = $this->getSpecificTransmittal($id, $type);
                $companyName       = $transmittal[0]["companyName"];
                $receiverName      = $transmittal[0]["receiverName"];
                $receiverTelephone = $transmittal[0]["receiverTelephone"];
                $receiverAddress   = $transmittal[0]["receiverAddress"];
                $receiverProvince  = $transmittal[0]["receiverProvince"];
                $receiverCity      = $transmittal[0]["receiverCity"];
                $receiverRegion    = $transmittal[0]["receiverRegion"];
                $isOldMetroManila  = $transmittal[0]["isMetroManila"]; 
                $parcelName        = $transmittal[0]["parcelName"];
                $totalParcel       = $transmittal[0]["totalParcel"];
                $COD               = $transmittal[0]["COD"];
                $remarks           = $transmittal[0]["remarks"];
    
                $sql = "UPDATE new_transmittal SET isMetroManila = $isMetroManila WHERE new_transmittalID = $id";
                $query = $this->db->query($sql);
            }
            return true;
        } else if ($type == "all") {
            foreach($data as $id) {
                $transmittal       = $this->getSpecificTransmittal($id, $type);
                $companyName       = $transmittal[0]["companyName"];
                $receiverName      = $transmittal[0]["receiverName"];
                $receiverTelephone = $transmittal[0]["receiverTelephone"];
                $receiverAddress   = $transmittal[0]["receiverAddress"];
                $receiverProvince  = $transmittal[0]["receiverProvince"];
                $receiverCity      = $transmittal[0]["receiverCity"];
                $receiverRegion    = $transmittal[0]["receiverRegion"];
                $isOldMetroManila  = $transmittal[0]["isMetroManila"]; 
                $parcelName        = $transmittal[0]["parcelName"];
                $totalParcel       = $transmittal[0]["totalParcel"];
                $COD               = $transmittal[0]["COD"];
                $remarks           = $transmittal[0]["remarks"];
    
                $sql = "UPDATE transmittal SET isMetroManila = $isMetroManila WHERE transmittalID = $id";
                $query = $this->db->query($sql);
            }
            return true;
        }
    }

    public function updateTransmittal($transmittalID, $updatedData, $type)
    {
        $query = $type == "new" ? $this->db->update("new_transmittal", $updatedData, "new_transmittalID=$transmittalID") : $this->db->update("transmittal", $updatedData, "transmittalID=$transmittalID");
        return $query ? true : false;
    }

    public function submitTransmittal()
    {
        $newTransmittal = $this->getNewTransmittal();
        $data = [];
        foreach($newTransmittal as $transmittal) {
            $temp = [
                "companyName"       => $transmittal["companyName"],
                "receiverName"      => $transmittal["receiverName"],
                "receiverTelephone" => $transmittal["receiverTelephone"],
                "receiverAddress"   => $transmittal["receiverAddress"],
                "receiverProvince"  => $transmittal["receiverProvince"],
                "receiverCity"      => $transmittal["receiverCity"],
                "receiverRegion"    => $transmittal["receiverRegion"],
                "isMetroManila"     => $transmittal["isMetroManila"],
                "parcelName"        => $transmittal["parcelName"],
                "totalParcel"       => $transmittal["totalParcel"],
                "COD"               => $transmittal["COD"],
                "remarks"           => $transmittal["remarks"],
            ];
            array_push($data, $temp);
        }
        $query = $this->db->insert_batch("transmittal", $data);
        if ($query) {
            $truncate = $this->clearTransmittal();
            return $truncate ? true : false;
        } else {
            return false;
        }
    }

    public function assignTransmittal($data, $assign, $field, $type)
    {
        foreach($data as $id) {
            $sql = $field == "rider" ? "UPDATE transmittal SET rider = '$assign' WHERE transmittalID = $id" : "UPDATE transmittal SET inspected = '$assign' WHERE transmittalID = $id";
            $query = $this->db->query($sql);
        }
        return true;
    }

}
