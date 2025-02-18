<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Action;


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

                info("id: ". $accion->id. "- fecha: ". $accion->fecha );

            }      
            
        }

        info(" Termina ". now());

    }
}
