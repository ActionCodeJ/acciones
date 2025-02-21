<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Action;

use Mail;

use App\Mail\Email;

class MailController extends Controller
{
    //
     /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {

        $from = date('Y-m-d');

        //$to = date('Y-m-d', strtotime("+7 day", $from));
       
        $date = strtotime($from);
        $to =  date('Y-m-d',strtotime("+7 day", $date));

        info("from ". $from. "-hasta ". $to );
        $query = Action::whereBetween('fecha',  [$from, $to])->orderBy('fecha', 'asc')->with('localidad.departamento')->get();
        if(!empty($query)) {
            foreach ($query as $accion) {
                if($accion->team_id)
                  $responsable=$accion->team->mail;

                info($responsable."- id: ". $accion->id. "- fecha: ". $accion->fecha );
               
                $title= " Asunto: Recordatorio ". $accion->nombre. " - Fecha:". $accion->fecha;
                $body= " Le recordamos que la actividad ". $accion->nombre. " se llevará a cabo el". $accion->fecha.
                " en la localidad de ". $accion->localidad->nombre. ".  Esta actividad es organizada por ". $accion->entidad->nombre.
                " tiene como objetivo ". $accion->descripcion               
                ;

                $link=  $accion->id;

                $footer= " Atentamente, actividades.jujuy.gob.ar ";

               
              
                
               
                $mailData = [
 
                    'title' => $title,
                    'link' => $link,
                    'footer' => $footer,
        
                    'body' => $body
        
                ];
                Mail::to($responsable)->send(new Email($mailData));

            }      
            
        }
 
        
 
            
 
         dd("Email is sent successfully.");
 
     }
}
