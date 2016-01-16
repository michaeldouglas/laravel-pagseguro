<?php

namespace laravel\pagseguro\Commands;

use Illuminate\Console\Command;
use Session;

/**
 * Comando para retornar a sessão para pagamento
 *
 * @category Address
 * @package Laravel\PagSeguro\Commands
 *         
 * @author Michael Douglas <michaeldouglas010790@gmail.com>
 * @since 2015-01-15
 *       
 * @copyright Laravel\PagSeguro
 */
class PagSeguroSessionPaymentCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'pagseguro:sessao-pagamento';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Retorna o ID de sessão válido para iniciar um Checkout Transparent';
	
	/**
	 * Create a new command instance.
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire() {
		$environment = $this->info('Para que seja possível iniciar a sessão de pagamento você precisa informar:');
		
		$email 		 = $this->ask('email '.$environment);
		$token 		 = $this->secret('token '.$environment);
		
		$this->line(Session::sessionpayment($email, $token));
	}
}