<?php

namespace app\modules\api\v1\models\form;

use yii\db\Expression;
use yii\web\UploadedFile;
use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\Tree;
use app\modules\api\v1\models\Fauna;
use app\modules\api\v1\models\Patrol;
use app\modules\api\v1\models\EnvironmentalIncident;
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
    
    /* 
        array patrols =
            coordinates = [
                timestamp
            ],
            lastTimestamp,
            timestamp,
            watershed = '',
            distance = 0,
            total_time = 0,
            notes = '',
            photos = [],
            floras = [
                appId = '',
                common_name = '',
                kingdom = '',
                family = '',
                genus = '',
                species = '',
                sub_species = '',
                varieta_and_infra_var_name = '',
                growth_habit = '',
                conservation_status = '',
                diameter = '',
                date_encoded = '',
                description = '',
                latitude = '',
                longitude = '',
                notes = '',
            ],
    */
    public function sync()
    {
        if ($this->validate()) {
            $response = [];
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                foreach ($this->patrols as $patrolKey => $patrol) {
                    
                     if($patrol['coordinates']){
                        if(is_array($patrol['coordinates'])){
                            $coordinates=  $patrol['coordinates'];   
                        }else{
                            $coordinates=  json_decode($patrol['coordinates'],true);
                        }
                       
                        $coordinates_last = end($coordinates); 
                        $date_start= date('Y-m-d H:i:s', ($coordinates[0]['timestamp']/1000));
                        $date_end= date('Y-m-d H:i:s', ($coordinates_last['timestamp']/1000));
                        
                        $new_coordinates=null;
                        foreach($coordinates as $keyo=>$rowo){
                            if($rowo['lat'] && $rowo['lon']){
                               $new_coordinates[]=$rowo;
                            }
                        }
                        
                       $patrol['coordinates'] = $new_coordinates;
                    }
                    
                   // return $new_coordinates;
                    
                    if($patrol['lastTimestamp']){
                        $date_end=date('Y-m-d H:i:s', ($patrol['lastTimestamp']/1000));
                        $date_end= App::formatter()->asDateToTimezone($date_end, 'Y-m-d H:i:s');
                    }
                    if($patrol['timestamp']){
                       $date_start=date('Y-m-d H:i:s', ($patrol['timestamp']/1000));
                       $date_start=App::formatter()->asDateToTimezone($date_start, 'Y-m-d H:i:s');
                    }
                    
                   //return  $date_start;
                   //return $patrol['coordinates'];
                   
                    $offline_id=App::identity('id').$patrol['timestamp'];
 
                    $patrolModel = new Patrol([
                        'user_id' => App::identity('id'),
                        'offline_id'=>$offline_id,
                        'watershed' => $patrol['watershed'] ?? '',
                        'distance' => $patrol['distance'] ?? 0,
                        'total_time' => $patrol['total_time'] ?? 0,
                        'coordinates' => $patrol['coordinates'] ?? [],
                        'date' => App::formatter()->asDateToTimezone('', 'm/d/Y'),
                        'notes' => $patrol['notes'] ?? '',
                        'date_start'=>$date_start,
                        'date_end'=>$date_end,
                        'date'=>$date_start,
                        'barangay' => $patrol['barangay'],
                        'sitio' => $patrol['sitio'],
                    ]);
                    
                    $patrolModel_found =  Patrol::find()->andWhere(['offline_id'=>$offline_id])->one();
                    if($patrolModel_found){
                        continue;
                        //return $patrolModel_found->id;
                    }
                  
                    if ($patrolModel->save()) {
                        //added by jay
                        $photos=null;
                        $files = UploadedFile::getInstancesByName("patrols[{$patrolKey}][photos]");
                        foreach ($files as $fileKey => $fileInput) {
                            $uploadForm = new UploadForm([
                                'modelName' => 'Patrol',
                                'tag' => 'Patrol Proof',
                            ]);
                        
                            $uploadForm->fileInput =  $fileInput;
                            
                            if (($file = $uploadForm->upload()) != false) {
                                // $response['files'][$key][$file_key]['status'] = true;
                                // $response['files'][$key][$file_key]['fileInput'] = $fileInput;
                                // return $file->token;
                                // $response['files_token']=$file->token;
                                $photos[]=$file->token;
                            }else {
                                // $response['files'][$fileKey]['status'] = false;
                                // $response['files'][$fileKey]['fileInput'] = $uploadForm->fileInput;
                            }
                        }
        
                        if($photos){
                            $patrolModel->photos=json_encode($photos);
                            $patrolModel->save();  
                            $photos=null;
                        } 
                        //end added by jay
            
                        $patrolModel->refresh();

                        $this->getFloraForms([
                            'patrol' => $patrol,
                            'patrolKey' => $patrolKey,
                            'patrolModel' => $patrolModel,
                            'date_start' => $date_start,
                        ]);

                        $this->getFaunaForms([
                            'patrol' => $patrol,
                            'patrolKey' => $patrolKey,
                            'patrolModel' => $patrolModel,
                            'date_start' => $date_start,
                        ]);
                        
                        
                        
             if((int)$date_start && (int)$date_end){ // add patroll id
             
                $inviron_inc_all = EnvironmentalIncident::find()
               ->andWhere("(patrol_id is null or patrol_id=0)")
               ->andWhere(['between', 'date_time', $date_start, $date_end ])
               ->andWhere(['user_id'=>$patrolModel->user_id])
               ->all();
                 if($inviron_inc_all){
                 foreach($inviron_inc_all as $kn=>$inviron_inc)  { 
                     /*
                 $inviron_inc = EnvironmentalIncident::find()
               ->andWhere("(patrol_id is null or patrol_id=0)")
               ->andWhere(['between', 'date_time', $date_start, $date_end ])
               ->andWhere(['user_id'=>$patrolModel->user_id])
               ->one();
                 */
               
                  if($inviron_inc){
                  $inviron_inc->patrol_id=$patrolModel->id;
                  !$inviron_inc->sitio?$inviron_inc->sitio=$patrolModel->sitio:null;
                  !$inviron_inc->barangay?$inviron_inc->barangay=$patrolModel->barangay:null;
                   $inviron_inc->save();
                   }
                  }
                 
                }
                 
                 
                 
               }
                        
                        

                        $response['patrol'][$patrolKey] = $patrolModel;
                    }else {
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

    private function getFloraForms($params = []) /* 'patrol', 'patrolKey', 'patrolModel', 'date_start'  */
    {
        $floras = [];
        $counter = 0;
        foreach (($params['patrol']['floras'] ?? []) as $floraKey => $flora) {
            $counter++;
            // $photos = [];
            // foreach (Tree::PHOTO_KEYS as $categoryKey => $category) {
            //     $tokens = [];
            //     foreach (UploadedFile::getInstancesByName("patrols[{$params['patrolKey']}][floras][{$floraKey}][photos][{$categoryKey}]") as $fileKey => $fileInput) {
            //         $uploadForm = new UploadForm([
            //             'modelName' => 'Tree',
            //             'tag' => 'Tree',
            //         ]);
            //         $uploadForm->fileInput = $fileInput;

            //         if (($file = $uploadForm->upload()) != false) {
            //             $tokens[] = $file->token;
            //         }
            //     }

            //     $photos[$categoryKey] = $tokens ?: [null];
            // }
            
            $category_photos = [];
            $category_files = UploadedFile::getInstancesByName("patrols[{$params['patrolKey']}][floras][{$floraKey}][photos]");

            foreach ($category_files as $fileKey => $fileInput) {
                $uploadForm = new UploadForm([
                    'modelName' => 'Tree',
                    'tag' => 'Tree Proof',
                ]);
                
                $uploadForm->fileInput =  $fileInput;
                
                if (($file = $uploadForm->upload()) != false) {
                    $category_photos[]=$file->token;
                }else {
                    // $response['files'][$fileKey]['status'] = false;
                    // $response['files'][$fileKey]['fileInput'] = $uploadForm->fileInput;
                }
            }

            $floras[] = [
                'patroller_id' => $params['patrolModel']->user_id,
                'patrol_id' => $params['patrolModel']->id,
                'app_id' => $flora['appId'] ?? '',
                'common_name' => $flora['common_name'] ?? '',
                'kingdom' => $flora['kingdom'] ?? '',
                'family' => $flora['family'] ?? '',
                'genus' => $flora['genus'] ?? '',
                'species' => $flora['species'] ?? '',
                'sub_species' => $flora['sub_species'] ?? '',
                'varieta_and_infra_var_name' => $flora['varieta_and_infra_var_name'] ?? '',
                // 'taxonomic_group' => $flora['taxonomic_group'] ?? '',
                'growth_habit' => $flora['growth_habit'] ?? '',
                'category_id' => $flora['category_id'] ?? '',
                'conservation_status' => $flora['conservation_status'] ?? '',
                'diameter' => $flora['diameter'] ?? '',
                'date_encoded' => date('Y-m-d H:i:s', strtotime($flora['date_encoded'] ?? $params['date_start'])),
                'description' => $flora['description'] ?? '',
                'latitude' => $flora['latitude'] ?? '',
                'longitude' => $flora['longitude'] ?? '',
                'validated_by_id' => 0,
                'notes' => $flora['notes'] ?? '',
                'photos' => json_encode($category_photos),
                'status' => Tree::NOT_VALIDATED,
                'barangay' => $flora['barangay'],
                'sitio' => $flora['sitio'],
                'record_status' => Tree::RECORD_ACTIVE,
                'created_at' => new Expression('UTC_TIMESTAMP'),
                'updated_at' => new Expression('UTC_TIMESTAMP'),
                'created_by' => $params['patrolModel']->user_id,
                'updated_by' => $params['patrolModel']->user_id,
                'tree_id' => App::formatter()->setReferenceNo('Tree', ['initial_code' => '', 'field' => 'created_at', 'counter' => $params['patrolModel']->id.$counter]),
            ];
        }

        Tree::batchInsert(array_values($floras));
    }

    private function getFaunaForms($params = []) /* 'patrol', 'patrolKey', 'patrolModel', 'date_start'  */
    {
        $faunas = [];
        foreach (($params['patrol']['faunas'] ?? []) as $faunaKey => $fauna) {
            // $photos = [];
            // foreach (Fauna::PHOTO_KEYS as $categoryKey => $category) {
            //     $tokens = [];
            //     foreach (UploadedFile::getInstancesByName("patrols[{$params['patrolKey']}][faunas][{$faunaKey}][photos][{$categoryKey}]") as $fileKey => $fileInput) {
            //         $uploadForm = new UploadForm([
            //             'modelName' => 'Fauna',
            //             'tag' => 'Fauna',
            //         ]);
            //         $uploadForm->fileInput = $fileInput;

            //         if (($file = $uploadForm->upload()) != false) {
            //             $tokens[] = $file->token;
            //         }
            //     }

            //     $photos[$categoryKey] = $tokens ?: [null];
            // }
            
            $category_photos = [];
            $category_files = UploadedFile::getInstancesByName("patrols[{$params['patrolKey']}][faunas][{$faunaKey}][photos]");

            foreach ($category_files as $fileKey => $fileInput) {
                $uploadForm = new UploadForm([
                    'modelName' => 'Fauna',
                    'tag' => 'Fauna Proof',
                ]);
                
                $uploadForm->fileInput =  $fileInput;
                
                if (($file = $uploadForm->upload()) != false) {
                    $category_photos[]=$file->token;
                }else {
                    // $response['files'][$fileKey]['status'] = false;
                    // $response['files'][$fileKey]['fileInput'] = $uploadForm->fileInput;
                }
            }

            $faunas[] = [
                'patroller_id' => $params['patrolModel']->user_id,
                'patrol_id' => $params['patrolModel']->id,
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
                'date_encoded' => date('Y-m-d H:i:s', strtotime($fauna['date_encoded'] ?? $params['date_start'])),
                'description' => $fauna['description'] ?? '',
                'latitude' => $fauna['latitude'] ?? '',
                'longitude' => $fauna['longitude'] ?? '',
                'validated_by_id' => 0,
                'notes' => $fauna['notes'] ?? '',
                'photos' => json_encode($category_photos),
                'status' => Fauna::NOT_VALIDATED,
                'barangay' => $fauna['barangay'],
                'sitio' => $fauna['sitio'],
                'record_status' => Fauna::RECORD_ACTIVE,
                'created_at' => new Expression('UTC_TIMESTAMP'),
                'updated_at' => new Expression('UTC_TIMESTAMP'),
                'created_by' => $params['patrolModel']->user_id,
                'updated_by' => $params['patrolModel']->user_id,
            ];
        }

        Fauna::batchInsert(array_values($faunas));
    }
}