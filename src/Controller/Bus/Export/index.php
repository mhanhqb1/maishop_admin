<?php

use App\Lib\Api;
use Cake\Core\Configure;
use App\Form\ExportForm;

// Create breadcrumb
$pageTitle = __('LABEL_EXPORT_ORDER');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'name' => $pageTitle,
    ));

// Create search form
$form = new ExportForm();
$this->SearchForm
    ->setModel($form)
    ->addElement(array(
        'id' => 'date_from',
        'type' => 'text',
        'calendar' => true,
        'label' => __('LABEL_DATE_FROM'),
    ))
    ->addElement(array(
        'id' => 'date_to',
        'type' => 'text',
        'calendar' => true,
        'label' => __('LABEL_DATE_TO'),
    ))
    ->addElement(array(
        'type' => 'submit',
        'value' => __('LABEL_SAVE'),
        'class' => 'btn btn-primary',
    ));

// Valdate and get data
if ($this->request->is('post')) {
    // Trim data
    $data = $this->request->data();
    foreach ($data as $key => $value) {
        if (is_scalar($value)) {
            $data[$key] = trim($value);
        }
    }
    
    // Validation
    if ($form->validate($data)) {
        // Get data from API
        $timeout = 10 * 60;// 10 minute
        $result = Api::call(Configure::read('API.url_reports_export'), $data, false, false, $timeout);
        if (!empty($result) && !Api::getError()) {
            // Build Excel data
            require_once ROOT . '/vendor/phpexcel/PHPExcel.php';

            // Initial type
            $fileType = 'Excel2007';
            $objReader = PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load(ROOT . '/vendor/phpexcel/Template/order.xlsx');
            
            // Order sheet
            if (!empty($result['orders'])) {
                $objPHPExcel->setActiveSheetIndex(0);
                $is_fist_row = true;
                $pColumn = 0;
                $pRow = 2;
                foreach ($result['orders'] as $order) {
                    foreach ($order as $key => $value) {
                        if ($is_fist_row) {
                            // Set header
                            $objPHPExcel
                                ->getActiveSheet()
                                ->setCellValueExplicitByColumnAndRow($pColumn, 1, $key, PHPExcel_Cell_DataType::TYPE_STRING)
                            ;
                        }
                        $objPHPExcel
                            ->getActiveSheet()
                            ->setCellValueExplicitByColumnAndRow($pColumn, $pRow, $value, PHPExcel_Cell_DataType::TYPE_STRING)
                            ;
                        $pColumn++;
                    }
                    $pRow++;
                    $pColumn = 0;
                    $is_fist_row = false;
                }
            }
            
            // Itemsets
            if (!empty($result['itemsets'])) {
                $objPHPExcel->setActiveSheetIndex(1);
                $is_fist_row = true;
                $pColumn = 0;
                $pRow = 2;
                foreach ($result['itemsets'] as $itemsets) {
                    foreach ($itemsets as $key => $value) {
                        if ($is_fist_row) {
                            // Set header
                            $objPHPExcel
                                ->getActiveSheet()
                                ->setCellValueExplicitByColumnAndRow($pColumn, 1, $key, PHPExcel_Cell_DataType::TYPE_STRING)
                            ;
                        }
                        $objPHPExcel
                            ->getActiveSheet()
                            ->setCellValueExplicitByColumnAndRow($pColumn, $pRow, $value, PHPExcel_Cell_DataType::TYPE_STRING)
                            ;
                        $pColumn++;
                    }
                    $pRow++;
                    $pColumn = 0;
                    $is_fist_row = false;
                }
            }
            
            // Charge Responses
            if (!empty($result['charge_responses'])) {
                $objPHPExcel->setActiveSheetIndex(2);
                $is_fist_row = true;
                $pColumn = 0;
                $pRow = 2;
                foreach ($result['charge_responses'] as $charge_responses) {
                    foreach ($charge_responses as $key => $value) {
                        if ($is_fist_row) {
                            // Set header
                            $objPHPExcel
                                ->getActiveSheet()
                                ->setCellValueExplicitByColumnAndRow($pColumn, 1, $key, PHPExcel_Cell_DataType::TYPE_STRING)
                            ;
                        }
                        $objPHPExcel
                            ->getActiveSheet()
                            ->setCellValueExplicitByColumnAndRow($pColumn, $pRow, $value, PHPExcel_Cell_DataType::TYPE_STRING)
                            ;
                        $pColumn++;
                    }
                    $pRow++;
                    $pColumn = 0;
                    $is_fist_row = false;
                }
            }
            
            $objPHPExcel->setActiveSheetIndex(0);

            $filename = 'Order.xlsx';
            ob_end_clean();
            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header("Cache-Control: private", false);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
            $objWriter->setPreCalculateFormulas(false);
            $objWriter->save('php://output');
            exit;
        } else {
            return $this->Flash->error(__('MESSAGE_SYSTEM_ERROR'));
        }
    }
}
