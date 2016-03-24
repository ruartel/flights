<?php
require 'simplehtmldom_1_5/simple_html_dom.php';

$opts = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n" .
            "Cookie: w_locale=en_US\r\n"
    )
);

$context = stream_context_create($opts);
$homepage = file_get_contents('http://flightaware.com/live/airport/LLBG/arrivals?;offset=0;order=actualarrivaltime;sort=DESC',false,$context);
//$homepage = file_get_contents('http://www.iaa.gov.il/en-US/airports/bengurion/Pages/OnlineFlights.aspx?mode=in',false,$context);
//echo $homepage;
//die();
$d = new DOMDocument();
$d->loadHTML($homepage);

$html_temp = $d->saveHTML();

$html = str_get_html($html_temp);
//$ret = $html->find('table[class=prettyTable]');
$homepage2 = file_get_contents('http://flightaware.com/live/airport/LLBG/departures',false,$context);
$d2 = new DOMDocument();
$d2->loadHTML($homepage2);

$html_temp2 = $d2->saveHTML();

$html2 = str_get_html($html_temp2);
?>
        th{height: 35px;}
        .fixed{
        top:0;
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style>
        .toHide{display: none;}
        body{padding: 0; margin: 0; font-family: Arial; font-size: 16px;text-align: left;background-color: #CDE0FC;}
        .resultSubTitle{display: none;}
        .advanced.noTop{display: none;}
        .waitMsg{width: 100%;}
        .page_wp img{max-width: 82px;max-height: 45px;font-size: 85%;}
        .page_wp{width: 100%; display: flex;position: relative;}
        .side{width: 50%; padding: 0 2%;}
        .title_p{font-size: 200%;font-weight: bold;text-align: center;font-family: Helvetia;width: 50%;}
        .element_to_pop_up_wait{display: none;}
        .resultSubTitle{font-family: Verdana;font-size: 60%;}
        #board1 th.no-sort {
            background: -o-linear-gradient(bottom, #051A5F 5%, #03196D 100%);
            background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #051A5F), color-stop(1, #03196D) );
            background: -moz-linear-gradient( center top, #051A5F 5%, #03196D 100% );
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#051A5F", endColorstr="#03196D");
            background: -o-linear-gradient(top,#051A5F,03196D);
            background-color: #051A5F;
            color: #FFF;
            text-align: center;
            width: 15%;
        }
        #board2 th.no-sort {
            background: -o-linear-gradient(bottom, #051A5F 5%, #03196D 100%);
            background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #051A5F), color-stop(1, #03196D) );
            background: -moz-linear-gradient( center top, #051A5F 5%, #03196D 100% );
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#051A5F", endColorstr="#03196D");
            background: -o-linear-gradient(top,#051A5F,03196D);
            background-color: #051A5F;
            color: #FFF;
            text-align: center;
            width: 15%;
        }
        td{background-color: #FAFAFA; border-bottom: 1px solid #000;height: 45px; font-size: 95%;}
        table {
            border-spacing: 0px;
            border-collapse: separate;
            border: 4px double #AFADAD;
        }
        .flightIcons{background-color: #FFF;}
        .top_img{position: fixed;top:0;left: 0;width: 100%;z-index: 1;}
        #airIMG{width: 100%;}
        .titles_wp{
            display: flex;
            background-color: #CDE0FC;
            margin-top: -5px;
            padding-bottom: 4px;
            border-bottom: 2px solid #FFF;
        }
        #board1 thead{position: fixed;width: 45.5%;margin-top: -4px;}
        #board2 thead{position: fixed;width: 45.5%;margin-top: -4px;}
        label {font-size: 90%;}
        position:fixed;
            width:auto;
            display:none;
            border:none;
        }
        .scrollMore{
            margin-top:600px;
        }

        footer{
            position: fixed;
            bottom: 0;
            left: 0;
            background-color: #CDE0FC;
            border-top: 2px solid #FFF;
            height: 25px;
            font-size: 90%;
            width: 100%;
            text-align: center;
            font-family: verdana;
            padding-top: 5px;
        }
        #board1 .thFlight{width: 15%;}
        #board1 .flightIcons{width: 15%;}
        #board1 .infoIcon{width: 3%;}
        #board1 .FlightNum{width: 11%;}
        #board1 .FlightFrom{width: 16%;}
        #board1 .FlightTime{width: 15%;}
        #board1 .finalTime{width: 10%;}
        #board1 .localTerminal{width: 8%;}
        #board1 .status{width: 10%;}

        #board2 .thFlight{width: 13%;}
        #board2 .divSortTable {display: block;width: 10%;}
        #board2 .divSortTable[data-sortexpression='DestinationName1'] {width: 102%;}
        #board2 .divSortTable[data-sortexpression='Counter'] {display: none;}
        #board2 .divSortTable[data-sortexpression='CounterArea'] {display: none;}
        #board2 .flightIcons{width: 15%;}
        #board2 .infoIcon{width: 3%;}
        #board2 .landFlightNum{width: 16%;}
        #board2 .FlightTo{width: 16%;}
        #board2 .LandTime{width: 10%;}
        #board2 .finalLandTime{width: 10%;}
        #board2 .localLandTerminal{width: 8%;}
        #board2 .localCounter{display: none;}
        #board2 .localArea{display: none;}
        #board2 .localWheather{width: 5%;}
        #board2 .status{width: 10%;}
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        var LastPageHeight = 0;
        $(document).ready( function ()
        {
            setInterval(function () {
                var iScroll = $(window).scrollTop();
                iScroll = iScroll + 200;
                var startAgain = false;
                if(LastPageHeight < iScroll){
                    LastPageHeight = iScroll;
                }else if(LastPageHeight == iScroll){
                    startAgain=true;
                }
                if(!startAgain){
                    $('html, body').animate({
                        scrollTop: iScroll
                    }, 1000);
                }else{
                    $('html, body').animate({
                        scrollTop: 0
                    }, 0);
                }
            }, 5000);

            setTimeout(function(){
                ch = jQuery(".top_img").height();
                jQuery(".page_wp").css("top", ch + "px");
            }, 1500);
            setInterval("location.reload(true)", 300000);
        } );
    </script>

</head>
<body>
<div class="top_img">
    <img src="airport3.jpg" id="airIMG" >
    <div class="titles_wp">
        <div class="title_p">Arrivals</div>
        <div class="title_p">Departures</div>
    </div>
</div>
<div class="page_wp">
    <div class="side left">
        <?php
        foreach($html->find('table[class=prettyTable]') as $element){
            echo $element->outertext;
        }
        ?>
    </div>
    <div class="side right">
        <?php
        foreach($html2->find('table[class=prettyTable]') as $element){
            echo $element->outertext;
        }
        ?>
    </div>
</div>
<footer>
    •מערכות מידע ופתוח משאבים     •    © 2014 Copyright All Rights Reserved •   info@gla-solutions.com  •   System Information & Resource Development  •
</footer>
</body>
</html>