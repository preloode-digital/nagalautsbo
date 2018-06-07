<?php
$view = array(
	'filter' => array(
		'endDate' => '',
		'startDate' => ''
	),
	'report' => array(
		'adjustment' => 0,
		'deposit' => 0,
		'expense' => 0,
		'inject' => 0,
		'profit' => 0,
		'saving' => 0,
		'withdraw' => 0
	)
);

if(!empty($data['transaction']['data'])) {
	
	foreach($data['transaction']['data'] as $key => $value) {
		
		if($value['type'] == 'Adjustment') {
			
			$view['report']['adjustment'] += $value['amount'];
			
		}
		
		else if($value['type'] == 'Deposit') {
			
			$view['report']['deposit'] += $value['amount'];
			
		}
		
		else if($value['type'] == 'Expense') {
			
			$view['report']['expense'] += $value['amount'];
			
		}
		
		else if($value['type'] == 'Inject From Deposit') {
			
			$view['report']['inject'] += $value['amount'];
			
		}
		
		else if($value['type'] == 'Inject From Saving') {
			
			$view['report']['inject'] += $value['amount'];
			
		}
		
		else if($value['type'] == 'Saving') {
			
			$view['report']['saving'] += $value['amount'];
			
		}
		
		else if($value['type'] == 'Withdraw') {
			
			$view['report']['withdraw'] += $value['amount'];
			
		}
		
	}
	
	$view['report']['profit'] = $view['report']['deposit'] - $view['report']['withdraw'];
	
	$view['report']['adjustment'] = number_format($view['report']['adjustment']);
	$view['report']['deposit'] = number_format($view['report']['deposit']);
	$view['report']['expense'] = number_format($view['report']['expense']);
	$view['report']['inject'] = number_format($view['report']['inject']);
	$view['report']['profit'] = number_format($view['report']['profit']);
	$view['report']['saving'] = number_format($view['report']['saving']);
	$view['report']['withdraw'] = number_format($view['report']['withdraw']);
		
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['endDate'] = $data['filter']['data']['timestamp'][1];
	$view['filter']['startDate'] = $data['filter']['data']['timestamp'][0];
	
}
?>


<div id="content">
	<div class="wrapper">
        <div class="header">
        	<h2 class="page-title"><i class="report-30-white"></i>Report</h2>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input class="date" name="start-date" type="text" placeholder="Start Date" value="<?php echo $view['filter']['startDate'] ?>">
                <input class="date" name="end-date" type="text" placeholder="End Date" value="<?php echo $view['filter']['endDate'] ?>">
                <button class="filter" name="filter" type="submit"><i class="filter-15-white"></i>Filter</button>
                <div class="clear"></div>
            </form>
        </div>
        <div class="content">
        	<table>
            	<tr>
                	<th><p>Account</p></th>
                    <th><p>Amount</p></th>
                </tr>
                <tr>
                	<td><p>Adjustment</p></td>
                    <td><p><?php echo $view['report']['adjustment'] ?></p></td>
                </tr>
                <tr>
                	<td><p>Deposit</p></td>
                    <td><p><?php echo $view['report']['deposit'] ?></p></td>
                </tr>
                <tr>
                	<td><p>Expense</p></td>
                    <td><p><?php echo $view['report']['expense'] ?></p></td>
                </tr>
                <tr>
                	<td><p>Inject</p></td>
                    <td><p><?php echo $view['report']['inject'] ?></p></td>
                </tr>
                <tr>
                	<td><p>Profit</p></td>
                    <td><p><?php echo $view['report']['profit'] ?></p></td>
                </tr>
                <tr>
                	<td><p>Saving</p></td>
                    <td><p><?php echo $view['report']['saving'] ?></p></td>
                </tr>
                <tr>
                	<td><p>Withdraw</p></td>
                    <td><p><?php echo $view['report']['withdraw'] ?></p></td>
                </tr>
            </table>
        </div>
    </div>