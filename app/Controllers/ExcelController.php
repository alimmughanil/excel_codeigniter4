<?php

namespace App\Controllers;

use App\Models\Excel;
use CodeIgniter\Files\File;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriteXlsx;

class ExcelController extends BaseController
{
    public function import()
    {
        $file = $this->request->getFile('excel_file');

        $ext = $file->getClientExtension();
        if ($ext == 'xls') {
            $render = new Xls();
        } else {
            $render = new Xlsx();
        }
        $spreadsheet = $render->load($file);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $db = \Config\Database::connect();

            $data = [
                'name'       => $row[0],
                'email'       => $row[1],
                'barcode'       => $row[2],
                'amount'       => $row[3],
            ];
            $db->table('excel')->insert($data);
            session()->setFlashdata('message', 'Berhasil import excel');
        }

        return redirect()->to('/');
    }
    public function export()
    {
        $excel = new Excel();

        $data = $excel->findAll();
        $fileName = 'data.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'name');
        $sheet->setCellValue('B1', 'email');
        $sheet->setCellValue('C1', 'barcode');
        $sheet->setCellValue('D1', 'amount');
        $count = 2;
        $amountTotal = 0;

        foreach ($data as $row) {
            $sheet->setCellValue('A' . $count, $row['name']);
            $sheet->setCellValue('B' . $count, $row['email']);
            $sheet->setCellValue('C' . $count, $row['barcode']);
            $sheet->setCellValue('D' . $count, $row['amount']);
            $amountTotal += $row['amount'];
            $count++;
        }
        $sheet->setCellValue('C' . $count, 'Total');
        $sheet->setCellValue('D' . $count, $amountTotal);

        $writer = new WriteXlsx($spreadsheet);
        $writer->save($fileName);
        return $this->response->download($fileName, null);
    }
}