<?php
/** no direct access **/
defined('_WPLEXEC') or die('Restricted access');

/** Define Tabs **/
$tabs = array();
$tabs['tabs'] = array();

$content = '<h3>'.__('WPL Dashboard', 'wpl').'</h3><p>'.__('Welcome to WPL dashboard, Here you can see some important information about WPL and its add-ons. WPL manuals, KB articles and some stats of your website. You can update WPL PRO and its addons from this page too.', 'wpl').'</p>';
$tabs['tabs'][] = array('id'=>'wpl_contextual_help_tab_int', 'content'=>$content, 'title'=>__('Introduction', 'wpl'));

$content = '<h3>'.__('Documentation', 'wpl').'</h3><p><ul><li><a href="http://wpl.realtyna.com/wassets/wpl-manual.pdf" target="_blank">'.__('WPL Manual', 'wpl').'</a></li><li><a href="https://support.realtyna.com/index.php?/Default/Knowledgebase/List/Index/28/wpl---wordpress-property-listing" target="_blank">'.__('WPL KB articles', 'wpl').'</a></li></ul></p>';
$tabs['tabs'][] = array('id'=>'wpl_contextual_help_tab_doc', 'content'=>$content, 'title'=>__('Documentation', 'wpl'));

$articles  = '';
$articles .= '<li><a href="https://support.realtyna.com/index.php?/Knowledgebase/Article/View/557/28/how-to-update-wpl-pro" target="_blank">'.__('How to update WPL PRO', 'wpl').'</a></li>';
$articles .= '<li><a href="https://support.realtyna.com/index.php?/Default/Knowledgebase/Article/View/561/" target="_blank">'.__('How do you upgrade WPL basic to WPL PRO?', 'wpl').'</a></li>';
$articles .= '<li><a href="https://support.realtyna.com/index.php?/Default/Knowledgebase/Article/View/703/" target="_blank">'.__('How can I download my purchased products?', 'wpl').'</a></li>';

$content = '<h3>'.__('Related KB Articles', 'wpl').'</h3><p>'.__('Here you can find some of important KB articles that answer questions related to this page. You can check this section if you faced any question on certain pages.', 'wpl').'</p><p><ul>'.$articles.'</ul></p>';
$tabs['tabs'][] = array('id'=>'wpl_contextual_help_tab_kb', 'content'=>$content, 'title'=>__('KB Articles', 'wpl'));

return $tabs;