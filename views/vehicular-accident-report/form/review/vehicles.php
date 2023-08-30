<?php

use app\helpers\App;
?>

<div class="text-dark-50 line-height-lg">
    <div class="accordion accordion-toggle-arrow" id="accordion-vehicles">
        <?= App::foreach($model->vehicles, function($vehicle, $index, $counter) {
            return <<< HTML
                <div class="card">
                    <div class="card-header">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-vehicle-{$index}" aria-expanded="false">
                            VEHICLE {$counter}: {$vehicle->driverName} ({$vehicle->class} - {$vehicle->plate_no})
                        </div>
                    </div>
                    <div id="collapse-vehicle-{$index}" class="collapse" data-parent="#accordion-vehicles" style="">
                        <div class="card-body">
                            <table class="mb-7" border="1">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="th-header"> DRIVER DETAILS </th>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('driverFullname')}</th>
                                        <td>{$vehicle->driverFullname}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('driver_address')}</th>
                                        <td>{$vehicle->driver_address}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('driver_email')}</th>
                                        <td>{$vehicle->driver_email}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('driver_contact_no')}</th>
                                        <td>{$vehicle->driver_contact_no}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('driver_alt_contact_no')}</th>
                                        <td>{$vehicle->driver_alt_contact_no}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('driver_license_front')}</th>
                                        <td>
                                            <a target="_blank" href="{$vehicle->getFileViewerUrl($vehicle->driver_license_front)}">
                                                <img src="{$vehicle->licensePhotoFrontUrl}" class="img-fluid symbol">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('driver_license_back')}</th>
                                        <td>
                                            <a target="_blank" href="{$vehicle->getFileViewerUrl($vehicle->driver_license_back)}">
                                                <img src="{$vehicle->licensePhotoBackUrl}" class="img-fluid symbol">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> VEHICLE DETAILS </th>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('plate_no')}</th>
                                        <td>{$vehicle->plate_no}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('class')}</th>
                                        <td>{$vehicle->class}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('color')}</th>
                                        <td>{$vehicle->color}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('make')}</th>
                                        <td>{$vehicle->make}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('model')}</th>
                                        <td>{$vehicle->model}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('year')}</th>
                                        <td>{$vehicle->year}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('type_of_cargo')}</th>
                                        <td>{$vehicle->type_of_cargo}</td>
                                    </tr>
                                    <tr>
                                        <th>total passengers</th>
                                        <td>{$vehicle->getTotalPassengers(true)}</td>
                                    </tr>
                                    
                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> insurance </th>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('insurance_company')}</th>
                                        <td>{$vehicle->insurance_company}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('insurance_type')}</th>
                                        <td>{$vehicle->insurance_type}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('insurance_status')}</th>
                                        <td>{$vehicle->insuranceStatusLabel}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('coverage_start_date')}</th>
                                        <td>{$vehicle->coverage_start_date}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('coverage_end_date')}</th>
                                        <td>{$vehicle->coverage_end_date}</td>
                                    </tr>
                                    

                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> official receipt (or) </th>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('or_no')}</th>
                                        <td>{$vehicle->or_no}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('or_no_date_issued')}</th>
                                        <td>{$vehicle->or_no_date_issued}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('or_photo')}</th>
                                        <td>
                                            <a target="_blank" href="{$vehicle->getFileViewerUrl($vehicle->or_photo)}">
                                                <img src="{$vehicle->orPhotoUrl}" class="img-fluid symbol">
                                            </a>
                                        </td>
                                    </tr>
                                   
                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> certificate of registration (cr) </th>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('cr_no')}</th>
                                        <td>{$vehicle->cr_no}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('cr_no_date_issued')}</th>
                                        <td>{$vehicle->cr_no_date_issued}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('cr_photo')}</th>
                                        <td>
                                            <a target="_blank" href="{$vehicle->getFileViewerUrl($vehicle->cr_photo)}">
                                                <img src="{$vehicle->crPhotoUrl}" class="img-fluid symbol">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> COMMERCIAL VEHICLE / COMPANY </th>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('is_commercial')}</th>
                                        <td>{$vehicle->isCommercialLabel}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('company_name')}</th>
                                        <td>{$vehicle->company_name}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('company_contact_no')}</th>
                                        <td>{$vehicle->company_contact_no}</td>
                                    </tr>
                                    <tr>
                                        <th>{$vehicle->getAttributeLabel('company_address')}</th>
                                        <td>{$vehicle->company_address}</td>
                                    </tr>

                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> STATEMENT </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> {$vehicle->statement} </td>
                                    </tr>

                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> SIGNAture </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> 
                                            <img src="{$vehicle->signature}" class="img-fluid symbol">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            HTML;
        }) ?>
    </div>
</div>