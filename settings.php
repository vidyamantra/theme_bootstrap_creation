<?php 
defined('MOODLE_INTERNAL') || die;
require_once('mycform.php');

if ($ADMIN->fulltree){
     
	$settings->add(new admin_setting_heading('theme_bootstrap_creation_layout_header', get_string('pagelayoutsettings', 'theme_bootstrap_creation'), ''));
     // Display logo or heading
    $name = 'theme_bootstrap_creation/displaylogo';
    $title = get_string('displaylogo','theme_bootstrap_creation');
    $description = get_string('displaylogodesc', 'theme_bootstrap_creation');
    $default = '0';
    $choices = array(0=>get_string('heading', 'theme_bootstrap_creation'),1=>get_string('mylogo', 'theme_bootstrap_creation'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting); 
    
    
    // Logo file setting
    $name = 'theme_bootstrap_creation/logo';
    $title = get_string('logo','theme_bootstrap_creation');
    $description = get_string('logodesc', 'theme_bootstrap_creation');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);
    
    
    // Tag line setting
	$name = 'theme_bootstrap_creation/tagline';
	$title = get_string('tagline','theme_bootstrap_creation');
	$description = get_string('taglinedesc', 'theme_bootstrap_creation');
	$setting = new admin_setting_configtext($name, $title, $description, '');
	$settings->add($setting);
	
    // back to top button
    $name = 'theme_bootstrap_creation/backtotop';
    $title = get_string('backtotop','theme_bootstrap_creation');
    $description = get_string('backtotopdesc', 'theme_bootstrap_creation');
    $default = '1';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settings->add($setting);
    
    // Hide moogle logo
    $name = 'theme_bootstrap_creation/hidemoodlelogo';
    $title = get_string('hidemoodlelogo','theme_bootstrap_creation');
    $description = get_string('hidemoodlelogodesc', 'theme_bootstrap_creation');
    $default = 0;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);
    
    
    $settings->add(new admin_setting_heading('theme_bootstrap_creation_color_setting', get_string('colorsettings', 'theme_bootstrap_creation'), ''));
    
	// page site background colour setting
    $name = 'theme_bootstrap_creation/sitebgc';
    $title = get_string('sitebgc','theme_bootstrap_creation');
    $description = get_string('sitebgcdesc', 'theme_bootstrap_creation');
    $default = '#7AB80E';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $settings->add($setting);
    
}

?>