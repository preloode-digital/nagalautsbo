<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Report_ajax extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
	}
	
	
	/* Default method */
	public function index() {
		
		if($_POST['action'] == 'loadReport') {
			
			$this->loadReport($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function loadReport($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('transaction_data');
		
		$response = array(
			'response' => '',
			'result' => false
		);
		
		if(!empty($_COOKIE['account'])) {
			
			$total = array(
				'adjustment' => 0,
				'deposit' => 0,
				'expense' => 0,
				'inject' => 0,
				'saving' => 0,
				'withdraw' => 0
			);
			
			if(!empty($data['bankName']) && empty($data['bankAccount'])) {
				
				$load = array(
					'bank_id' => $data['bankName']
				);
				$bankAccount = $this->bank_account_data->loadBindBankId($load);
				
				if(!empty($bankAccount)) {
					
					$bankAccountId = array();
					
					foreach($bankAccount as $value) {
						
						$bankAccountId[] = $value['id'];
						
					}
					
					$load = array(
						'bank_account_id' => $bankAccountId,
						'end_date' => $data['endDate'],
						'start_date' => $data['startDate'],
						'website' => $data['website']
					);
					$report = $this->transaction_data->loadReportUnionBank($load);
					
					if(!empty($report)) {
						
						for($i = 0; $i < count($bankAccountId); $i++) {
							
							foreach($report as $value) {
								
								if($value['from_bank_account_id'] == $bankAccountId[$i]) {
									
									if($value['type'] == 'Adjustment') {
										
										$total['adjustment'] = $total['adjustment'] - $value['amount'];
										
									}
									
									else if($value['type'] == 'Deposit') {
										
										$total['deposit'] = $total['deposit'] - $value['amount'];
										
									}
									
									else if($value['type'] == 'Expense') {
										
										$total['expense'] = $total['expense'] - $value['amount'];
										
									}
									
									else if($value['type'] == 'Inject') {
										
										$total['inject'] = $total['inject'] - $value['amount'];
										
									}
									
									else if($value['type'] == 'Saving') {
										
										$total['saving'] = $total['saving'] - $value['amount'];
										
									}
									
									else if($value['type'] == 'Withdraw') {
										
										$total['withdraw'] = $total['withdraw'] - $value['amount'];
										
									}
									
								}
								
								else if($value['to_bank_account_id'] == $bankAccountId[$i]) {
									
									if($value['type'] == 'Adjustment') {
										
										$total['adjustment'] = $total['adjustment'] + $value['amount'];
										
									}
									
									else if($value['type'] == 'Deposit') {
										
										$total['deposit'] = $total['deposit'] + $value['amount'];
										
									}
									
									else if($value['type'] == 'Expense') {
										
										$total['expense'] = $total['expense'] + $value['amount'];
										
									}
									
									else if($value['type'] == 'Inject') {
										
										$total['inject'] = $total['inject'] + $value['amount'];
										
									}
									
									else if($value['type'] == 'Saving') {
										
										$total['saving'] = $total['saving'] + $value['amount'];
										
									}
									
									else if($value['type'] == 'Withdraw') {
										
										$total['withdraw'] = $total['withdraw'] + $value['amount'];
										
									}
									
								}
								
							}
							
							$response['response'] = '<tr>
								<th><p>Adjustment</p></th>
								<th><p>Deposit</p></th>
								<th><p>Expense</p></th>
								<th><p>Inject</p></th>
								<th><p>Saving</p></th>
								<th><p>Withdraw</p></th>
							</tr>
							<tr>
								<td><p>'.$total['adjustment'].'</p></td>
								<td><p>'.$total['deposit'].'</p></td>
								<td><p>'.$total['expense'].'</p></td>
								<td><p>'.$total['inject'].'</p></td>
								<td><p>'.$total['saving'].'</p></td>
								<td><p>'.$total['withdraw'].'</p></td>
							</tr>';
							$response['result'] = true;
							
						}
						
					}
					
				}
				
			}
			
			else if(!empty($data['bankAccount'])) {
				
				$load = array(
					'bank_account_id' => $data['bankAccount'],
					'end_date' => $data['endDate'],
					'start_date' => $data['startDate'],
					'website' => $data['website']
				);
				$report = $this->transaction_data->loadReport($load);
				
				if(!empty($report)) {
					
					foreach($report as $value) {
						
						if($value['from_bank_account_id'] == $data['bankAccount']) {
							
							if($value['type'] == 'Adjustment') {
								
								$total['adjustment'] = $total['adjustment'] - $value['amount'];
								
							}
							
							else if($value['type'] == 'Deposit') {
								
								$total['deposit'] = $total['deposit'] - $value['amount'];
							}
							
							else if($value['type'] == 'Expense') {
								
								$total['expense'] = $total['expense'] - $value['amount'];
								
							}
							
							else if($value['type'] == 'Inject') {
								
								$total['inject'] = $total['inject'] - $value['amount'];
								
							}
							
							else if($value['type'] == 'Saving') {
								
								$total['saving'] = $total['saving'] - $value['amount'];
								
							}
							
							else if($value['type'] == 'Withdraw') {
								
								$total['withdraw'] = $total['withdraw'] - $value['amount'];
								
							}
							
						}
						
						else if($value['to_bank_account_id'] == $data['bankAccount']) {
							
							if($value['type'] == 'Adjustment') {
								
								$total['adjustment'] = $total['adjustment'] + $value['amount'];
								
							}
							
							else if($value['type'] == 'Deposit') {
								
								$total['deposit'] = $total['deposit'] + $value['amount'];
								
							}
							
							else if($value['type'] == 'Expense') {
								
								$total['expense'] = $total['expense'] + $value['amount'];
								
							}
							
							else if($value['type'] == 'Inject') {
								
								$total['inject'] = $total['inject'] + $value['amount'];
								
							}
							
							else if($value['type'] == 'Saving') {
								
								$total['saving'] = $total['saving'] + $value['amount'];
								
							}
							
							else if($value['type'] == 'Withdraw') {
								
								$total['withdraw'] = $total['withdraw'] + $value['amount'];
								
							}
							
						}
						
					}
					
					$response['response'] = '<tr>
						<th><p>Adjustment</p></th>
						<th><p>Deposit</p></th>
						<th><p>Expense</p></th>
						<th><p>Inject</p></th>
						<th><p>Saving</p></th>
						<th><p>Withdraw</p></th>
					</tr>
					<tr>
						<td><p>'.$total['adjustment'].'</p></td>
						<td><p>'.$total['deposit'].'</p></td>
						<td><p>'.$total['expense'].'</p></td>
						<td><p>'.$total['inject'].'</p></td>
						<td><p>'.$total['saving'].'</p></td>
						<td><p>'.$total['withdraw'].'</p></td>
					</tr>';
					$response['result'] = true;
					
				}
				
			}
			
			else {
				
				$response['response'] = '<p>Please select bank account!</p>';
				
			}	
			
		}
		
		echo json_encode($response);
		
	}
	
	
}
?>