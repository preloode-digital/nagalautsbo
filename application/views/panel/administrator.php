<?php
$view = array(
	'administrator' => array(
		'list' => ''
	),
	'filter' => array(
		'firstName' => '',
		'id' => '',
		'gender' => array(
			'placeholder' => 'Gender',
			'value' => ''
		),
		'lastName' => '',
		'role' => array(
			'placeholder' => 'Role',
			'value' => ''
		),
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'username' => ''
	),
	'option' => array(
		'role' => ''
	)
);

if(!empty($data['administrator']['data'])) {
	
	foreach($data['administrator']['data'] as $key => $value) {
		
		if($value['id'] > 1) {
			
			$name = $value['first_name'];
			
			if(!empty($value['middle_name'])) {
				
				$name .= ' '.$value['middle_name'];
				
			}
			
			if(!empty($value['last_name'])) {
				
				$name .= ' '.$value['last_name'];
				
			}
			
			$role = '';
			
			if(!empty($data['administrator']['role']['data'])) {
				
				for($i = 0; $i < count($data['administrator']['role']['data']); $i++) {
					
					if($data['administrator']['role']['data'][$i]['id'] == $value['administrator_role_id']) {
						
						$role = $data['administrator']['role']['data'][$i]['name'];
						
					}
					
				}
				
			}
			
			$view['administrator']['list'] .= '<tr>
				<td><p>'.$value['id'].'</p></td>
				<td class="load-detail" data-administrator-id="'.$value['id'].'"><p>'.$value['username'].'</p></td>
				<td><p>'.$name.'</p></td>
				<td><p>'.$role.'</p></td>
				<td><p>'.$value['status'].'</p></td>
				<td>
					<a href="'.$this->config->item('panel_url').'administrator_entry/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
					<button class="delete action" data-administrator-id="'.$value['id'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
				</td>
			</tr>';
			
		}
		
	}
	
}

if(!empty($data['administrator']['role']['data'])) {
	
	foreach($data['administrator']['role']['data'] as $key => $value) {
		
		$view['option']['role'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
		if(!empty($data['filter']['data']) && !empty($data['filter']['data']['role'][0])) {
			
			if($value['id'] == $data['filter']['data']['role'][0]) {
				
				$view['filter']['role']['placeholder'] = $value['name'];
				
			}
			
		}
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['firstName'] = $data['filter']['data']['firstName'][0];
	
	if(!empty($view['filter']['data']['gender'])) {
		
		$view['filter']['gender'] = array(
			'placeholder' => $data['filter']['data']['gender'][0],
			'value' => $data['filter']['data']['gender'][0]
		);
		
	}
	
	$view['filter']['id'] = $data['filter']['data']['id'][0];
	$view['filter']['lastName'] = $data['filter']['data']['lastName'][0];
	$view['filter']['role']['value'] = $data['filter']['data']['role'][0];
	
	if(!empty($data['filter']['data']['status'][0])) {
		
		$view['filter']['status'] = array(
			'placeholder' => $data['filter']['data']['status'][0],
			'value' => $data['filter']['data']['status'][0]
		);
		
	}
	
	$view['filter']['username'] = $data['filter']['data']['username'][0];
	
}
?>


<div id="content">
	<div class="wrapper">
        <div class="header">
        	<h2 class="page-title"><i class="user-white square-30 margin-right-10"></i>Administrator</h2>
            <div class="pagination">
            	<?php echo $data['administrator']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'administrator_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input name="username" type="text" placeholder="Username" value="<?php echo $view['filter']['username'] ?>">
                <input name="first-name" type="text" placeholder="First Name" value="<?php echo $view['filter']['firstName'] ?>">
                <input name="last-name" type="text" placeholder="Last Name" value="<?php echo $view['filter']['lastName'] ?>">
                <select name="gender">
                	<option value="<?php echo $view['filter']['gender']['value'] ?>"><?php echo $view['filter']['gender']['placeholder'] ?></option>
                    <option value="">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <select name="role">
                	<option value="<?php echo $view['filter']['role']['value'] ?>"><?php echo $view['filter']['role']['placeholder'] ?></option>
                    <option value="">Role</option>
                    <?php echo $view['option']['role'] ?>
                </select>
                <select name="status">
                	<option value="<?php echo $view['filter']['status']['value'] ?>"><?php echo $view['filter']['status']['placeholder'] ?></option>
                    <option value="">Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <button class="filter" name="filter" type="submit"><i class="filter-white square-15 margin-right-10"></i>Filter</button>
                <div class="clearfix"></div>
            </form>
        </div>
        <div class="content">
        	<table>
            	<tr>
                	<th><p>ID</p></th>
                    <th><p>Username</p></th>
                    <th><p>Name</p></th>
                    <th><p>Role</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['administrator']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['administrator']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>