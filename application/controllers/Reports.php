<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;

class Reports extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("TransmittalReport_model", "transmittal_report");
    }

	public function transmittal()
	{
        $data["title"]        = "Transmittal Report";
        $data["companies"]    = $this->transmittal_report->getCompanies();
        $data["first_date"]   = $this->transmittal_report->getFirstTransmittalDate();

		$this->load->view('template/header', $data);
		$this->load->view('reports/transmittal/index', $data);
        $this->load->view('template/footer');
    }
    
    public function getAllTransmittal()
    {
        $companyName = $this->input->post("companyName");
        $dateFrom    = $this->input->post("dateFrom") ? $this->input->post("dateFrom")." 00:00:00" : "";
        $dateTo      = $this->input->post("dateTo") ? $this->input->post("dateTo")." 23:59:59" : "";
        echo json_encode($this->transmittal_report->getAllTransmittal($companyName, $dateFrom, $dateTo));
    }

    public function downloadExcelAll($transmittals, $dateRange)
    {
        $fileName    = "TransmittalReport.xlsx";
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        $styleThinBlackBorderOutline = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        
        $cellWidth = 15;
        $sheet->getColumnDimension('A')->setWidth($cellWidth);
        $sheet->getColumnDimension('B')->setWidth($cellWidth);
        $sheet->getColumnDimension('C')->setWidth($cellWidth);
        $sheet->getColumnDimension('D')->setWidth($cellWidth);
        $sheet->getColumnDimension('E')->setWidth($cellWidth);
        $sheet->getColumnDimension('F')->setWidth($cellWidth);
        $sheet->getColumnDimension('G')->setWidth($cellWidth);
        $sheet->getColumnDimension('H')->setWidth($cellWidth);
        $sheet->getColumnDimension('I')->setWidth($cellWidth);
        $sheet->getColumnDimension('J')->setWidth($cellWidth);
        $sheet->getColumnDimension('K')->setWidth($cellWidth);
        $sheet->getColumnDimension('L')->setWidth($cellWidth);

        // ----- HEADER -----
        // $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        // $drawing->setPath("assets/img/icon/logo.png");
        // $drawing->setCoordinates('A1');
        // $drawing->setWidthAndHeight(100,100);
        // $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);
        // $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $sheet->mergeCells('A1:L1');
        $sheet->mergeCells('E2:F2');
        $sheet->mergeCells('G2:H2');

        $sheet->setCellValue('A1', "TRANSMITTAL REPORT");
        $sheet->setCellValue('E2', "DATE: ");
        $sheet->setCellValue('G2', " ".$dateRange);

        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2:F2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('G2:L2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->setCellValue('A4', "RECEIVER");
        $sheet->setCellValue('B4', "RECEIVER TELEPHONE");
        $sheet->setCellValue('C4', "RECEIVER ADDRESS");
        $sheet->setCellValue('D4', "RECEIVER PROVINCE");
        $sheet->setCellValue('E4', "RECEIVER CITY");
        $sheet->setCellValue('F4', "RECEIVER REGION");
        $sheet->setCellValue('G4', "PARCEL NAME");
        $sheet->setCellValue('H4', "TOTAL PARCEL");
        $sheet->setCellValue('I4', "COD");
        $sheet->setCellValue('J4', "REMARKS");
        $sheet->setCellValue('K4', "INSPECTED");
        $sheet->setCellValue('L4', "RIDER");

        $sheet->getRowDimension(1)->setRowHeight(-1);
        $sheet->getRowDimension(2)->setRowHeight(-1);
        $sheet->getRowDimension(4)->setRowHeight(-1);

        $sheet->getStyle('A1:L4')->getFont()->setBold(true);
        $sheet->getStyle('A1:L4')->getAlignment()->setWrapText(true);

        $sheet->getStyle('A4:L4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A4:L4')->applyFromArray($styleThinBlackBorderOutline);
        // ----- HEADER -----

        $start = 5;
        foreach($transmittals as $transmittal) {
            $sheet->getRowDimension($start)->setRowHeight(-1);

            $sheet->setCellValue('A'.$start, "(".$transmittal["companyName"].") ".$transmittal["receiverName"]);
            $sheet->setCellValue('B'.$start, $transmittal["receiverTelephone"]);
            $sheet->setCellValue('C'.$start, $transmittal["receiverAddress"]);
            $sheet->setCellValue('D'.$start, $transmittal["receiverProvince"]);
            $sheet->setCellValue('E'.$start, $transmittal["receiverCity"]);
            $sheet->setCellValue('F'.$start, $transmittal["receiverRegion"]);
            $sheet->setCellValue('G'.$start, $transmittal["parcelName"]);
            $sheet->setCellValue('H'.$start, $transmittal["totalParcel"]);
            $sheet->setCellValue('I'.$start, $transmittal["COD"]);
            $sheet->setCellValue('J'.$start, $transmittal["remarks"]);
            $sheet->setCellValue('K'.$start, $transmittal["inspected"]);
            $sheet->setCellValue('L'.$start, $transmittal["rider"]);

            $sheet->getStyle('A'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('H'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('I'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('J'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('K'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('L'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('A'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('B'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('C'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('D'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('E'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('F'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('G'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('H'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('I'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('J'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('K'.$start)->getAlignment()->setWrapText(true);
            $sheet->getStyle('L'.$start)->getAlignment()->setWrapText(true);

            $sheet->getStyle('A'.$start.':L'.$start)->applyFromArray($styleThinBlackBorderOutline);

            $start++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
    }

    public function downloadExcelByRegion($transmittals, $dateRange, $region)
    {
        $regionTitle = $region == "0" ? "NATIONWIDE" : "METRO MANILA";
        $fileName    = "TransmittalReport.xlsx";
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        $styleThinBlackBorderOutline = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        
        $cellWidth = 15;
        $sheet->getColumnDimension('A')->setWidth($cellWidth);
        $sheet->getColumnDimension('B')->setWidth($cellWidth);
        $sheet->getColumnDimension('C')->setWidth($cellWidth);
        $sheet->getColumnDimension('D')->setWidth($cellWidth);
        $sheet->getColumnDimension('E')->setWidth($cellWidth);
        $sheet->getColumnDimension('F')->setWidth($cellWidth);
        $sheet->getColumnDimension('G')->setWidth($cellWidth);
        $sheet->getColumnDimension('H')->setWidth($cellWidth);
        $sheet->getColumnDimension('I')->setWidth($cellWidth);
        $sheet->getColumnDimension('J')->setWidth($cellWidth);
        $sheet->getColumnDimension('K')->setWidth($cellWidth);
        $sheet->getColumnDimension('L')->setWidth($cellWidth);

        // ----- HEADER -----
        $sheet->mergeCells('A1:L1');
        $sheet->mergeCells('E2:F2');
        $sheet->mergeCells('G2:H2');

        $sheet->setCellValue('A1', "TRANSMITTAL REPORT");
        $sheet->setCellValue('E2', "DATE: ");
        $sheet->setCellValue('G2', " ".$dateRange);

        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2:F2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('G2:L2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->mergeCells('A4:L4');
        $sheet->setCellValue('A4', $regionTitle);

        $sheet->setCellValue('A5', "RECEIVER");
        $sheet->setCellValue('B5', "RECEIVER TELEPHONE");
        $sheet->setCellValue('C5', "RECEIVER ADDRESS");
        $sheet->setCellValue('D5', "RECEIVER PROVINCE");
        $sheet->setCellValue('E5', "RECEIVER CITY");
        $sheet->setCellValue('F5', "RECEIVER REGION");
        $sheet->setCellValue('G5', "PARCEL NAME");
        $sheet->setCellValue('H5', "TOTAL PARCEL");
        $sheet->setCellValue('I5', "COD");
        $sheet->setCellValue('J5', "REMARKS");
        $sheet->setCellValue('K5', "INSPECTED");
        $sheet->setCellValue('L5', "RIDER");

        $sheet->getRowDimension(1)->setRowHeight(-1);
        $sheet->getRowDimension(2)->setRowHeight(-1);
        $sheet->getRowDimension(4)->setRowHeight(-1);
        $sheet->getRowDimension(5)->setRowHeight(-1);

        $sheet->getStyle('A1:L5')->getFont()->setBold(true);
        $sheet->getStyle('A1:L5')->getAlignment()->setWrapText(true);

        $sheet->getStyle('A4:L5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A4:L5')->applyFromArray($styleThinBlackBorderOutline);
        // ----- HEADER -----

        $start = 6;
        foreach($transmittals as $transmittal) {
            if ($transmittal["isMetroManila"] == $region) {
                $sheet->getRowDimension($start)->setRowHeight(-1);

                $sheet->setCellValue('A'.$start, "(".$transmittal["companyName"].") ".$transmittal["receiverName"]);
                $sheet->setCellValue('B'.$start, $transmittal["receiverTelephone"]);
                $sheet->setCellValue('C'.$start, $transmittal["receiverAddress"]);
                $sheet->setCellValue('D'.$start, $transmittal["receiverProvince"]);
                $sheet->setCellValue('E'.$start, $transmittal["receiverCity"]);
                $sheet->setCellValue('F'.$start, $transmittal["receiverRegion"]);
                $sheet->setCellValue('G'.$start, $transmittal["parcelName"]);
                $sheet->setCellValue('H'.$start, $transmittal["totalParcel"]);
                $sheet->setCellValue('I'.$start, $transmittal["COD"]);
                $sheet->setCellValue('J'.$start, $transmittal["remarks"]);
                $sheet->setCellValue('K'.$start, $transmittal["inspected"]);
                $sheet->setCellValue('L'.$start, $transmittal["rider"]);

                $sheet->getStyle('A'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('D'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('E'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('G'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('H'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('I'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('J'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('K'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('L'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('A'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('B'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('C'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('D'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('E'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('F'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('G'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('H'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('I'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('J'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('K'.$start)->getAlignment()->setWrapText(true);
                $sheet->getStyle('L'.$start)->getAlignment()->setWrapText(true);

                $sheet->getStyle('A'.$start.':L'.$start)->applyFromArray($styleThinBlackBorderOutline);

                $start++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
    }

    public function downloadExcelTransmittal()
    {
        $companyName  = $this->input->get("companyName");
        $dateFrom     = $this->input->get("dateFrom") ? $this->input->get("dateFrom")." 00:00:00" : "";
        $dateTo       = $this->input->get("dateTo") ? $this->input->get("dateTo")." 23:59:59" : "";
        $region       = $this->input->get("region") != "" ? $this->input->get("region") : "";
        $dateRange    = $this->input->get("dateFrom") == $this->input->get("dateTo") ? date("m/d/Y", strtotime($dateFrom)) : date("m/d/Y", strtotime($dateFrom))."-".date("m/d/Y", strtotime($dateTo));
        $transmittals = $this->transmittal_report->getAllTransmittal($companyName, $dateFrom, $dateTo);
        if ($region != "") {
            $this->downloadExcelByRegion($transmittals, $dateRange, $region);
        } else {
            $this->downloadExcelAll($transmittals, $dateRange);
        }
    }

    public function printTransmittal()
    {
        $companyName  = $this->input->get("companyName");
        $dateFrom     = $this->input->get("dateFrom") ? $this->input->get("dateFrom")." 00:00:00" : "";
        $dateTo       = $this->input->get("dateTo") ? $this->input->get("dateTo")." 23:59:59" : "";
        $region       = $this->input->get("region") != "" ? $this->input->get("region") : "";
        $dateRange    = $this->input->get("dateFrom") == $this->input->get("dateTo") ? date("m/d/Y", strtotime($dateFrom)) : date("m/d/Y", strtotime($dateFrom))."-".date("m/d/Y", strtotime($dateTo));
        $transmittals = $this->transmittal_report->getAllTransmittal($companyName, $dateFrom, $dateTo);

        $data["transmittals"] = $transmittals;
        $data["dateRange"]    = $dateRange;
        $data["region"]       = $region;
        $this->load->view('reports/transmittal/print', $data);
    }

}
