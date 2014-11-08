<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ConnectUpdateTopup extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:connect_update_topup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command for checking topup status and update accordingly with status change';

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
	public function fire()
	{
		$pending_topups = DB::table('topup')->where('status', 'pending')->get();
		foreach ($pending_topups as $pending_topup) {
			$response = PaymentAPI::update_status('TUID'.$pending_topup->id);
			dd($response);
			if($response->transaction_status != "pending"){
				if($response->transaction_status == 'settlement'){
					// PAY TO USER
					//GETTING TRANSFER TYPE
					$transactionService = new Cyclos\Service('transactionService');
					$to = new stdclass();
					$to->username = 'test2';
					$result = $transactionService->run('getPaymentData',array("SYSTEM",$to),false);
					
					//TRANSFERRING TO USER
					$paymentService = new Cyclos\Service('paymentService');

					$parameters = new stdclass();
					$parameters->from = $result->from;
				    $parameters->to = $result->to;
				    $parameters->type = $result->paymentTypes[0];
				    $parameters->amount = $result->gross_amount;
				    $parameters->description = "Topup for veritrans transaction id " . $result->transaction_id;
				    
				    $paymentResult = $paymentService->run('perform',$parameters,false);
				}
				DB::table('topup')	->where('id', $pending_topup->id)->update(array('status' => ($response->transaction_status)));
			}
		};
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
