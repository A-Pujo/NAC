<?php


function md($model){
    switch($model){
        case 'cfp':
            return  new \App\Models\M_Nilai_CFP();
        case 'sma':
            return new \App\Models\M_Nilai_Acc_Sma();
        case 'univ':
            return new \App\Models\M_Nilai_Acc_Univ();
        case 'bio':
            return new \App\Models\M_Data_Main_Round();
        case 'webinar':
            return new \App\Models\M_Webinar();
        case 'kursus':
            return new \App\Models\M_Peserta_Kursus();
        default:
            dd('invalid argumen md');
    }
}