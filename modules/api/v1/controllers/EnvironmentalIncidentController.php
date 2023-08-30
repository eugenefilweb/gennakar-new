<?php

namespace app\modules\api\v1\controllers;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\form\UploadForm;
use app\modules\api\v1\models\EnvironmentalIncident;

class EnvironmentalIncidentController extends ActiveController
{
    public $modelClass = 'app\modules\api\v1\models\EnvironmentalIncident';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'environmental-incident',
    ];
    
    
    
    public function actionSubmit()
    {
      //return $_FILES; //App::post();
      
       
       
       $data = App::post();
       
       if(!$data){
           return [
                'status' => false,
                'message' => 'Invalid request, please use Post method',
                'error' => 'Request',
            ];
       }
        
        try {
            
             $model = new EnvironmentalIncident();
             
             //return Yii::$app->user->identity->id;
             
              $incidents = App::params('incidents');
              $incidents = $incidents?ArrayHelper::index($incidents, 'id'):[];
              
               $incidents_type = $data['incident'] && ($incidents_type = $incidents[$data['incident']]['incident_type']) ?ArrayHelper::index($incidents_type, 'id'):[];
              //mapParams
              
             //return $incidents_type;
        
              $model->user_id = Yii::$app->user->identity->id; //$data['user_id']?:1;
              $model->date_time = (int)$data['date_time']?date('Y-m-d H:i:s', strtotime($data['date_time']) ):App::component('Formatter')->asDateToTimezone('', $format='Y-m-d H:i:s', $timezone="");
              $model->incident=$data['incident'];
              $model->incident_type=$data['incident_type'];
              $model->longitude = $data['longitude'];
              $model->latitude = $data['latitude'];
              $model->watershed = $data['watershed'];
              $model->description = $data['description']?:$incidents[$data['incident']]['label'];
              $model->additional_details =$data['additional_details']?:$incidents[$data['incident']]['label'].($x=$incidents_type[$data['incident_type']]['label']?' - '.$x:null);
              $model->record_status=1;
             //$model->photos' = 'Photos',
                
              // return   $model->date_time; 
                 
              if ($model->validate()) {
                 if($model->save()){ 
                          $photos=null;
                          
                         $files = UploadedFile::getInstancesByName("photos");
                          
                          foreach ($files as $fileKey => $fileInput) {
                              
                              $uploadForm = new UploadForm([
                                    'modelName' => 'EnvironmentalIncident',
                                    'tag' => 'Environmental Incident',
                                ]);
                             
                             $uploadForm->fileInput =  $fileInput;
                             
                             if (($file = $uploadForm->upload()) != false) {
                                  //  $response['files'][$key][$file_key]['status'] = true;
                                    //$response['files'][$key][$file_key]['fileInput'] = $fileInput;
                                   // return $file->token;
                                    //$response['files_token']=$file->token;
                                    $photos[]=$file->token;
                                }
                                else {
                                    $response['files'][$key][$file_key]['status'] = false;
                                    $response['files'][$key][$file_key]['fileInput'] = $uploadForm->fileInput;
                                }
                             
                             
                          }
                          
                          
                      
                         if($photos){
                            $model->photos=json_encode($photos);
                            $model->save();  
                          } 
           
                     $response['incedent'] = $model;
                     return $response; 
                 }   
              }else{     
                return $model->errors; 
              }
                 
            
        } catch (\yii\base\ErrorException $e) {

            return [
                'status' => false,
                'message' => $e->getMessage(),
                'error' => $e,
            ];
        }
    }
    
    
    
}