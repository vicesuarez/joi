<?php
/** no direct access **/
defined('_WPLEXEC') or die('Restricted access');

/** set params **/
$wpl_properties = isset($params['wpl_properties']) ? $params['wpl_properties'] : array();
$property_id = isset($wpl_properties['current']['data']['id']) ? $wpl_properties['current']['data']['id'] : NULL;
$rooms = isset($wpl_properties['current']['items']['rooms']) ? $wpl_properties['current']['items']['rooms'] : NULL;

if(!count($rooms) or !is_array($rooms)) return;

$rooms = wpl_items::render_rooms($rooms);
?>
<div class="wpl_rooms_container" id="wpl_rooms_container<?php echo $property_id; ?>">
	<ul class="wpl_rooms_list_container clearfix">
		<?php foreach($rooms as $room): ?>
        <li class="wpl_rooms_room wpl_rooms_type<?php echo $room['category']; ?> room_<?php echo $room['category']; ?>" id="wpl_rooms_room<?php echo $room['id']; ?>">
			<?php 
			echo '<div class="room_name">'.__($room['name'], 'wpl').'</div>';
			if(isset($room['size'])) echo '<div class="room_size">( '.$room['size'].' )</div>';
			?>
		</li>
        <?php endforeach; ?>
    </ul>
</div>