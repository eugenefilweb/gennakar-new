<?php

use app\helpers\Html;
use app\helpers\Url;
use app\models\search\DashboardSearch;
use app\widgets\ActiveForm;
use app\widgets\Autocomplete;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\File */

$this->title = 'Scholarship Management';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = new DashboardSearch(['searchLabel' => 'Scholarship']);
$this->params['showCreateButton'] = true; 
$this->params['activeMenuLink'] = '/dashboard/scholarship-management-list';
$this->params['wrapCard'] = false;
?>

<div>
	<div class="card card-custom gutter-b">
   <div class="card-body">
      <!--begin::Top-->
      <div class="d-flex">
         <!--begin::Pic-->
         <div class="flex-shrink-0 mr-7">
            <div class="symbol symbol-150 symbol-lg-150">
               <img alt="Pic" src="https://www.w3schools.com/howto/img_avatar.png">
            </div>
         </div>
         <!--end::Pic-->
         <!--begin: Info-->
         <div class="flex-grow-1">
            <!--begin::Title-->
            <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
               <!--begin::User-->
               <div class="mr-3">
                  <!--begin::Name-->
                  <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">Ana Thorne</a>
                  <!--end::Name-->
                  <!--begin::Contacts-->
                  <div class="d-flex flex-wrap my-2">
                     <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                        <i class="fa fa-calendar"></i>
                        01/20/1994
                     </a>
                     <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                           <!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg-->
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <mask fill="white">
                                    <use xlink:href="#path-1"></use>
                                 </mask>
                                 <g></g>
                                 <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"></path>
                              </g>
                           </svg>
                           <!--end::Svg Icon-->
                        </span>
                        IT
                     </a>
                     <a href="#" class="text-muted text-hover-primary font-weight-bold">
                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                           <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <rect x="0" y="0" width="24" height="24"></rect>
                                 <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"></path>
                              </g>
                           </svg>
                           <!--end::Svg Icon-->
                        </span>
                        Barangay Poblacion 1 Purok 2 Macaria 
                     </a>
                  </div>
                  <!--end::Contacts-->
               </div>
               <!--begin::User-->
               <!--begin::Actions-->
               <div class="my-lg-0 my-1">
                  <a href="#" class="btn btn-sm btn-primary font-weight-bolder mr-2">Personal Information</a>
                  <!-- <a href="#" class="btn btn-sm btn-light-success font-weight-bolder mr-2">Contact</a> -->
                  <a href="#" class="btn btn-sm btn-light-danger font-weight-bolder">Remove Scholarship</a>
               </div>
               <!--end::Actions-->
            </div>
            <!--end::Title-->
            <!--begin::Content-->
            <div class="d-flex align-items-center flex-wrap justify-content-between">
               <!--begin::Description-->
               <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                  <div class="row">
                     <div class="col-md-6">
                        <table>
                           <tbody>
                              <tr>
                                 <td>Email</td>
                                 <td>: main@email.com</td>
                              </tr>
                              <tr>
                                 <td>Alternate Email</td>
                                 <td>: alternate@email.com</td>
                              </tr>
                              <tr>
                                 <td>Contact No</td>
                                 <td>: 0956885487</td>
                              </tr>
                              <tr>
                                 <td>Alternate Contact No</td>
                                 <td>: 09683326524</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>   
                     <div class="col-md-6">
                        <table>
                           <tbody>
                              <tr>
                                 <td>House No</td>
                                 <td>: 456822</td>
                              </tr>
                              <tr>
                                 <td>Parent</td>
                                 <td>: Juan Dela Cruz</td>
                              </tr>

                              <tr>
                                 <td>First Enrollment</td>
                                 <td>: 2022</td>
                              </tr>
                              <tr>
                                 <td>Expected Graduation</td>
                                 <td>: 2016</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>   
                  </div>
               </div>
               <!--end::Description-->
               <!--begin::Progress-->
               <div class="d-flex mt-4 mt-sm-0">
                  <span class="font-weight-bold mr-4">Semester Progress</span>
                  <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
                     <div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="font-weight-bolder text-dark ml-4">78%</span>
               </div>
               <!--end::Progress-->
            </div>
            <!--end::Content-->
         </div>
         <!--end::Info-->
      </div>
      <!--end::Top-->
      <!--begin::Separator-->
      <div class="separator separator-solid my-7"></div>
      <!--end::Separator-->
      <!--begin::Bottom-->
      <div class="d-flex align-items-center flex-wrap">
         <!--begin: Item-->
         <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
            <span class="mr-4">
               <span class="svg-icon svg-icon-2x">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Dollar.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" opacity="0.3" x="11.5" y="2" width="2" height="4" rx="1"></rect>
                        <rect fill="#000000" opacity="0.3" x="11.5" y="16" width="2" height="5" rx="1"></rect>
                        <path d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z" fill="#000000"></path>
                     </g>
                  </svg>
                  <!--end::Svg Icon-->
               </span>
            </span>
            <div class="d-flex flex-column text-dark-75">
               <span class="font-weight-bolder font-size-sm">Year Level</span>
               <span class="font-weight-bolder font-size-h5">4th Year</span>
            </div>
         </div>
         <!--end: Item-->
         <!--begin: Item-->
         <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
            <span class="mr-4">
               <span class="svg-icon svg-icon-2x">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Sale2.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <polygon fill="#000000" opacity="0.3" points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168"></polygon>
                        <polygon fill="#000000" points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447"></polygon>
                        <path d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866" fill="#000000" opacity="0.3"></path>
                        <path d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z" fill="#000000" opacity="0.3"></path>
                     </g>
                  </svg>
                  <!--end::Svg Icon-->
               </span>
            </span>
            <div class="d-flex flex-column text-dark-75">
               <span class="font-weight-bolder font-size-sm">Course / Program</span>
               <span class="font-weight-bolder font-size-h5">BSIT</span>
            </div>
         </div>
         <!--end: Item-->
         <!--begin: Item-->
         <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
            <span class="mr-4">
               <span class="svg-icon svg-icon-2x">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-bar1.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"></rect>
                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"></rect>
                        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"></path>
                        <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"></rect>
                     </g>
                  </svg>
                  <!--end::Svg Icon-->
               </span>
            </span>
            <div class="d-flex flex-column text-dark-75">
               <span class="font-weight-bolder font-size-sm">School / Learning Center</span>
               <span class="font-weight-bolder font-size-h5">CAVSU Carmona</span>
            </div>
         </div>
         <!--end: Item-->
         <!--begin: Item-->
         <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
            <span class="mr-4">
               <span class="svg-icon svg-icon-2x">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Hummer.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M18.4246212,12.6464466 L21.2530483,9.81801948 C21.4483105,9.62275734 21.764893,9.62275734 21.9601551,9.81801948 L22.6672619,10.5251263 C22.862524,10.7203884 22.862524,11.0369709 22.6672619,11.232233 L19.8388348,14.0606602 C19.6435726,14.2559223 19.3269901,14.2559223 19.131728,14.0606602 L18.4246212,13.3535534 C18.2293591,13.1582912 18.2293591,12.8417088 18.4246212,12.6464466 Z M3.22182541,17.9497475 L13.1213203,8.05025253 C13.5118446,7.65972824 14.1450096,7.65972824 14.5355339,8.05025253 L15.9497475,9.46446609 C16.3402718,9.85499039 16.3402718,10.4881554 15.9497475,10.8786797 L6.05025253,20.7781746 C5.65972824,21.1686989 5.02656326,21.1686989 4.63603897,20.7781746 L3.22182541,19.363961 C2.83130112,18.9734367 2.83130112,18.3402718 3.22182541,17.9497475 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M12.3890873,1.28248558 L12.3890873,1.28248558 C15.150511,1.28248558 17.3890873,3.52106183 17.3890873,6.28248558 L17.3890873,10.7824856 C17.3890873,11.058628 17.1652297,11.2824856 16.8890873,11.2824856 L12.8890873,11.2824856 C12.6129449,11.2824856 12.3890873,11.058628 12.3890873,10.7824856 L12.3890873,1.28248558 Z" fill="#000000" transform="translate(14.889087, 6.282486) rotate(-45.000000) translate(-14.889087, -6.282486)"></path>
                     </g>
                  </svg>
                  <!--end::Svg Icon-->
               </span>
            </span>
            <div class="d-flex flex-column flex-lg-fill">
               <span class="text-dark-75 font-weight-bolder font-size-sm">Subject/s (10)</span>
               <a href="#" class="text-primary font-weight-bolder">View</a>
            </div>
         </div>
         <!--end: Item-->
         <!--begin: Item-->
         <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
            <span class="mr-4">
               <span class="svg-icon svg-icon-2x">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat2.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <polygon fill="#000000" opacity="0.3" points="5 15 3 21.5 9.5 19.5"></polygon>
                        <path d="M13.5,21 C8.25329488,21 4,16.7467051 4,11.5 C4,6.25329488 8.25329488,2 13.5,2 C18.7467051,2 23,6.25329488 23,11.5 C23,16.7467051 18.7467051,21 13.5,21 Z M9,8 C8.44771525,8 8,8.44771525 8,9 C8,9.55228475 8.44771525,10 9,10 L18,10 C18.5522847,10 19,9.55228475 19,9 C19,8.44771525 18.5522847,8 18,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 C8,13.5522847 8.44771525,14 9,14 L14,14 C14.5522847,14 15,13.5522847 15,13 C15,12.4477153 14.5522847,12 14,12 L9,12 Z" fill="#000000"></path>
                     </g>
                  </svg>
                  <!--end::Svg Icon-->
               </span>
            </span>
            <div class="d-flex flex-column">
               <span class="text-dark-75 font-weight-bolder font-size-sm">648 Units</span>
               <a href="#" class="text-primary font-weight-bolder">View</a>
            </div>
         </div>
         <!--end: Item-->
      </div>
      <!--end::Bottom-->
   </div>
