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
                $mailData = [
 
                    'title' => 'Email recordatorio del Ministerio de Hacienda',
        
                    'body' => 'Tienes un evento proximo a realizar dentro los 5 dias .'
        
                ];
                Mail::to('actividades.jujuy@gmail.com')->send(new Email($mailData));

            }      
            
        }

        info(" Termina ". now());
        return 0;

    }
}
