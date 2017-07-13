<?php
global $wpdb;

function esm_install() {
	/* Registers version number */
	add_option('esm_ver','0.1');
	add_option('esm_settings',array());
	add_option('esm_mail_type','mail');
}

function esm_remove() {
	//delete stored version number
	delete_option('esm_ver');
	delete_option('esm_settings');
	delete_option('esm_mail_type');
}
