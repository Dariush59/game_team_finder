<?php

namespace App\Console\Commands;

use App\Models\Dota2Position;
use App\Models\MatchmakingRanking;
use App\Models\Region;
use Illuminate\Console\Command;
use Phoenix\People\Models\Companies\ApprovalRoutings\CompanyApprovalRouting;

class ImportDependencies extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'build:dependencies';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Import all third party data to the current database.';

   /**
    * Create a new command instance.
    *
    * @return void
    */
   public function __construct()
   {
       parent::__construct();
   }

   /**
    * Execute the console command.
    *
    * @return mixed
    */
   public function handle()
   {
        $this->importMasterDataDependencies();
   }

   private function importMasterDataDependencies()
   {
        print_r("\n *Importing dota2 position* \n");
        print_r((new Dota2Position)->import());

        print_r("\n *Importing regions* \n");
        print_r((new Region)->import());

        print_r("\n *Importing MMR* \n");
        print_r((new MatchmakingRanking)->import());


   }
}
