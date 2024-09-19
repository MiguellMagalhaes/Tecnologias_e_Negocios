<?php
@session_start();

// Originally made by: Gonçalo Silva Coval

if($_SERVER['HTTP_HOST'] == '') {
    
    $arrSETTINGS['dir_site'] = '';
    $arrSETTINGS['url_site'] = '';
    $arrSETTINGS['dir_site_adm'] = '';
    $arrSETTINGS['url_site_adm'] = '';

    // definições de variáveis para ligar ao servidor MYSQL
    $arrSETTINGS['hostname'] = 'localhost';
    $arrSETTINGS['username'] = '';
    $arrSETTINGS['password'] = '';
    $arrSETTINGS['database'] = '';

} else {

    $arrSETTINGS['dir_site'] = 'Applications/XAMPP/xamppfiles/htdocs/BOT';
    $arrSETTINGS['url_site'] = 'http://localhost/BOT';
    $arrSETTINGS['dir_site_adm'] = '';
    $arrSETTINGS['url_site_adm'] = '';
    

    // definições de variáveis para ligar ao servidor MYSQL
    $arrSETTINGS['hostname'] = 'localhost';
    $arrSETTINGS['username'] = 'root';
    $arrSETTINGS['password'] = '';
    $arrSETTINGS['database'] = 'BOT';
}

?>
