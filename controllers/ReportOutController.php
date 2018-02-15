<?php

namespace app\controllers;

use app\models\Code;
use app\models\Main;
use Yii;
use app\models\ReportOut;
use app\models\ReportOutSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportOutController implements the CRUD actions for ReportOut model.
 */
class ReportOutController extends Controller
{
    /**
     * Displays a single ReportOutSearch model.
     * @return mixed
     */
    public function actionSpeech()
    {
        $searchModel = new ReportOutSearch(['group_filter' => 'speech_id']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReportOutSearch model.
     * @return mixed
     */
    public function actionGenre()
    {
        $searchModel = new ReportOutSearch(['group_filter' => 'genre_id']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReportOutSearch model.
     * @return mixed
     */
    public function actionBroadcast()
    {
        $searchModel = new ReportOutSearch(['between' => true, 'orderBy' => 'date']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->queryParams) $this->exportBroadcastExcel($searchModel, $dataProvider);

        return $this->render('broadcast', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReportOutSearch model.
     * @return mixed
     */
    public function actionMicrophone()
    {
        $searchModel = new ReportOutSearch(['between' => true, 'orderBy' => 'prog']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->queryParams) $this->exportMicrophoneExcel($searchModel, $dataProvider);

        return $this->render('microphone', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param ReportOutSearch $searchModel
     * @param ActiveDataProvider $dataProvider
     */
    public function exportBroadcastExcel($searchModel, $dataProvider)
    {
        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setCreator("WebStudio.cv.ua")
            ->setLastModifiedBy("WebStudio.cv.ua")
            ->setTitle("Office WebStudio.cv.ua")
            ->setSubject("Office WebStudio.cv.ua")
            ->setDescription("Файл Office, сгенерированный WebStudio.cv.ua.")
            ->setKeywords("office WebStudio.cv.ua")
            ->setCategory("WebStudio.cv.ua");

        $group = 'Broadcast';
        if (\Yii::$app->user->can('managerRadio')) {
            $exTitle = 'Звіт про фактичне виконання обсягів мовлення радіоканалу ________________________';
            $rowTitle = 'Назва аудіотвору';
        } else {
            $exTitle = 'Звіт про фактичне виконання обсягів мовлення телеканалу _________________________';
            $rowTitle = 'Назва аудіовізуального твору';
        }

        // Add some data
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Connect active sheet
        $sheet = $objPHPExcel->getActiveSheet();
        // Rename worksheet
        $sheet->setTitle($group);
        $sheet->mergeCells('C3:K3');
        $sheet->setCellValue("C3", $exTitle);
        $sheet->mergeCells('C4:K4');
        $sheet->getStyle('C4')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue("C4", "(ліцензія НР №__________________ )");
        $sheet->mergeCells('C5:K5');
        $sheet->getStyle('C5')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue("C5", 'Філії НТКУ "_________________ регіональна дирекція"');
        $sheet->mergeCells('B6:B7');
        $sheet->getColumnDimension("B")->setWidth(11);
        $sheet->setCellValue("B6", 'Дата ефіру');
        $sheet->mergeCells('C6:C7');
        $sheet->getColumnDimension("C")->setWidth(40);
        $sheet->setCellValue("C6", $rowTitle);
        $sheet->mergeCells('D6:D7');
        $sheet->setCellValue("D6", 'Початок');
        $sheet->mergeCells('E6:E7');
        $sheet->setCellValue("E6", 'Кінець');
        $sheet->mergeCells('F6:F7');
        $sheet->setCellValue("F6", 'Фактичний хрон.');
        $sheet->getColumnDimension("F")->setWidth(12);
        $sheet->mergeCells('G6:G7');
        $sheet->setCellValue("G6", 'Код');
        $sheet->getStyle('B6:G7')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B6:G7')->getAlignment()->setWrapText(true);
        $sheet->getStyle('B6:G7')->getFont()->setBold(true);

        $code = Code::find()->role()->all();
        $last_colum = count($code) + 7;

        $sheet->mergeCellsByColumnAndRow($last_colum, 6, $last_colum, 7);
        $sheet->setCellValueByColumnAndRow($last_colum, 6, 'Жанр');
        $sheet->getStyleByColumnAndRow($last_colum, 6)->getAlignment()->setWrapText(true);
        $sheet->getStyleByColumnAndRow($last_colum, 6)->getFont()->setBold(true);
        $sheet->getColumnDimensionByColumn($last_colum)->setWidth(15);
        $code_array = array();

        $i=7;
        /** @var Code $value */
        foreach ($code as $value) {
            $sheet->setCellValueByColumnAndRow($i, 6, $value->name);
            $sheet->setCellValueByColumnAndRow($i, 7, $value->code_in);
            $sheet->getStyleByColumnAndRow($i, 6)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyleByColumnAndRow($i, 7)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyleByColumnAndRow($i, 6)->getFont()->setBold(true);
            $sheet->getStyleByColumnAndRow($i, 7)->getFont()->setBold(true);
            $code_array[$value->id] = $i;
            $i++;
        }

        $last_row = $dataProvider->count + 8;
        $i = 8;
        /** @var ReportOutSearch $value */
        foreach ($dataProvider->getModels() as $value) {
            $telecastName = is_numeric($value->prog) ? $value->telecast->name : $value->prog;
            $sheet->setCellValueByColumnAndRow(1, $i, date('d/m/Y', strtotime($value->date)));
            $sheet->setCellValueByColumnAndRow(2, $i, $telecastName);
            $sheet->setCellValueByColumnAndRow(3, $i, date("H:i", strtotime($value->time_s)));
            $sheet->setCellValueByColumnAndRow(4, $i, date("H:i", strtotime($value->time_e)));
            $sheet->setCellValueByColumnAndRow(5, $i, $value->sum);
            $sheet->setCellValueByColumnAndRow(6, $i, @$value->code->code_in);

            $sheet->getStyle('B'.$i.':G'.$i)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValueByColumnAndRow(@$code_array[$value->code_id], $i, $value->sum);
            $sheet->getStyleByColumnAndRow(@$code_array[$value->code_id], $i)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValueByColumnAndRow($last_colum, $i, $value->genre->name);
            $sheet->getStyleByColumnAndRow($last_colum, $i)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $i++;
        }

        $sheet->mergeCells('C'.$last_row.':E'.$last_row);
        $sheet->setCellValue('C'.$last_row, 'Всього');
        $sheet->getStyle('C'.$last_row)->getFont()->setBold(true);
        $sheet->setCellValue('F'.$last_row,'=SUM(F8:F'.($last_row-1).')');
        $sheet->getStyle('F'.$last_row)->getFont()->setBold(true);

        foreach ($code_array as $col) {
            $colIndex = $sheet->getColumnDimensionByColumn($col)->getColumnIndex();
            $sheet->setCellValue($colIndex.$last_row,'=SUM('.$colIndex.'8:'.$colIndex.($last_row-1).')');
            $sheet->getStyle($colIndex.$last_row)->getFont()->setBold(true);
        }

        $colLastIndex = $sheet->getColumnDimensionByColumn($last_colum)->getColumnIndex();
        $sheet->getStyle('B6:'.$colLastIndex.$last_row)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="broadcast-' . date('d.m.Y') . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

        /**
     * @param ReportOutSearch $searchModel
     * @param ActiveDataProvider $dataProvider
     */
    public function exportMicrophoneExcel($searchModel, $dataProvider)
    {
        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setCreator("WebStudio.cv.ua")
            ->setLastModifiedBy("WebStudio.cv.ua")
            ->setTitle("Office WebStudio.cv.ua")
            ->setSubject("Office WebStudio.cv.ua")
            ->setDescription("Файл Office, сгенерированный WebStudio.cv.ua.")
            ->setKeywords("office WebStudio.cv.ua")
            ->setCategory("WebStudio.cv.ua");

        $dataArr = Main::sortMicrophone($dataProvider->getModels());

        $date = new \DateTime($searchModel->date);
        $secondDate = new \DateTime($searchModel->second_date);

        $i = 0;
        $group = 'Microphone';
        // Add some data
        $l = 1;
        $array = array(4 => 1);
        $max = $mr = 4;

        while ($date <= $secondDate) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($l, 4, $date->format("d-m-Y"));

            $mc = 0;
            $tespro = 1;
            /** @var ReportOutSearch $value */
            if(isset($dataArr[$date->format("Y-m-d")])) {
                foreach ($dataArr[$date->format("Y-m-d")] as $value) {
                    $telecastName = is_numeric($value->prog) ? $value->telecast->name : $value->prog;
                    if ($telecastName != $tespro) {
                        $mc = 0;
                    }

                    $key = array_search($telecastName, $array);
                    if ($key == false) {
                        $max = $max + 1;
                        $mr = $max;
                        array_push($array, $telecastName);
                    } else {
                        $mr = $key;
                    }

                    if ($value->micf == 1) {
                        $mc = $mc + 1;
                    }

                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $mr, $telecastName);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($l, $mr, $mc);

                    $tespro = $telecastName;
                }
            }
            $date->modify('+1 day');
            ++$l;
        }
        // end

        $objPHPExcel->setActiveSheetIndex($i)->setTitle($group);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="microphone-' . date('d.m.Y') . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    /**
     * Displays a single ReportOutSearch model.
     * @return mixed
     */
    public function actionPrint()
    {
        $this->layout = 'print';
        $searchModel = new ReportOutSearch(['group_filter' => Yii::$app->request->queryParams['group_filter']]);
        $dataProvider = $searchModel->search(['ReportOutSearch' => Yii::$app->request->queryParams]);

        return $this->render('print', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