</div>
<!--end::Nav Panels Wizard 4-->
<!--begin::Row-->
<div class="row">
   <div class="col-lg-8"></div>
   <div class="col-lg-4"></div>
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row">
   <div class="col-lg-4">
      <div class="card card-custom card-stretch gutter-b">
         <!--begin::Header-->
         <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
               <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Allowance History</span>
               <span class="text-muted mt-3 font-weight-bold font-size-lg">2022, First Semester</span>
            </h3>
            <div class="card-toolbar">
               <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                  <a href="#" class="btn btn-icon-primary btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span class="svg-icon svg-icon-lg">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Dots.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1">
                              <rect x="14" y="9" width="6" height="6" rx="3" fill="black"></rect>
                              <rect x="3" y="9" width="6" height="6" rx="3" fill="black" fill-opacity="0.7"></rect>
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </a>
               </div>
            </div>
         </div>
         <!--end::Header-->
         <!--begin::Body-->
         <div class="card-body pt-7">
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-wrap mb-6">
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">SEMESTER</a>
                  </div>
                  <!--begin::Label-->
                  <span class="text-dark-50 font-weight-bold font-size-lg d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">AMOUNT</a>
                  </span>
                  <span class="font-weight-bold font-size-lg text-dark-50"> 
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">DATE</a>
                  </span>
                  <!--end::Label-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->

            <!--begin::Item-->
            <div class="d-flex align-items-center flex-wrap mb-6">
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">3rd Semester</a>
                     <span class="text-muted font-weight-bold">Received</span>
                  </div>
                  <!--begin::Label-->
                  <span class="text-dark-50 font-weight-bold font-size-lg d-flex flex-column pr-5 flex-grow-1">P30,000</span>
                  <span class="font-weight-bold font-size-lg text-dark-50"> 11/27/20</span>
                  <!--end::Label-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">2nd Semester</a>
                     <span class="text-muted font-weight-bold">Received</span>
                  </div>
                  <!--begin::Label-->
                  <span class="text-dark-50 font-weight-bold font-size-lg d-flex flex-column pr-5 flex-grow-1">P30,000</span>
                  <span class="font-weight-bold font-size-lg text-dark-50"> 11/27/20</span>
                  <!--end::Label-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">1st Semester</a>
                     <span class="text-muted font-weight-bold">Received</span>
                  </div>
                  <!--begin::Label-->
                  <span class="text-dark-50 font-weight-bold font-size-lg d-flex flex-column pr-5 flex-grow-1">P30,000</span>
                  <span class="font-weight-bold font-size-lg text-dark-50"> 11/27/20</span>
                  <!--end::Label-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">3rd Semester</a>
                     <span class="text-muted font-weight-bold">Received</span>
                  </div>
                  <!--begin::Label-->
                  <span class="text-dark-50 font-weight-bold font-size-lg d-flex flex-column pr-5 flex-grow-1">P30,000</span>
                  <span class="font-weight-bold font-size-lg text-dark-50"> 11/27/20</span>
                  <!--end::Label-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">2nd Semester</a>
                     <span class="text-muted font-weight-bold">Received</span>
                  </div>
                  <!--begin::Label-->
                  <span class="text-dark-50 font-weight-bold font-size-lg d-flex flex-column pr-5 flex-grow-1">P30,000</span>
                  <span class="font-weight-bold font-size-lg text-dark-50"> 11/27/20</span>
                  <!--end::Label-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">1st Semester</a>
                     <span class="text-muted font-weight-bold">Received</span>
                  </div>
                  <!--begin::Label-->
                  <span class="text-dark-50 font-weight-bold font-size-lg d-flex flex-column pr-5 flex-grow-1">P30,000</span>
                  <span class="font-weight-bold font-size-lg text-dark-50"> 11/27/20</span>
                  <!--end::Label-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
         </div>
         <!--end::Body-->
      </div>
   </div>
   <div class="col-lg-4">
      <div class="card card-custom gutter-b card-stretch">
         <!--begin::Header-->
         <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
               <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Grades</span>
               <span class="text-muted mt-3 font-weight-bold font-size-lg">28 Subjects, 1.4 GPA</span>
            </h3>
            <div class="card-toolbar">
               <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                  <a href="#" class="btn btn-icon-primary btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span class="svg-icon svg-icon-lg">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Dots.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1">
                              <rect x="14" y="9" width="6" height="6" rx="3" fill="black"></rect>
                              <rect x="3" y="9" width="6" height="6" rx="3" fill="black" fill-opacity="0.7"></rect>
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </a>
               </div>
            </div>
         </div>
         <!--end::Header-->
         <!--begin::Body-->
         <div class="card-body">
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Text-->
               <div class="d-flex flex-column flex-grow-1 pr-3">
                  <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Accountancy</a>
                  <span class="text-muted font-weight-bold">2022, 1st Sem</span>
               </div>
               <!--end::Text-->
               <!--begin::Sparkline-->
               <div id="kt_mixed_widget_3_sparkline_1" class="mr-7"></div>
               <!--end::Sparkline-->
               <!--begin::label-->
               <div class="ml-1">
                  <span class="text-dark-75 font-size-lg font-weight-bolder d-block text-right">1.4</span>
                  <span class="label label-lg label-light-danger label-inline font-size-sm font-weight-bold">C-</span>
               </div>
               <!--end::label-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Text-->
               <div class="d-flex flex-column flex-grow-1 pr-3">
                  <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Architecture</a>
                  <span class="text-muted font-weight-bold">2022, 1st Sem</span>
               </div>
               <!--end::Text-->
               <!--begin::Sparkline-->
               <div id="kt_mixed_widget_3_sparkline_2" class="mr-7"></div>
               <!--end::Sparkline-->
               <!--begin::label-->
               <div class="">
                  <span class="text-dark-75 font-size-lg font-weight-bolder d-block text-right">1.7</span>
                  <span class="label label-lg label-light-success label-inline font-size-sm font-weight-bold">C-</span>
               </div>
               <!--end::label-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Text-->
               <div class="d-flex flex-column flex-grow-1 pr-3">
                  <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Business</a>
                  <span class="text-muted font-weight-bold">2022, 1st Sem</span>
               </div>
               <!--end::Text-->
               <!--begin::Sparkline-->
               <div id="kt_mixed_widget_3_sparkline_3" class="mr-7"></div>
               <!--end::Sparkline-->
               <!--begin::label-->
               <div class="">
                  <span class="text-dark-75 font-size-lg font-weight-bolder d-block text-right">1</span>
                  <span class="label label-lg label-light-info label-inline font-size-sm font-weight-bold">D</span>
               </div>
               <!--end::label-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Text-->
               <div class="d-flex flex-column flex-grow-1 pr-3">
                  <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Communications</a>
                  <span class="text-muted font-weight-bold">2022, 1st Sem</span>
               </div>
               <!--end::Text-->
               <!--begin::Sparkline-->
               <div id="kt_mixed_widget_3_sparkline_4" class="mr-7"></div>
               <!--end::Sparkline-->
               <!--begin::label-->
               <div class="">
                  <span class="text-dark-75 font-size-lg font-weight-bolder d-block text-right">1.75</span>
                  <span class="label label-lg label-light-danger label-inline font-size-sm font-weight-bold">C</span>
               </div>
               <!--end::label-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-6">
               <!--begin::Text-->
               <div class="d-flex flex-column flex-grow-1 pr-3">
                  <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Computer Science</a>
                  <span class="text-muted font-weight-bold">2022, 1st Sem</span>
               </div>
               <!--end::Text-->
               <!--begin::Sparkline-->
               <div id="kt_mixed_widget_3_sparkline_5" class="mr-11"></div>
               <!--end::Sparkline-->
               <!--begin::label-->
               <div class="">
                  <span class="text-dark-75 font-size-lg font-weight-bolder d-block text-right">1.25</span>
                  <span class="label label-lg label-light-primary label-inline font-size-sm font-weight-bold">D+</span>
               </div>
               <!--end::label-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center">
               <!--begin::Text-->
               <div class="d-flex flex-column flex-grow-1 pr-3">
                  <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Economics</a>
                  <span class="text-muted font-weight-bold">2022, 1st Sem</span>
               </div>
               <!--end::Text-->
               <!--begin::Sparkline-->
               <div id="kt_mixed_widget_3_sparkline_6" class="mr-7"></div>
               <!--end::Sparkline-->
               <!--begin::label-->
               <div class="">
                  <span class="text-dark-75 font-size-lg font-weight-bolder d-block text-right">1.35</span>
                  <span class="label label-lg label-light-warning label-inline font-size-sm font-weight-bold">D+</span>
               </div>
               <!--end::label-->
            </div>
            <!--end::Item-->
         </div>
         <!--end::Body-->
      </div>
   </div>
   <div class="col-xl-4">
      <!--begin::Mixed Widget 10-->
      <div class="card card-custom gutter-b card-stretch">
         <!--begin::Header-->
         <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
               <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Documents</span>
               <span class="text-muted mt-3 font-weight-bold font-size-lg">14 Total Files</span>
            </h3>
            <div class="card-toolbar">
               <a href="#" class="btn btn-sm btn-primary font-weight-bolder">All Files</a>
            </div>
         </div>
         <!--end::Header-->
         <!--begin::Body-->
         <div class="card-body pt-7">
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-8">
               <!--begin::Symbol-->
               <div class="symbol symbol-40 flex-shrink-0 mr-3">
                  <img alt="Pic" src="data:image/png;base64,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">
               </div>
               <!--end::Symbol-->
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Scholarship Application Form</a>
                     <span class="text-muted font-weight-bold">95 MB</span>
                  </div>
                  <!--end::Text-->
                  <!--begin::Dropdown-->
                  <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                     <a href="#" class="btn btn-icon-primary btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="ki ki-bold-more-hor"></i>
                     </a>
                  </div>
                  <!--end::Dropdown-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-8">
               <!--begin::Symbol-->
               <div class="symbol symbol-40 flex-shrink-0 mr-3">
                  <img alt="Pic" src="data:image/png;base64,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">
               </div>
               <!--end::Symbol-->
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Test Scores</a>
                     <span class="text-muted font-weight-bold">805 MB</span>
                  </div>
                  <!--end::Text-->
                  <!--begin::Dropdown-->
                  <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                     <a href="#" class="btn btn-icon-primary btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="ki ki-bold-more-hor"></i>
                     </a>
                  </div>
                  <!--end::Dropdown-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-8">
               <!--begin::Symbol-->
               <div class="symbol symbol-40 flex-shrink-0 mr-3">
                  <img alt="Pic" src="data:image/png;base64,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">
               </div>
               <!--end::Symbol-->
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Guardian ITR</a>
                     <span class="text-muted font-weight-bold">4 MB</span>
                  </div>
                  <!--end::Text-->
                  <!--begin::Dropdown-->
                  <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                     <a href="#" class="btn btn-icon-primary btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="ki ki-bold-more-hor"></i>
                     </a>
                  </div>
                  <!--end::Dropdown-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-2">
               <!--begin::Symbol-->
               <div class="symbol symbol-40 flex-shrink-0 mr-3">
                  <img alt="Pic" src="data:image/png;base64,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">
               </div>
               <!--end::Symbol-->
               <!--begin::Content-->
               <div class="d-flex align-items-center flex-row-fluid">
                  <!--begin::Text-->
                  <div class="d-flex flex-column pr-5 flex-grow-1">
                     <a href="#" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg">Report Card</a>
                     <span class="text-muted font-weight-bold">38 Kb</span>
                  </div>
                  <!--end::Text-->
                  <!--begin::Dropdown-->
                  <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                     <a href="#" class="btn btn-icon-primary btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="ki ki-bold-more-hor"></i>
                     </a>
                  </div>
                  <!--end::Dropdown-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Item-->
         </div>
         <!--end::Body-->
         <!--begin::Footer-->
         <div class="card-footer d-flex align-items-center p-0 border-0">
            
            <div class="position-absolute text-center left-0 right-0" style="bottom: 20px;">
               <a href="#">
                  <svg width="41" height="31" viewBox="0 0 41 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M33.3125 15.1851L33.0511 15.2105C33.2202 14.3854 33.3125 13.5299 33.3125 12.6543C33.3125 5.66662 27.5776 0 20.5 0C13.425 0 7.68754 5.66662 7.68754 12.6543L7.70036 12.7808C3.35429 13.3933 0 17.0479 0 21.5123C0 26.407 4.01542 30.3704 8.96877 30.3704H15.3955C16.7997 30.3704 17.9375 29.2492 17.9375 27.8598V20.2469H12.4999L20.5 10.1234L28.5001 20.2469H23.0625V27.8598C23.0625 29.2492 24.1978 30.3704 25.6045 30.3704H33.3125C37.5586 30.3704 41 26.9714 41 22.7778C41 18.5842 37.5586 15.1851 33.3125 15.1851Z" fill="#3E97FF"></path>
                  </svg>
               </a>
               <span class="font-weight-bold text-primary d-block pt-2">Drag files here</span>
            </div>
         </div>
         <!--end::Footer-->
      </div>
      <!--end::Mixed Widget 10-->
   </div>
</div>

</div>