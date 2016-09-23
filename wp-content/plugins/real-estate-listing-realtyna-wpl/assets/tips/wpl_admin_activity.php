<?php
/** no direct access **/
defined('_WPLEXEC') or die('Restricted access');

/** define tips **/
$tips = array();

$content = '<h3>'.__('WPL Activities', 'wpl').'</h3><p>'.__('Activity is an internal WPL widget used to show some parts of the WPL interface. For example, Google Maps, Agent info, Property gallery etc. are shown by using an activity in WPL. Activities are contained inside of WPL views (not WordPress sidebars).', 'wpl').'</p>';
$tips[] = array('id'=>1, 'selector'=>'.wrap.wpl-wp h2', 'content'=>$content, 'position'=>array('edge'=>'top', 'align'=>'left'), 'buttons'=>array(2=>array('label'=>__('Next', 'wpl'))));

$content = '<h3>'.__('Filter Activities', 'wpl').'</h3><p>'.__('You can filter activities here. Lets search for "Google"!', 'wpl').'</p>';
$tips[] = array('id'=>2, 'selector'=>'#activity_manager_filter', 'content'=>$content, 'position'=>array('edge'=>'left', 'align'=>'center'), 'buttons'=>array(2=>array('label'=>__('Next', 'wpl'), 'code'=>'wplj("#activity_manager_filter").val("Google");wplj("#activity_manager_filter").trigger("keyup");'), 3=>array('label'=>__('Previous', 'wpl'))));

$content = '<h3>'.__('Manage Activities', 'wpl').'</h3><p>'.__('By clicking on action icons you can simply manage the activities.', 'wpl').'</p>';
$tips[] = array('id'=>3, 'selector'=>'#wpl_actions_td_thead', 'content'=>$content, 'position'=>array('edge'=>'right', 'align'=>'center'), 'buttons'=>array(3=>array('label'=>__('Previous', 'wpl'), 'code'=>'wplj("#activity_manager_filter").val("");wplj("#activity_manager_filter").trigger("keyup");')));

return $tips;