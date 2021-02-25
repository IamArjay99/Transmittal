<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransmittalReport_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getCompanies()
    {
        $sql    = "SELECT * FROM transmittal GROUP BY companyName ORDER BY companyName ASC";
        $query  = $this->db->query($sql);
        return $query->result_array();
    }

    public function getAllTransmittal($companyName, $dateFrom, $dateTo)
    {
        $companyFilter = $companyName != "all" ? 'companyName = BINARY "'.$companyName.'"' : "1=1";
        $dateFilter    = $dateFrom != "" && $dateTo != "" ? "dateCreated BETWEEN '$dateFrom' AND '$dateTo'" : "1=1";
        $sql    = "SELECT * FROM transmittal WHERE ".$companyFilter." AND ".$dateFilter;
        $query  = $this->db->query($sql);
        return $query->result_array();
    }

    public function getFirstTransmittalDate()
    {
        $sql = "SELECT dateCreated FROM transmittal ORDER BY dateCreated ASC LIMIT 1";
        $query  = $this->db->query($sql);
        $result = $query->result_array();
        return $result ? date("M d, Y", strtotime($result[0]["dateCreated"])) : date("M d, Y"); 
    }

}
