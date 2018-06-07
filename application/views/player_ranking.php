<?php
$view = array(
	'player' => array(
		'list' => ''
	)
);

if(!empty($data['player']['ranking']['data'])) {
	
	$number = 1;
	
	foreach($data['player']['ranking']['data'] as $key => $value) {
		
		if($key < 10) {
			
			if(!empty($value['point'])) {
				
				$value['point'] = number_format($value['point']);
				
			}
			
			$view['player']['list'] .= '<tr>
				<td><p>'.$number.'</p></td>
				<td><p>'.$value['username'].'</p></td>
				<td><p>'.$value['point'].'</p></td>
			</tr>';
			
		}
		
		$number++;
		
	}
	
}
?>


<div id="content">
	<div class="wrapper">
    	<div class="content">
        	<div class="header">
            	<h2>IPL Point</h2>
            </div>
            <div class="filter">
            	<form method="post" action="">
                	<select class="type" name="type">
                    	<option value="">Top Player</option>
                    	<option value="Top 10">Top 10</option>
                        <option value="Top 50">Top 50</option>
                        <option value="Top 100">Top 100</option>
                    </select>
                    <input class="date start-date" name="start-date" placeholder="Tanggal Mulai">
                    <input class="date end-date" name="end-date" placeholder="Tanggal Akhir">
                    <div class="clear"></div>
                </form>
            </div>
            <table class="ranking">
            	<tr>
                	<th><p>No</p></th>
                    <th><p>Nama Pengguna</p></th>
                    <th><p>Jumlah Point</p></th>
                </tr>
                <?php echo $view['player']['list'] ?>
            </table>
        </div>
    </div>
</div>