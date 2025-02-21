<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Action;

use App\Mail\Email;
use Mail;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email recordatorio ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Inicia ". now());
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

        info(" Termina ". now());
        return 0;

    }
}
