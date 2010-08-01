	Crows.maptype='<?=$map_type;?>';
	Crows.default_episode_id='<?=$default_episode_id;?>';
	Crows.latitude=<?=$latitude;?>;
	Crows.longitude=<?=$longitude;?>;
	Crows.main_url='<?=$main_url;?>';
	Crows.zoom=<?=$zoom;?>;
	
	<?=($default_map_type&&$map_key)?'Crows.default_map_type='.$default_map_type.';':'';?>
	<?=($map_key)?'Crows.map=true;':''?>
