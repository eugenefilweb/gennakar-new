<?php

namespace app\modules\api\v1\models\form;

use yii\db\Expression;
use yii\web\UploadedFile;
use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\Tree;
use app\modules\api\v1\models\Patrol;
use app\modules\api\v1\models\form\UploadForm;

class SyncPatrol extends \yii\base\Model
{
    public $patrols; 
  
    public function rules()
    {
        return [
            [['patrols'], 'required'],
        ];
    }

    protected function distance($coord1, $coord2) 
    {
        // Calculate the Euclidean distance between two coordinates.
        $x1 = $coord1[0];
        $y1 = $coord1[1];
        $x2 = $coord2[0];
        $y2 = $coord2[1];
        return sqrt(($x2 - $x1) ** 2 + ($y2 - $y1) ** 2);
    }

    protected function filter_coordinates($coords, $radius) 
    {
        // Filter a list of coordinates to remove those within the given radius of their consecutive.
        $filtered_coords = array($coords[0]);
        $prev_coord = $coords[0];
        foreach (array_slice($coords, 1) as $coord) {
            if ($this->distance($coord, $prev_coord) <= $radius) {
                continue;
            }
            $filtered_coords[] = $coord;
            $prev_coord = $coord;
        }
        return $filtered_coords;
    }

    public function sync()
    {
        if ($this->validate()) {
            $response = [];
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                foreach ($this->patrols as $patrolKey => $patrol) {
                    $patrolModel = new Patrol([
                        'user_id' => App::identity('id'),
                        'watershed' => $patrol['watershed'] ?? '',
                        'distance' => $patrol['distance'] ?? 0,
                        'total_time' => $patrol['total_time'] ?? 0,
                        'coordinates' => $patrol['coordinates'] ?? [],
                        'date' => App::formatter()->asDateToTimezone('', 'm/d/Y'),
                        'notes' => $patrol['notes'] ?? '',
                    ]);

                    if ($patrolModel->save()) {
                        $patrolModel->refresh();

                        $floras = [];
                        foreach (($patrol['floras'] ?? []) as $floraKey => $flora) {
                            $photos = [];
                            foreach (Tree::PHOTO_KEYS as $categoryKey => $category) {
                                $tokens = [];
                                foreach (UploadedFile::getInstancesByName("patrols[{$patrolKey}][floras][{$floraKey}][photos][{$categoryKey}]") as $fileKey => $fileInput) {
                                    $uploadForm = new UploadForm([
                                        'modelName' => 'Tree',
                                        'tag' => 'Tree',
                                    ]);
                                    $uploadForm->fileInput = $fileInput;

                                    if (($file = $uploadForm->upload()) != false) {
                                        $tokens[] = $file->token;
                                    }
                                }

                                $photos[$categoryKey] = $tokens ?: [null];
                            }

                            $floras[] = [
                                'patroller_id' => $patrolModel->user_id,
                                'patrol_id' => $patrolModel->id,
                                'app_id' => $flora['appId'] ?? '',
                                'common_name' => $flora['common_name'] ?? '',
                                'kingdom' => $flora['kingdom'] ?? '',
                                'family' => $flora['family'] ?? '',
                                'genus' => $flora['genus'] ?? '',
                                'species' => $flora['species'] ?? '',
                                'sub_species' => $flora['sub_species'] ?? '',
                                'varieta_and_infra_var_name' => $flora['varieta_and_infra_var_name'] ?? '',
                                'taxonomic_group' => $flora['taxonomic_group'] ?? '',
                                'date_encoded' => date('Y-m-d H:i:s', strtotime($flora['date_encoded'] ?? '')),
                                'description' => $flora['description'] ?? '',
                                'latitude' => $flora['latitude'] ?? '',
                                'longitude' => $flora['longitude'] ?? '',
                                'validated_by_id' => 0,
                                'notes' => $flora['notes'] ?? '',
                                'photos' => json_encode($photos),
                                'status' => Tree::NOT_VALIDATED,
                                'record_status' => Tree::RECORD_ACTIVE,
                                'created_at' => new Expression('UTC_TIMESTAMP'),
                                'updated_at' => new Expression('UTC_TIMESTAMP'),
                                'created_by' => $patrolModel->user_id,
                                'updated_by' => $patrolModel->user_id,
                            ];
                        }

                        Tree::batchInsert(array_values($floras));

                        $response['patrol'][$patrolKey] = $patrolModel;
                    }
                    else {
                        $response['patrol'][$patrolKey]['error'] = $patrolModel->errors;
                    }
                }
                $transaction->commit();

                $response['req'] = App::post();
                return $response;
            } 
            catch (Exception $e) {
                $transaction->rollback();
                return [
                    'status' => false,
                    'errorSummary' => $e
                ];
            }
        }
    }
}