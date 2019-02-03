<?php
/**
 * Created by PhpStorm.
 * User: Muharrem
 * Date: 3.02.2019
 * Time: 12:02
 */

if(!empty($_POST['tcNo'])){

    $tc        = $_POST['tcNo'];
    $ad        = $_POST['ad'];
    $soyad     = $_POST['soyad'];
    $DogumYili = $_POST['DogumYili'];

    function turkce_karakter($karakter){

        $karakter = str_replace("i", "İ", $karakter);
        /*$karakter = str_replace("I", "ı", $karakter);*/

        $karakter = mb_convert_case($karakter,MB_CASE_UPPER,"UTF-8");

        return $karakter;

    }
    
    $ad = turkce_karakter($ad);
    $soyad =  turkce_karakter($soyad);
    

    $client = new SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');
    $sonuc = $client->TcKimlikNoDogrula(array(
        'TCKimlikNo' => $tc,
        'Ad' => $ad,
        'Soyad' => $soyad,
        'DogumYili' => $DogumYili
    ));

    
    if($sonuc->TCKimlikNoDogrulaResult){
        echo 'TC Kimlik Numarası Doğru';
    }else{
        echo 'TC Kimlik Numarası Geçersiz';
    }
}else{
    echo 'Boş Alan var';
}

?>