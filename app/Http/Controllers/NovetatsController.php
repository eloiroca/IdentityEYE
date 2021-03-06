<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NovetatsController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    public function novetats(){
        $data = getdate();
        $dia = $data['mday'];
        $mes = $data['mon'];
        $any = $data['year'];
        $calendari = $this->calendari($dia,$mes,$any);

        try{
            //Consumir RSS
            $rss = simplexml_load_string(file_get_contents('http://feeds.weblogssl.com/trendencias'));
        }

        catch(Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }

        $dades = ['rss' => $rss, 'calendari' => $calendari];
        return view('novetats')->with('dades', $dades);
    }

    public function calendari($dia, $mes, $any){
	//CODI CALENDARI
	$dia_semana = date('N', mktime(0,0,0,$mes,1,$any));
	$num_dies = date('t', mktime(0,0,0,$mes,$dia,$any));
	$calendarienhtml = '<table border=1 id="tau_cal">';

	switch ($mes){
		case 1: $calendarienhtml .= '<th class="th" height=55 colspan="7">Enero</th>';
		break;
		case 2: $calendarienhtml .= '<th class="th" height=55 colspan="7">Febrero</th>';
		break;
		case 3: $calendarienhtml .= '<th class="th" height=55 colspan="7">Marzo</th>';
		break;
		case 4: $calendarienhtml .= '<th class="th" height=55 colspan="7">Abril</th>';
		break;
		case 5: $calendarienhtml .= '<th class="th" height=55 colspan="7">Mayo</th>';
		break;
		case 6: $calendarienhtml .= '<th class="th" height=55 colspan="7">Junio</th>';
		break;
		case 7: $calendarienhtml .= '<th class="th" height=55 colspan="7">Julio</th>';
		break;
		case 8: $calendarienhtml .= '<th class="th" height=55 colspan="7">Agosto</th>';
		break;
		case 9: $calendarienhtml .= '<th class="th" height=55 colspan="7">Septiembre</th>';
		break;
		case 10: $calendarienhtml .= '<th class="th" height=55 colspan="7">Octubre</th>';
		break;
		case 11: $calendarienhtml .= '<th class="th" height=55 colspan="7">Noviembre</th>';
		break;
		case 12: $calendarienhtml .= '<th class="th" height=55 colspan="7">Diciembre</th>';
	}

	$calendarienhtml .= '<tr>';

	$diallista = array ('L', 'M', 'X', 'J', 'V', 'S', 'D');
	for ($i=0;$i<=6;$i++){
		$calendarienhtml .= '<td class="td" style="background-color:#A9D0F5;" height=35 width=50 >'.$diallista[$i].'</td>';
	}

	$calendarienhtml .= '<tr class="td">';

	$dia_actual = 1-($dia_semana-1);

	while ($dia_actual<=$num_dies){

		for ($j=1;$j<=7;$j++){

			if($dia_actual>$num_dies || $dia_actual < 1){
				$calendarienhtml .= '<td class="td" ></td>';
			}
			else if($dia_actual<=$num_dies){

				$calendarienhtml .= '<td class="td dia'.$dia_actual.'" >'.$dia_actual.'</td>';
			}
			$dia_actual++;
		}
		$calendarienhtml .= "<tr>";
	}

	$calendarienhtml .= '</table>';
	return $calendarienhtml;
    }
}
