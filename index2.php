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
?>
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
        .page_wp{width: 100%; display: flex;position: fixed;top: 47%;}
        .side{
            width: 46%;
            padding: 0 2%;
            height:250px;
        }
        .side_left_container, .side_right_container{
            padding:0 10px; overflow:hidden;
        }
        .title_p{font-size: 200%;font-weight: bold;text-align: center;font-family: Helvetia;width: 100%;}
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
        td{background-color: #F7FCFF; border-bottom: 1px solid #000;height: 45px; font-size: 95%;text-align: center;}
        td.header_fixed {
            background-color: #45517D;
            color: #FFF;
        }
        td.header {
            display: none;
        }
        a{color: #222232;text-decoration: none;font-weight: bold;}
        table {
            background-color: rgb(12, 28, 7);
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
            margin-top: -20px;
            position: relative;
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

        .titles_wp > div{width: 50%;padding: 0 27px;}
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
//        var LastPageHeight = 0;
//        $(document).ready( function ()
//        {
//            setInterval(function () {
//                var iScroll = $(window).scrollTop();
//                iScroll = iScroll + 200;
//                var startAgain = false;
//                if(LastPageHeight < iScroll){
//                    LastPageHeight = iScroll;
//                }else if(LastPageHeight == iScroll){
//                    startAgain=true;
//                }
//                if(!startAgain){
//                    $('html, body').animate({
//                        scrollTop: iScroll
//                    }, 1000);
//                }else{
//                    $('html, body').animate({
//                        scrollTop: 0
//                    }, 0);
//                }
//            }, 5000);
//
//            setTimeout(function(){
//                ch = jQuery(".top_img").height();
//                jQuery(".page_wp").css("top", ch + "px");
//            }, 1500);
//            setInterval("location.reload(true)", 300000);
//        } );

        $(document).ready(function() {
            if ($('.side_left_container').height() > $('.side_left').height()) {
                setInterval(function () {

                    start('left');
                }, 3000);
            }

            if ($('.side_right_container').height() > $('.side_right').height()) {
                setInterval(function () {

                    start('right');
                }, 3000);
            }
        });

        function animateContent(direction, elem) {
            var animationOffset = $('.side_' + elem).height() - $('.side_' + elem + '_container').height()-30;
            if (direction == 'up') {
                animationOffset = 0;
            }

            console.log("animationOffset:"+animationOffset);
            speed = animationOffset * -100;
            $('.side_' + elem + '_container').animate({ "marginTop": (animationOffset)+ "px" }, speed);
        }

        function up(elem){
            animateContent("up", elem)
        }
        function down(elem){
            animateContent("down", elem)
        }

        function start(elem){
            setTimeout(function () {
                down(elem);
            }, 2000);
            setTimeout(function () {
                up(elem);
            }, 2000);
            setTimeout(function () {
                console.log("wait...");
            }, 5000);
        }
    </script>

</head>
<body>
<div class="top_img">
    <img src="airport3.jpg" id="airIMG" >
<!--    <iframe src="http://he.flightaware.com/live/airport_status_bigmap.rvt?airport=LLBG" style="width: 100%; height: 15em;border: 0; background-color: #FFF;" scrolling="no" seamless="seamless"></iframe>-->
    <div class="titles_wp">
        <div>
            <div class="title_p">Arrivals</div>
            <table class="tableListingTable" width="100%">
                <tr>
                    <td width="17%" class="header_fixed">Flight</td>
                    <td width="23%" class="header_fixed">Carrier</td>
                    <td width="21%" class="header_fixed">Origin</td>
                    <td width="18%" class="header_fixed">Arrival</td>
                    <td width="18%" class="header_fixed">Status</td>
                </tr>
            </table>
        </div>
        <div>
            <div class="title_p">Departures</div>
            <table class="tableListingTable" width="100%">
                <tr>
                    <td width="17%" class="header_fixed">Flight</td>
                    <td width="23%" class="header_fixed">Carrier</td>
                    <td width="21%" class="header_fixed">Origin</td>
                    <td width="18%" class="header_fixed">Departure</td>
                    <td width="18%" class="header_fixed">Status</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="page_wp">
    <div class="side left side_left">
        <div class="side_left_container">
        <?php
        //        for($i=1; $i < 9; $i++){
        //            $homepage = file_get_contents('http://www.flightstats.com/go/weblet?guid=70cbe593c1d6de05:-f82be2a:11f2df95376:38b8&weblet=status&action=AirportFlightStatus&airportCode=TLV&airportQueryType=1&airportQueryTimePeriod='. $i,false,$context);
        $homepage = file_get_contents('http://www.flightstats.com/go/weblet?guid=70cbe593c1d6de05:-f82be2a:11f2df95376:38b8&weblet=status&action=AirportFlightStatus&airportCode=TLV&airportQueryType=1',false,$context);
        $d = new DOMDocument();
        $d->loadHTML($homepage);
        $html_temp = $d->saveHTML();
        $html = str_get_html($html_temp);
        $option = $html->find('option[selected]', 0)->value;
        if($option == 8){
            $next = 1;
        }else{
            $next = $option + 1;
        }

        foreach($html->find('table[class=tableListingTable]') as $element){
            echo $element->outertext;
        }

        $homepage = file_get_contents('http://www.flightstats.com/go/weblet?guid=70cbe593c1d6de05:-f82be2a:11f2df95376:38b8&weblet=status&action=AirportFlightStatus&airportCode=TLV&airportQueryType=1&airportQueryTimePeriod=' . $next,false,$context);
        $d = new DOMDocument();
        $d->loadHTML($homepage);
        $html_temp = $d->saveHTML();
        $html = str_get_html($html_temp);

        foreach($html->find('table[class=tableListingTable]') as $element){
            echo $element->outertext;
        }
        //        }
        ?>
        </div>
    </div>
    <div class="side right side_right">
        <div class="side_right_container">
        <?php
        //    for($i=1; $i < 9; $i++){
        //        $homepage = file_get_contents('http://www.flightstats.com/go/weblet?guid=70cbe593c1d6de05:-f82be2a:11f2df95376:38b8&weblet=status&action=AirportFlightStatus&airportCode=TLV&airportQueryType=0&airportQueryTimePeriod='. $i,false,$context);
        $homepage = file_get_contents('http://www.flightstats.com/go/weblet?guid=70cbe593c1d6de05:-f82be2a:11f2df95376:38b8&weblet=status&action=AirportFlightStatus&airportCode=TLV&airportQueryType=0',false,$context);
        $d = new DOMDocument();
        $d->loadHTML($homepage);
        $html_temp = $d->saveHTML();
        $html = str_get_html($html_temp);

        foreach($html->find('table[class=tableListingTable]') as $element){
            echo $element->outertext;
        }

        $homepage = file_get_contents('http://www.flightstats.com/go/weblet?guid=70cbe593c1d6de05:-f82be2a:11f2df95376:38b8&weblet=status&action=AirportFlightStatus&airportCode=TLV&airportQueryType=0&airportQueryTimePeriod=' . $next,false,$context);
        $d = new DOMDocument();
        $d->loadHTML($homepage);
        $html_temp = $d->saveHTML();
        $html = str_get_html($html_temp);

        foreach($html->find('table[class=tableListingTable]') as $element){
            echo $element->outertext;
        }
        //    }
        ?>
        </div>
    </div>
</div>
<footer>
    •מערכות מידע ופתוח משאבים     •    © 2014 Copyright All Rights Reserved •   info@gla-solutions.com  •   System Information & Resource Development  •
</footer>
</body>
</html>