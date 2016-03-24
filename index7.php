<?php
//arrivals
$ch = curl_init();
$json = '{ josnFlightTableSettings: \'{"Mode":"1","PageIndex":1,"SortExpression":"","SortDirection":"0","ItemsLimit":50,"ErrorMessage":"","PagerView":false,"FullWidth":true}\',airportId: \'LLBG\'  }';
//$json = '{\'properties\':\'{"MoreIncomingPageLink":"/en-US/airports/bengurion/Pages/OnlineFlights.aspx","MoreOutgoingPageLink":"/en-US/airports/bengurion/Pages/OnlineFlights.aspx","ItemsLimit":"6","CurrentAirportID":"LLBG","ErrorMessage":""}\'}';
curl_setopt($ch, CURLOPT_URL,"http://www.iaa.gov.il/en-US/airports/BenGurion/_layouts/15/IAAWebSite/WS/FlightsUtils.asmx/LoadTable --cookie 'lb=169257152.1.940795800.59571616; __utmt=1; __utma=232678535.449815034.1457904044.1457904044.1457929242.2; __utmb=232678535.2.10.1457929242; __utmc=232678535; __utmz=232678535.1457904044.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); WSS_FullScreenMode=false; TSPD_101=089ea8cfbcab2800947f8dafb3e81047ecf95ef2d33b93092382e59ad1e080037e70c7e7b21dea751225942692db4d77; TSc97abf53_75=TSc97abf53_rc=0&TSc97abf53_id=2&TSc97abf53_cr=089ea8cfbcab2800947f8dafb3e81047ecf95ef2d33b93092382e59ad1e080037e70c7e7b21dea751225942692db4d77:08564b82fb032000790f4d926ea3ba0651a76c3d1b84bdfaca3f561ed8e8ff29ce876730622c24b3&TSc97abf53_ct=0&TSc97abf53_rf=http%3a%2f%2fwww.iaa.gov.il%2fen-US%2fairports%2fbengurion%2fPages%2fdefault.aspx; TS017c7f37=010f83961d0614cce33387b050ded26ab5ac9d769c06b0aed1c4ca8b2b6924b7e7533dd9d4018bb46d2a776a8da979bf899d753956'");
//curl_setopt($ch, CURLOPT_URL,"http://www.iaa.gov.il/en-US/airports/bengurion/_layouts/15/IAAWebSite/WS/FlightsUtils.asmx/LoadHomePageTable");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Accept:application/json','Access-Control-Allow-Origin: http://www.iapf.org.il'));
//curl_setopt($ch, CURLOPT_POSTFIELDS,"postvar1=value1&postvar2=value2&postvar3=value3");

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

// further processing ....
print_r($server_output);

$resp = json_decode($server_output);
//print_r($resp);
$dom = new DOMDocument;
$dom->loadHTML($resp->d);
$tables = $dom->getElementsByTagName('table');
$count=0;
foreach ($tables as $table){
    foreach ($table->childNodes as $ttitle){
        if($ttitle->tagName == "tbody"){
            foreach ($ttitle->childNodes as $tr){
                ++$count;
                if($count > 50){
                    $tr->setAttribute("class", "toHide"); // remove hack
                }
            }
        }        
    }
}

$images = $dom->getElementsByTagName('img');
foreach ($images as $image) {
        $image->setAttribute('src', 'http://www.iaa.gov.il/' . $image->getAttribute('src'));
}
$html = $dom->saveHTML();

//departures
$ch2 = curl_init();
$json2 = '{ josnFlightTableSettings: \'{"Mode":"2","PageIndex":1,"SortExpression":"","SortDirection":"0","ItemsLimit":50,"ErrorMessage":"","PagerView":false,"FullWidth":true}\',airportId: \'LLBG\'  }';
curl_setopt($ch2, CURLOPT_URL,"http://www.iaa.gov.il/en-US/airports/bengurion/_layouts/15/IAAWebSite/WS/FlightsUtils.asmx/LoadTable");
curl_setopt($ch2, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $json2);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Accept:application/json'));
//curl_setopt($ch, CURLOPT_POSTFIELDS,"postvar1=value1&postvar2=value2&postvar3=value3");

// receive server response ...
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

$server_output2 = curl_exec ($ch2);

curl_close ($ch2);

// further processing ....
//print_r($server_output);
$resp2 = json_decode($server_output2);

$dom2 = new DOMDocument;
$dom2->loadHTML($resp2->d);
$tables = $dom2->getElementsByTagName('table');
$count=0;
foreach ($tables as $table){
    foreach ($table->childNodes as $ttitle){
        if($ttitle->tagName == "tbody"){
            foreach ($ttitle->childNodes as $tr){
                ++$count;
                if($count > 50){
                    $tr->setAttribute("class", "toHide"); // remove hack
                }
            }
        }        
    }
}
$images = $dom2->getElementsByTagName('img');
foreach ($images as $image) {
        $image->setAttribute('src', 'http://www.iaa.gov.il/' . $image->getAttribute('src'));
}
$html2 = $dom2->saveHTML();

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
            th{height: 35px;}
            .fixed{
                top:0;
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
                print_r($html);
                ?>
            </div>
            <div class="side right">
                <?php
                print_r($html2);
                ?>
            </div>
        </div>
        <footer>
  •מערכות מידע ופתוח משאבים     •    © 2014 Copyright All Rights Reserved •   info@gla-solutions.com  •   System Information & Resource Development  • 
        </footer>
    </body>
</html>