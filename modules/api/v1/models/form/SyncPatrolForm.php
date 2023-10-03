<?php

namespace app\modules\api\v1\models\form;

use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\Patrol;
use app\modules\api\v1\models\Tree;
use yii\web\UploadedFile;
use yii\db\Expression;
use app\modules\api\v1\models\form\UploadForm;

class SyncPatrolForm extends \yii\base\Model
{
    public $patrol; 
    public $trees; 
    public $faunas; 
  
    public function rules()
    {
        return [
            [['patrol', 'trees', 'faunas'], 'required'],
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

            $patrol = new Patrol([
                'user_id' => App::identity('id'),
                'watershed' => $this->patrol['watershed'],
                'coordinates' => $this->patrol['coordinates'],
                // 'coordinates' => $this->filter_coordinates($this->patrol['coordinates'], App::setting('mobileApp')->coordinate_radius_tracking),
                'date' => $this->patrol['date'],
                'notes' => $this->patrol['notes'],
                'distance' => $this->patrol['distance'] ?? 0,
            ]);

            if ($patrol->save()) {
                // FLORAS::BEGIN
                $trees = App::foreach($this->trees, function ($tree, $index) use($patrol, &$response) {
                    $photos = App::foreach(Tree::PHOTO_KEYS, function($category, $key) use($index, &$response) {
                        $tokens = App::foreach(
                            UploadedFile::getInstancesByName("trees[{$index}][{$key}]"), 
                            function($fileInput, $file_key) use(&$response, $key) {
                                $uploadForm = new UploadForm([
                                    'modelName' => 'Tree',
                                    'tag' => 'Tree',
                                ]);
                                $uploadForm->fileInput = $fileInput;

                                if (($file = $uploadForm->upload()) != false) {
                                    $response['files'][$key][$file_key]['status'] = true;
                                    $response['files'][$key][$file_key]['fileInput'] = $fileInput;
                                    return $file->token;
                                }
                                else {
                                    $response['files'][$key][$file_key]['status'] = false;
                                    $response['files'][$key][$file_key]['fileInput'] = $fileInput;
                                }
                            }, 
                            false
                        );
                        return $tokens ?: [null];
                    }, false);

                    $coordinate = App::formatter()->asEPSG3857([
                        'lat' => $tree['latitude'] ?? 0,
                        'lon' => $tree['longitude'] ?? 0,
                    ]);

                    return [
                        'patrol_id' => $patrol->id,
                        'app_id' => $tree['appId'] ?? '',
                        'common_name' => $tree['common_name'] ?? '',
                        'kingdom' => $tree['kingdom'] ?? '',
                        'family' => $tree['family'] ?? '',
                        'genus' => $tree['genus'] ?? '',
                        'species' => $tree['species'] ?? '',
                        'sub_species' => $tree['sub_species'] ?? '',
                        'varieta_and_infra_var_name' => $tree['varieta_and_infra_var_name'] ?? '',
                        // 'taxonomic_group' => $tree['taxonomic_group'] ?? '',
                        'growth_habit' => $tree['growth_habit'] ?? '',
                        'category_id' => $tree['category_id'] ?? '',
                        'conservation_status' => $tree['conservation_status'] ?? '',
                        'diameter' => $tree['diameter'] ?? '',
                        'date_encoded' => date('Y-m-d H:i:s', strtotime($tree['date_encoded'] ?? '')),
                        'description' => $tree['description'] ?? '',
                        'latitude' => $coordinate['lon'],
                        'longitude' => $coordinate['lat'],
                        'validated_by_id' => 0,
                        'notes' => $tree['notes'] ?? '',
                        'photos' => json_encode($photos),
                        'status' => Tree::NOT_VALIDATED,
                        'record_status' => Tree::RECORD_ACTIVE,
                        'created_at' => new Expression('UTC_TIMESTAMP'),
                        'updated_at' => new Expression('UTC_TIMESTAMP'),
                        'created_by' => $patrol->user_id,
                        'updated_by' => $patrol->user_id,
                    ];
                }, false);

                Tree::batchInsert(array_values($trees));
                $patrol->refresh();
                // FLORAS::END
                
                // FAUNAS::BEGIN
                $faunas = App::foreach($this->faunas, function ($fauna, $index) use($patrol, &$response) {
                    $photos = App::foreach(Fauna::PHOTO_KEYS, function($category, $key) use($index, &$response) {
                        $tokens = App::foreach(
                            UploadedFile::getInstancesByName("faunas[{$index}][{$key}]"), 
                            function($fileInput, $file_key) use(&$response, $key) {
                                $uploadForm = new UploadForm([
                                    'modelName' => 'Fauna',
                                    'tag' => 'Fauna',
                                ]);
                                $uploadForm->fileInput = $fileInput;

                                if (($file = $uploadForm->upload()) != false) {
                                    $response['files'][$key][$file_key]['status'] = true;
                                    $response['files'][$key][$file_key]['fileInput'] = $fileInput;
                                    return $file->token;
                                }
                                else {
                                    $response['files'][$key][$file_key]['status'] = false;
                                    $response['files'][$key][$file_key]['fileInput'] = $fileInput;
                                }
                            }, 
                            false
                        );
                        return $tokens ?: [null];
                    }, false);

                    $coordinate = App::formatter()->asEPSG3857([
                        'lat' => $fauna['latitude'] ?? 0,
                        'lon' => $fauna['longitude'] ?? 0,
                    ]);

                    return [
                        'patrol_id' => $patrol->id,
                        'app_id' => $fauna['appId'] ?? '',
                        'common_name' => $fauna['common_name'] ?? '',
                        'kingdom' => $fauna['kingdom'] ?? '',
                        'family' => $fauna['family'] ?? '',
                        'genus' => $fauna['genus'] ?? '',
                        'species' => $fauna['species'] ?? '',
                        'sub_species' => $fauna['sub_species'] ?? '',
                        'varieta_and_infra_var_name' => $fauna['varieta_and_infra_var_name'] ?? '',
                        // 'taxonomic_group' => $fauna['taxonomic_group'] ?? '',
                        'growth_habit' => $fauna['growth_habit'] ?? '',
                        'category_id' => $fauna['category_id'] ?? '',
                        'conservation_status' => $fauna['conservation_status'] ?? '',
                        'diameter' => $fauna['diameter'] ?? '',
                        'date_encoded' => date('Y-m-d H:i:s', strtotime($fauna['date_encoded'] ?? '')),
                        'description' => $fauna['description'] ?? '',
                        'latitude' => $coordinate['lon'],
                        'longitude' => $coordinate['lat'],
                        'validated_by_id' => 0,
                        'notes' => $fauna['notes'] ?? '',
                        'photos' => json_encode($photos),
                        'status' => Fauna::NOT_VALIDATED,
                        'record_status' => Fauna::RECORD_ACTIVE,
                        'created_at' => new Expression('UTC_TIMESTAMP'),
                        'updated_at' => new Expression('UTC_TIMESTAMP'),
                        'created_by' => $patrol->user_id,
                        'updated_by' => $patrol->user_id,
                    ];
                }, false);

                Fauna::batchInsert(array_values($faunas));
                $patrol->refresh();
                // FAUNAS::END

                $response['status'] = true;
                $response['trees'] = Tree::findAll(['patrol_id' => $patrol->id]);
                $response['faunas'] = Fauna::findAll(['patrol_id' => $patrol->id]);
                $response['patrol'] = $patrol;
            }
            else {
                $response['status'] = false;
                $response['error'] = $patrol->errors;
            }

            return $response;
        }
    }
}