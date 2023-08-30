<?php

use app\helpers\App;
?>

<div class="text-dark-50 line-height-lg">
    <div class="accordion accordion-toggle-arrow" id="accordion-statements">
        <?= App::foreach($model->statements, function($statement, $index, $counter) {
            return <<< HTML
                <div class="card">
                    <div class="card-header">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse-statement-{$index}" aria-expanded="false">
                            STATEMENT {$counter}: {$statement->formattedName} ({$statement->typeLabel})
                        </div>
                    </div>
                    <div id="collapse-statement-{$index}" class="collapse" data-parent="#accordion-statements" style="">
                        <div class="card-body">
                            <table class="mb-7" border="1">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="th-header"> MAIN DETAILS </th>
                                    </tr>
                                    <tr>
                                        <th>{$statement->getAttributeLabel('date')}</th>
                                        <td>{$statement->date}</td>
                                    </tr>
                                    <tr>
                                        <th>{$statement->getAttributeLabel('type')}</th>
                                        <td>{$statement->typeLabel}</td>
                                    </tr>
                                    <tr>
                                        <th>{$statement->getAttributeLabel('name')}</th>
                                        <td>{$statement->name}</td>
                                    </tr>
                                    <tr>
                                        <th>{$statement->getAttributeLabel('position')}</th>
                                        <td>{$statement->position}</td>
                                    </tr>
                                    <tr>
                                        <th>{$statement->getAttributeLabel('address')}</th>
                                        <td>{$statement->address}</td>
                                    </tr>
                                    <tr>
                                        <th>{$statement->getAttributeLabel('contact_info')}</th>
                                        <td>{$statement->contact_info}</td>
                                    </tr>
                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header">Statement</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">{$statement->statement} </td>
                                    </tr>
                                    <tr border="0"> <td colspan="2" class="border-separator"></td> </tr>
                                    <tr>
                                        <th colspan="2" class="th-header"> SIGNAture </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> 
                                            <img src="{$statement->signature}" class="img-fluid symbol">
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