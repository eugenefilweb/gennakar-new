<?php

use app\helpers\App;
?>

<div class="text-dark-50 line-height-lg">
    <div class="accordion accordion-toggle-arrow" id="accordion-passengers">
        <?= App::foreach($model->passengers, function($passenger, $index, $counter) {
            return <<< HTML
                <div class="card">
                    <div class="card-header">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-passenger-{$index}" aria-expanded="false">
                            PASSENGER {$counter}: {$passenger->fullname} ({$passenger->age})
                        </div>
                    </div>
                    <div id="collapse-passenger-{$index}" class="collapse" data-parent="#accordion-passengers" style="">
                        <div class="card-body">
                            <table class="mb-7" border="1">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="th-header"> VEHICLES DETAILS </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> {$passenger->driverPlateNo} </td>
                                    </tr>
                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> PASSENGER DETAILS </th>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('fullname')}</th>
                                        <td>{$passenger->fullname}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('sex')}</th>
                                        <td>{$passenger->sexLabel}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('age')}</th>
                                        <td>{$passenger->age}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('address')}</th>
                                        <td>{$passenger->address}</td>
                                    </tr>

                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header">CONTACT DETAILS</th>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('email')}</th>
                                        <td>{$passenger->email}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('contact_no')}</th>
                                        <td>{$passenger->contact_no}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('alternate_contact_no')}</th>
                                        <td>{$passenger->alternate_contact_no}</td>
                                    </tr>

                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header">HEALTH DETAILS</th>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('health_condition')}</th>
                                        <td>{$passenger->health_condition}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('medical_complaint')}</th>
                                        <td>{$passenger->medical_complaint}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('condition')}</th>
                                        <td>{$passenger->conditionLabel}</td>
                                    </tr>

                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header">REMARKS/OBSERVATION</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">{$passenger->observation} </td>
                                    </tr>

                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header">OTHER DETAILS</th>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('preferred_by')}</th>
                                        <td>{$passenger->preferred_by}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('noted_by')}</th>
                                        <td>{$passenger->noted_by}</td>
                                    </tr>
                                    <tr>
                                        <th>{$passenger->getAttributeLabel('date')}</th>
                                        <td>{$passenger->date}</td>
                                    </tr>

                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header">Statement</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">{$passenger->statement} </td>
                                    </tr>
                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> SIGNAture </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> 
                                            <img src="{$passenger->signature}" class="img-fluid symbol">
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