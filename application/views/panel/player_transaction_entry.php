<?php
$view = array(
	'player' => array(
		'transaction' => array(
			'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
			'date' => '',
			'id' => '',
			'playerUsername' => '',
			'point' => '',
			'rake' => '',
			'stake' => '',
			'timestamp' => '',
			'winlose' => ''
		)
	)
);

if(!empty($data['player']['transaction']['data'])) {
	
	if(!empty($data['player']['data'])) {
		
		foreach($data['player']['data'] as $key => $value) {
			
			if($value['id'] == $data['player']['transaction']['data'][0]['player_id']) {
				
				$view['player']['transaction']['playerUsername'] = $value['username'];
				
			}
			
		}
		
	}
	
	$data['player']['transaction']['data'][0]['point'] = number_format($data['player']['transaction']['data'][0]['point']);
	$data['player']['transaction']['data'][0]['rake'] = number_format($data['player']['transaction']['data'][0]['rake']);
	$data['player']['transaction']['data'][0]['stake'] = number_format($data['player']['transaction']['data'][0]['stake']);
	$data['player']['transaction']['data'][0]['winlose'] = number_format($data['player']['transaction']['data'][0]['winlose']);
	
	$view['player']['transaction']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['player']['transaction']['date'] = $data['player']['transaction']['data'][0]['date'];
	$view['player']['transaction']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['player']['transaction']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['player']['transaction']['point'] = $data['player']['transaction']['data'][0]['point'];
	$view['player']['transaction']['rake'] = $data['player']['transaction']['data'][0]['rake'];
	$view['player']['transaction']['stake'] = $data['player']['transaction']['data'][0]['stake'];
	$view['player']['transaction']['winlose'] = $data['player']['transaction']['data'][0]['winlose'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="transaction-white square-30 margin-right-10"></i>Player Transaction Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['player']['transaction']['id'] ?>
                    <p class="title">Player</p>
                    <p class="colon">:</p>
                    <input class="player-username" name="player-username" type="text" placeholder="Player" value="<?php echo $view['player']['transaction']['playerUsername'] ?>">
                    <p class="response player-username"></p>
                    <div class="clearfix"></div>
                    <p class="title">Stake</p>
                    <p class="colon">:</p>
                    <input class="stake" name="stake" type="text" placeholder="Stake" value="<?php echo $view['player']['transaction']['stake'] ?>">
                    <p class="response stake"></p>
                    <div class="clearfix"></div>
                    <p class="title">Win/Lose</p>
                    <p class="colon">:</p>
                    <input class="winlose" name="winlose" type="text" placeholder="Win/Lose" value="<?php echo $view['player']['transaction']['winlose'] ?>">
                    <p class="response winlose"></p>
                    <div class="clearfix"></div>
                    <p class="title">Rake</p>
                    <p class="colon">:</p>
                    <input class="rake" name="rake" type="text" placeholder="Rake" value="<?php echo $view['player']['transaction']['rake'] ?>">
                    <p class="response rake"></p>
                    <div class="clearfix"></div>
                    <p class="title">Point</p>
                    <p class="colon">:</p>
                    <input class="point" name="point" type="text" placeholder="Point" value="<?php echo $view['player']['transaction']['point'] ?>">
                    <p class="response point"></p>
                    <div class="clearfix"></div>
                    <p class="title">Date</p>
                    <p class="colon">:</p>
                    <input class="date" name="date" type="text" placeholder="Date" value="<?php echo $view['player']['transaction']['date'] ?>">
                    <p class="response date"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<?php echo $view['player']['transaction']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>