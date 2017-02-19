<?php
//------------------------------------
// Init
//------------------------------------

extract(colors());
require 'build_vars.php';
if(!$backup_dir) $backup_dir = "$source_dir/administrator/components/com_akeeba/backup";
$destination_dir = __DIR__."/site";


//------------------------------------
// Tasks
//------------------------------------

// Display build script info
text_('build.php version 1.0.0', 'color_purple');

// Display build vars
title('Build vars', 'color_orange');
text_(text('$source_dir','color_green')." = $source_dir");
text_(text('$backup_dir','color_green')." = $backup_dir");
text_(text('$destination_dir','color_green')." = $destination_dir");

// Prepare destination
title('Prepare destination', 'color_orange');
if(deleteDirectory($destination_dir)){
	text_('Done !', 'color_green');
}else{
	title("Error: Can't delete $destination_dir", 'color_red');
	return;
}

// Prepare source
title('Prepare source', 'color_orange');

// Get backup file
if($file = getLastBackup($backup_dir)){
	text_("Backup found: $file");
}else{
	title('Error: Backup not found', 'color_red');
	return;
}

// extract backup file
text_("Extracting...");
if(extractBackup($file, $destination_dir)){
	text_('Done !', 'color_green');
}else{
	title('Error: Extraction failed', 'color_light_red');
	return;
}

// Prepare configuration file
text_('Prepare configuration.php file');
$file = "$destination_dir/configuration.php";
$content = file_get_contents ($file);
purgeConfig($content, 'dbtype');
purgeConfig($content, 'host');
purgeConfig($content, 'user');
purgeConfig($content, 'password');
purgeConfig($content, 'db');
purgeConfig($content, 'dbprefix');
purgeConfig($content, 'live_site');
purgeConfig($content, 'secret');
file_put_contents($file, $content);
text_('Done !', 'color_green');

// Purge directory content templates/gantryjnilla/css-compiled
$dir = "$destination_dir/templates/gantryjnilla/css-compiled";
text_("Purge directory: $dir");
if(deleteDirectory($dir, true)){
	text_('Done !', 'color_green');
}else{
	title("Error: Can't Purge directory: $dir", 'color_red');
	return;
}

// Delete file templates/gantryjnilla/js-importer/jn-compiled.js
$file = "$destination_dir/templates/gantryjnilla/js-importer/jn-compiled.js";
text_("Delete file: $file");
if(deleteFile($file)){
	text_('Done !', 'color_green');
}else{
	title("Error: Can't delete file: $file", 'color_red');
	return;
}

































//------------------------------------
// Core Functions
//------------------------------------


// Reset a config var
function purgeConfig(&$config, $var){
	$config = preg_replace("/\\$$var = '.*';/i", "\$$var = '';", $config);
}

// Extract a backup
function extractBackup($file, $path){
	$zip = new ZipArchive;
	if($zip->open($file) === TRUE){
		$zip->extractTo($path);
		$zip->close();
		return true;
	}else{
		return false;
	}
}


// Gets the last backup file
function getLastBackup($dir){
	foreach(glob("{$dir}/*.zip") as $file){
		if(is_file($file)) {
			$files[$file] = filemtime($file);
		}
	}
	arsort($files);
	$files = array_keys($files);

	if(count($files)){
		return $files[0];
	}
}

// Delete a file
function deleteFile($file){
	if(!file_exists($file)) return true;
	unlink($file);
	if(!file_exists($file)) return true;
	return false;
}

// Delete a diretory, or optionally purge it content
function deleteDirectory($dir, $purge = false){
	if(!$purge && !file_exists($dir)) return true;

	foreach(glob("{$dir}/{,.}[!.,!..]*",GLOB_MARK|GLOB_BRACE) as $file)
	{
		if(is_dir($file)) {
			deleteDirectory($file);
		} else {
			unlink($file);
		}
	}

	if($purge) {
		if(count(glob("{$dir}/{,.}[!.,!..]*",GLOB_MARK|GLOB_BRACE))) return false;
	}else{
		rmdir($dir);
		if(file_exists($dir)) return false;
	}

	return true;
}


// Prints a title
function title($text, $color = 'color_none'){
	extract(colors());
	echo "\n";
	echo ${$color};
	echo "------------------------------------ \n";
	echo "- $text \n";
	echo "------------------------------------ \n";
	echo $color_none;
	echo "\n";
}

// Print text with optional color
function text($text, $color = 'color_none'){
	extract(colors());
	echo ${$color};
	echo $text;
	echo $color_none;
}

// Print text with a new line and optional color
function text_($text, $color = 'color_none'){
	text($text, $color);
	echo "\n";
}

// Declare color vars
function colors(){
	$colors['color_none']="\033[0m";
	$colors['color_black']="\033[0;30m";
	$colors['color_red']="\033[0;31m";
	$colors['color_green']="\033[0;32m";
	$colors['color_orange']="\033[0;33m";
	$colors['color_blue']="\033[0;34m";
	$colors['color_purple']="\033[0;35m";
	$colors['color_cyan']="\033[0;36m";
	$colors['color_light_gray']="\033[0;37m";
	$colors['color_dark_gray']="\033[1;30m";
	$colors['color_light_red']="\033[1;31m";
	$colors['color_light_green']="\033[1;32m";
	$colors['color_yellow']="\033[1;33m";
	$colors['color_light_blue']="\033[1;34m";
	$colors['color_light_purple']="\033[1;35m";
	$colors['color_light_cyan']="\033[1;36m";
	$colors['color_white']="\033[1;37m";

	return $colors;
}


?>


