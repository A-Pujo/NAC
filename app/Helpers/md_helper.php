<?php


function md($model){
    switch($model){
        case 'cfp':
            return  new \App\Models\M_Nilai_CFP();
        case 'sma':
            return new \App\Models\M_Nilai_Acc_Sma();
        default:
            dd('invalid argumen');
    }
}