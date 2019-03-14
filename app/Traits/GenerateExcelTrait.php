<?php
namespace App\Traits;

require_once app_path().'/Http/Controllers/PHPExcelClass/PHPExcel.php';

use DB;
use Auth;
use PHPExcel_IOFactory;
use PHPExcel_Worksheet_MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

trait GenerateExcelTrait 
{
	public function generateExcelFile($title, $fileName, $reportColumns, $reportData, $meta, $additionalTableHeader = "No")
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle(substr($title, 0, 31));

        //set branding logo and header
        $HeaderStyleArray = [
            'font' => [
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size'  => 15,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '253135',
                ],
                'endColor' => [
                    'argb' => '253135',
                ],
            ],
        ];

        $reportColumnsCount = count($reportColumns);
        $reportColumnsCountChr = $this->getLetterCorrespondingToANumber($reportColumnsCount);
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath('images/excel_report_icons/QixTix_Logo.png');
        $drawing->setCoordinates('A1');
        $drawing->setHeight(26);
        $drawing->setOffsetX(6);
        $drawing->setOffsetY(6);
        $sheet->mergeCells('A1:B2');
        $sheet->getStyle('A1:B2')
              ->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB('253135');

        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $sheet->mergeCells('C1:'.$reportColumnsCountChr.'2');
        $sheet->setCellValue('C1', 'QixTix | Automated Fare Collection System');
        $sheet->getStyle('C1:'.$reportColumnsCountChr.'2')->applyFromArray($HeaderStyleArray);

        //set report title and filters
        $sheet->mergeCells('A3:'.$reportColumnsCountChr.'3')
              ->setCellValue('A3', $title);
        $sheet->getStyle('A3:'.$reportColumnsCountChr.'3')
              ->getAlignment()
              ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        foreach ($meta as $key => $m) 
        {
            $start = 2*$key+1;
            
            $end = 2*$key+2;
            $sheet->mergeCells($this->getLetterCorrespondingToANumber($start).'4:'.$this->getLetterCorrespondingToANumber($end).'4');
            $sheet->setCellValue($this->getLetterCorrespondingToANumber($start).'4', $m);
        }

        //set table header for report
        //additional table header settings
        if($additionalTableHeader == "Yes")
        {
            $sheet->mergeCells('C6:F6');
            $sheet->setCellValue('C6', 'KMS');
            $sheet->mergeCells('G6:J6');
            $sheet->setCellValue('G6', 'Income');
            $sheet->mergeCells('K6:N6');
            $sheet->setCellValue('K6', 'EPKM');
            $sheet->getStyle('C6:K6')
                  ->getAlignment()
                  ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        $sheet->getStyle('A6:'.$reportColumnsCountChr.'6')
              ->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB('367fa9');

        $sheet->getStyle('A6:'.$reportColumnsCountChr.'6')
              ->getFont()
              ->getColor()
              ->setARGB('ffffff');

        $sheet->getStyle('A7:'.$reportColumnsCountChr.'7')
              ->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB('367fa9');

        $sheet->getStyle('A7:'.$reportColumnsCountChr.'7')
              ->getFont()
              ->getColor()
              ->setARGB('ffffff');

        $sheet->fromArray($reportData, null, 'A7');

        //Set Footer
        $footerStartFrom = $reportColumnsCount + 8;
        $footerColumnSeperatorCount = $reportColumnsCount/2; 
        $sheet->mergeCells('A'.$footerStartFrom.':'.$this->getLetterCorrespondingToANumber($footerColumnSeperatorCount).$footerStartFrom);
        $sheet->setCellValue('A'.$footerStartFrom, "Print taken by : ".Auth::user()->name);

        $sheet->mergeCells($this->getLetterCorrespondingToANumber($footerColumnSeperatorCount+1).$footerStartFrom.':'.$reportColumnsCountChr.$footerStartFrom);
        $sheet->setCellValue($this->getLetterCorrespondingToANumber($footerColumnSeperatorCount+1).$footerStartFrom, "Print taken at : ".date('d-m-Y H:i:s'));
        $sheet->getStyle($this->getLetterCorrespondingToANumber($footerColumnSeperatorCount+1).$footerStartFrom)
              ->getAlignment()
              ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
    }


    public function getLetterCorrespondingToANumber($number)
    {
        return chr(64+$number);
    }

    public function downloadExcelFile($fileName)
    {
        $file = $fileName;
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit();
    }
}

