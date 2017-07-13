<?php

add_action('admin_menu', 'create_esm_options_page');
add_action('admin_init', 'register_and_build_esm_options');

function register_and_build_esm_options(){
  register_setting('esm_settings_option','esm_mail_type', 'validate_esm_mail_setup');
  register_setting('esm_settings_option','esm_settings', 'validate_esm_mail_setup');
  
  add_settings_section('mail_section', 'Mail Settings','esm_section_callback','esm_mail_setup');
  add_settings_field('esm_mail_type','Mail Type: ','esm_mail_type','esm_mail_setup','mail_section');
  
  add_settings_section('mail_smtp_section', 'SMTP Settings','esm_section_smtp_callback','esm_mail_setup');
  add_settings_field('esm_mail_smtp_host','Host: ','esm_mail_smtp_host','esm_mail_setup','mail_smtp_section');
  add_settings_field('esm_mail_smtp_port','Port: ','esm_mail_smtp_port','esm_mail_setup','mail_smtp_section');
  add_settings_field('esm_mail_smtp_secure','Secure: ','esm_mail_smtp_secure','esm_mail_setup','mail_smtp_section');
  add_settings_field('esm_mail_smtp_auth','Auth: ','esm_mail_smtp_auth','esm_mail_setup','mail_smtp_section');
  add_settings_field('esm_mail_smtp_username','SMTP Username: ','esm_mail_smtp_username','esm_mail_setup','mail_smtp_section');
  add_settings_field('esm_mail_smtp_password','SMTP Password: ','esm_mail_smtp_password','esm_mail_setup','mail_smtp_section'); 
}

function create_esm_options_page() {
  add_menu_page('Mail Setup', 'Mail Setup', 'administrator', 'esm', 'esm_options_page');
}


function esm_options(){ ?>	
	<form method="post" action="options.php">
      <?php settings_fields('esm_settings_option'); ?>
      <?php do_settings_sections('esm_mail_setup'); ?>
      <p class="submit">
        <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
      </p>
    </form>	
<?php }


function esm_options_page() {
?>
  <div id="theme-options-wrap">
    <div class="icon32" id="icon-tools"> <br /> </div>
    <h2>Electric Studio Mailer</h2>
	<div><?php esm_options(); ?></div>
	
    <p>Plugin Created By <a href="http://www.electricstudio.co.uk/">Electric Studio</a> | Get Wordpress Hosting from <a href="www.electrichosting.co.uk">Electric Hosting</a></p>
  </div>
<?php
}

function validate_esm_mail_setup($option){
    //put any validation on the option here.
    return $option;
}

function esm_section_callback(){}

function esm_section_smtp_callback(){
	$html = "<p>Only required if mail type is set to 'SMTP'. If mail type 'Mail' is selected, these setting will be ignored</p>";
	echo $html;
}

function esm_mail_type(){
	$optionValue = get_option('esm_mail_type');
    $option = "";
    $option .= "<input type=\"radio\" name=\"esm_mail_type\" value=\"mail\" ".checked($optionValue , 'mail',false)." ";
    if($optionValue == "")
    	$option .= "checked=\"checked\"";
    $option .= "/>Mail<br/>";
    $option .= "<input type=\"radio\" name=\"esm_mail_type\" value=\"smtp\" ".checked($optionValue , 'smtp', false)."/>SMTP<br/>";
    echo $option;
}

function esm_mail_smtp_host(){
	$optionValue = get_option('esm_settings');
    $option = "";
    $option .= "<input id='esm_smtp_host' name='esm_settings[host]' size='40' type=\"text\" value='{$optionValue['host']}' />";
    echo $option;
}

function esm_mail_smtp_port(){
	$optionValue = get_option('esm_settings');
    $option = "";
    $option .= "<input id='esm_smtp_port' name='esm_settings[port]' size='40' type=\"text\" value='{$optionValue['port']}' />";
    echo $option;
}

function esm_mail_smtp_secure(){
	$optionValue = get_option('esm_settings');
    $option = "";
    $option .= "<select id='esm_smtp_secure' name='esm_settings[secure]' > ";
    $option .= "<option value='none'>none</option>";
    $option .= "<option value=\"tls\" ".selected($optionValue['secure'],'tls',false).">tls</option>";
    $option .= "<option value=\"ssl\" ".selected($optionValue['secure'],'ssl',false).">ssl</option>";
    $option .= "</select>";
    echo $option;
}

function esm_mail_smtp_auth(){
	$optionValue = get_option('esm_settings');
    $option = "";
    $option .= "<input id='esm_smtp_auth' name='esm_settings[auth]' size='40' type=\"checkbox\" value=\"true\" ".checked($optionValue['auth'] , 'true', false)."/>";
    echo $option;
}

function esm_mail_smtp_username(){
	$optionValue = get_option('esm_settings');
    $option = "";
    $option .= "<input id='esm_smtp_username' name='esm_settings[username]' size='40' type=\"text\" value='{$optionValue['username']}' />";
    echo $option;
}

function esm_mail_smtp_password(){
	$optionValue = get_option('esm_settings');
	$option = "<input id='esm_smtp_password' name='esm_settings[password]' size='40' type='password' value='{$optionValue['password']}' />";
    echo $option;
}