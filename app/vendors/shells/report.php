<?php

class ReportShell extends Shell {
    var $uses = array('Mesa');


    function __initializeScript(){
        $this->Config = & ClassRegistry::init('Config');

        $ccc = $this->Config->find('all');
        
        foreach( $ccc as $c){
            $confName = '';
            if (!empty($c['ConfigCategory']['name'])) {
                $confName = $c['ConfigCategory']['name'].'.';
            }
            $keyName = $confName.$c['Config']['key'];
            Configure::write($keyName, $c['Config']['value']);
        }
    }


    function main() {
	    $this->__initializeScript();
            App::import('Component', 'Email'); 
	    $this->Email =& new EmailComponent(null); 
            $desde =  date('Y-m-d', strtotime('-1 day') );
            $mesas = $this->Mesa->totalesDeMesasEntre($desde, $desde);

            if ( !empty($mesas) ) {

                $fecha = date('d-m-y', strtotime('-1 day'));
                $mensaje = 'Fecha: '. $fecha .'. ';

                $mensaje .= "Total de Ventas: $". $mesas[0][0]['total'].'. ';                    
                $mensaje .= "Cubiertos: ". $mesas[0][0]['cant_cubiertos'].'. ';
                $mensaje .= "Mesas: ". $mesas[0][0]['cant_mesas'].'. ';
                $mensaje .= "Promedio por Cubierto: ". number_format($mesas[0][0]['promedio_cubiertos'],2).'. ';
                $mensaje .= '-- Chocha 012 --';



                $email = Configure::read('Restaurante.mail');
                $nombreResto = Configure::read('Restaurante.name');

                $mail = $nombreResto.' <'. $email .'>';
                $this->Email->from    = $mail;
                $this->Email->to      = $mail;                

                $this->Email->subject = 'Resumen de ventas del día '.$fecha;


                $this->Email->send($mensaje);
		}

            }         
}
