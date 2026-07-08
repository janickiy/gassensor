<?php

namespace infrastructure\Product\Service;

use application\Product\Port\SensorsImporterInterface;
use application\Setting\Service\SettingService;
use common\models\SensorsList;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use RuntimeException;
use yii\web\UploadedFile;

class SensorsImporter implements SensorsImporterInterface
{
    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function importUploadedFile(UploadedFile $file): int
    {
        $spreadsheet = $this->openFile($file->tempName, strtolower($file->extension));
        $count = $this->processSpreadsheet($spreadsheet);
        $fileName = 'sensors_list.' . $file->extension;

        if ($file->saveAs('../upload/' . $fileName)) {
            $this->settingService->saveValue('SENSORS_LIST', $fileName);
        }

        return $count;
    }

    private function openFile(string $file, string $extension): Spreadsheet
    {
        $types = [
            'xlsx' => 'Xlsx',
            'xls' => 'Xls',
            'csv' => 'Csv',
            'ods' => 'Ods',
        ];
        if (!isset($types[$extension])) {
            throw new RuntimeException("Unsupported import extension: {$extension}");
        }

        $reader = IOFactory::createReader($types[$extension]);
        $reader->setReadDataOnly(false);

        return $reader->load($file);
    }

    private function processSpreadsheet(Spreadsheet $spreadsheet): int
    {
        $count = 0;
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $sheetCount = count($sheetData);

        SensorsList::deleteAll();

        for ($row = 24; $row < $sheetCount; $row++) {
            if (empty($sheetData[$row]['A']) || empty($sheetData[$row]['D'])) {
                continue;
            }

            $model = new SensorsList();
            $model->name = trim((string)$sheetData[$row]['A']);
            $model->name2 = str_replace('#NULL!', '', trim((string)$sheetData[$row]['C']));
            $model->count = (int)str_replace(' ', '', (string)$sheetData[$row]['D']);

            $link = str_replace('#NULL!', '', trim((string)$sheetData[$row]['E']));
            if ($link !== '') {
                $model->link = $link;
            }

            if ($model->save()) {
                $count++;
            }
        }

        return $count;
    }
}
