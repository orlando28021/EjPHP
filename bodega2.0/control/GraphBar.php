<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of graphBar
 *
 * @author VARELA
 */
include("../pChart/pData.class");
include("../pChart/pChart.class");
class GraphBar {
    public function _showGraph_pChart($buscarBarra){
        // Dataset definition
                
        $DataSet = new pData;
        
        if($buscarBarra=="semana"){
            $semana=array("1era Semana","2da Semana","3era Semana","4ta Semana");
            $cantidadSemanal=array(2,4,5,6);
            $DataSet->AddPoint($semana,"Serie1"); 
            $DataSet->AddPoint($cantidadSemanal,"Serie2");
            // Initialise the graph
            define("WIDTH", 500);
            define("HEIGHT", 500);
            $Test = new pChart(WIDTH,HEIGHT);  
            $Test->setFontProperties("../font/arial.ttf",7);  
            $Test->setGraphArea(40,30,WIDTH-30,HEIGHT-30);  
            $Test->drawFilledRoundedRectangle(7,7, WIDTH-7,HEIGHT-7,5,240,240,240);  
            $Test->drawRoundedRectangle(5,5,WIDTH-5,HEIGHT-5,5,230,230,230);
            
            
        }  elseif ($buscarBarra=="mes") {
            $mensual=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre");
            $cantidadMensual=array(4,6,11,23,9,2,30,20,12,45);
            $DataSet->AddPoint($mensual,"Serie1"); 
            $DataSet->AddPoint($cantidadMensual,"Serie2");
            // Initialise the graph
            define("WIDTH", 700);
            define("HEIGHT", 500);
            $Test = new pChart(WIDTH,HEIGHT);  
            $Test->setFontProperties("../font/arial.ttf",7);  
            $Test->setGraphArea(40,30,WIDTH-30,HEIGHT-30);  
            $Test->drawFilledRoundedRectangle(7,7,WIDTH-7,HEIGHT-7,5,240,240,240);  
            $Test->drawRoundedRectangle(5,5,WIDTH-5,HEIGHT-5,5,230,230,230);
            $Test->setColorPalette(0,224,100,46);
        }
        
        $DataSet->AddAllSeries();
        $DataSet->RemoveSerie("Serie1");
        $DataSet->SetAbsciseLabelSerie("Serie1");
        $DataSet->SetSerieName("Productos Comprados","Serie2");      
                
        // Initialise the graph          
        $Test->drawGraphArea(255,255,255,TRUE);
        $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_START0,150,150,150,TRUE,0,2,TRUE);     
        $Test->drawGrid(4,TRUE,230,230,230,50);
        
        // Draw the 0 line  
        $Test->setFontProperties("../font/arial.ttf",6);  
        $Test->drawTreshold(0,143,55,72,TRUE,TRUE);  

        // Draw the bar graph  
        $Test->drawStackedBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),70);
        
        // Set labels
        $Test->setFontProperties("../font/arial.ttf",7);
        $Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie2");
        
        // Finish the graph  
        $Test->setFontProperties("../font/arial.ttf",8);  
        $Test->drawLegend((WIDTH/5),25,$DataSet->GetDataDescription(),255,255,255);  
        $Test->setFontProperties("../font/arial.ttf",10);  
        $Test->drawTitle((WIDTH-200),22,"Estadistica de Barra de Grafico",50,50,50,185);  
        $Test->Render("../img/imagenBarra_pChart.png");
    }
}
?>
