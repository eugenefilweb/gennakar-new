<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\Vehicle;
?>

<div class="p-h1p2rem"></div>
    
<table width="100%">
    <tbody>
        <tr>
            <td class="text-center td-header font-weight-bolder p-btcb"> VEHICLE #<?= $counter ?> </td>
            <td class="text-center td-header p-btcb p-bbcb" colspan="3"> License Plate Number </td>
            <td class="text-center" colspan="2"><?= $vehicle->plate_no ?></td>
        </tr>
 

        <tr>
            <td width="25%" class="text-center td-header" rowspan="2">Driver <?= $counter ?> Full Name</td>
            <td width="25%" class="text-center font-weight-bold">Surname</td>
            <td class="text-center font-weight-bold" colspan="2">First Name</td>
            <td width="15%" class="text-center font-weight-bold">Middle Name</td>
            <td width="10%" class="text-center font-weight-bold">Suffix</td>
        </tr>

        <tr>
            <td class="text-center"><?= $vehicle->driver_lastname ?></td>
            <td class="text-center" colspan="2"><?= $vehicle->driver_firstname ?></td>
            <td class="text-center"><?= $vehicle->driver_middlename ?></td>
            <td class="text-center"><?= $vehicle->driver_suffix ?></td>
        </tr>

        <tr>
            <td class="text-center td-header">Driver <?= $counter ?> Complete Address</td>
            <td class="text-center" colspan="5"><?= $vehicle->driver_address ?> </td>
        </tr>
        <tr>
            <td class="text-center td-header">Driver <?= $counter ?> Email Address</td>
            <td class="text-center" colspan="5"><?= $vehicle->driver_email ?> </td>
        </tr>
        <tr>
            <td class="text-center td-header">Contact Number</td>
            <td class="text-center"><?= $vehicle->driver_contact_no ?></td>
            <td class="text-center" colspan="2">Alternate Contact Number</td>
            <td class="text-center" colspan="2"><?= $vehicle->driver_alt_contact_no ?></td>
        </tr>
        <tr>
            <td class="text-center td-header">Vehicle Class </td>
            <td class="text-center"><?= $vehicle->class ?></td>
            <td class="text-center" colspan="2">Vehicle Color</td>
            <td class="text-center" colspan="2"><?= $vehicle->color ?></td>
        </tr>
        <tr>
            <td class="text-center td-header">Vehicle Make</td>
            <td class="text-center" colspan="5"><?= $vehicle->make ?> </td>
        </tr>
        <tr>
            <td class="text-center td-header">Vehicle Model and Year</td>
            <td class="text-center" colspan="5"><?= $vehicle->model ?> / <?= $vehicle->year ?> </td>
        </tr>
        <tr>
            <td class="text-center td-optional-header">Is vehicle <?= $counter ?> a commercial vehicle?</td>
            <td class="text-center"><?= $vehicle->isCommercialLabel ?></td>
            <td class="text-center td-optional-header p-bc-black" colspan="2">Company Name/Business name </td>
            <td class="text-center" colspan="2"><?= $vehicle->company_name ?></td>
        </tr>
        <tr>
            <td class="text-center td-optional-header">Company Complete Address</td>
            <td class="text-center" colspan="5"><?= $vehicle->company_address ?> </td>
        </tr>
        <tr>
            <td class="text-center td-optional-header">Company Contact Number</td>
            <td class="text-center"><?= $vehicle->company_contact_no ?></td>
            <td class="text-center td-optional-header p-bc-black" colspan="2">Type of Cargo (if applicable) </td>
            <td class="text-center" colspan="2"><?= $vehicle->type_of_cargo ?></td>
        </tr>
        <tr>
            <td class="text-center td-header">OR No.</td>
            <td class="text-center"><?= $vehicle->or_no ?></td>
            <td class="text-center td-header" colspan="2">Date Issued</td>
            <td class="text-center" colspan="2"><?= $vehicle->or_no_date_issued ?></td>
        </tr>
        <tr>
            <td class="text-center td-header">CR No.</td>
            <td class="text-center"><?= $vehicle->cr_no ?></td>
            <td class="text-center td-header p-bbcb" colspan="2">Date Issued</td>
            <td class="text-center" colspan="2"><?= $vehicle->cr_no_date_issued ?></td>
        </tr>
        <tr>
            <td class="text-center td-header">Insurance Company</td>
            <td class="text-center" colspan="5"><?= $vehicle->insurance_company ?> </td>
        </tr>
        <tr>
            <td class="text-center td-header p-bbcb p-brw" colspan="2">Insurance Type </td>
            <td class="text-center td-header p-bbcb" colspan="4">Period of Coverage</td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "insurance_type[{$counter}]", '', [
                            'checked' => trim($vehicle->insurance_type) == $vehicle->getParamInsuranceType(0)
                        ]) ?>
                        <span></span><?= $vehicle->getParamInsuranceType(0) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "insurance_type[{$counter}]", '', [
                            'checked' => trim($vehicle->insurance_type) == $vehicle->getParamInsuranceType(1)
                        ]) ?>
                        <span></span><?= $vehicle->getParamInsuranceType(1) ?>
                    </label>
                </div>
            </td> 
            <td class="text-center" colspan="2">
                Start Date: <?= $vehicle->coverage_start_date ?>
            </td>
            <td class="text-center" colspan="2">End Date: <?= $vehicle->coverage_end_date ?></td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "insurance_type[{$counter}]", '', [
                            'checked' => trim($vehicle->insurance_type) == $vehicle->getParamInsuranceType(2)
                        ]) ?>
                        <span></span><?= $vehicle->getParamInsuranceType(2) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "insurance_type[{$counter}]", '', [
                            'checked' => trim($vehicle->insurance_type) == $vehicle->getParamInsuranceType(3)
                        ]) ?>
                        <span></span><?= $vehicle->getParamInsuranceType(3) ?>
                    </label>
                </div>
            </td>
            <td class="text-center font-weight-bold" colspan="4">Insurance Status</td>
        </tr>
        <tr>
            <td colspan="2">Others (specify): <span class=""><?= $vehicle->otherInsuranceType ?></span></td>
            <td class="text-center" colspan="2">
                <div class="radio-list text-success">
                    <label class="radio m-auto">
                        <input type="radio" <?= $vehicle->getCheckedInsurance(Vehicle::INSURANCE_COVERED) ?> name="insurance_type_status[<?= $vehicle->id ?>]">
                        <span></span>Covered
                    </label>
                </div>
            </td>
            <td class="text-center" colspan="2">
                <div class="radio-list text-danger">
                    <label class="radio m-auto">
                        <input type="radio" <?= $vehicle->getCheckedInsurance(Vehicle::INSURANCE_EXPIRED) ?> name="insurance_type_status[<?= $vehicle->id ?>]">
                        <span></span>Expired
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center td-header p-bbcb p-brw" colspan="3">Name of Passenger(s) </td>
            <td class="text-center td-header p-bbcb p-brw">Age</td>
            <td class="text-center td-header p-bbcb p-brw">Sex</td>
            <td class="text-center td-header p-bbcb">Status</td>
        </tr>
        <?= App::foreach($vehicle->passengerModels, fn ($passenger) => <<< HTML
            <tr>
                <td class="text-center" colspan="3"> {$passenger->fullname}</td>
                <td width="10%" class="text-center">{$passenger->age}</td>
                <td class="text-center">{$passenger->sexLabel}</td>
                <td class="text-center">{$passenger->conditionLabel}</td>
            </tr>
        HTML) ?>
    </tbody>
</table>
<!-- <div class="page-break"> </div> -->
