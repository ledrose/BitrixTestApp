<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>
	<head>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 	
		<?$APPLICATION->ShowMeta("keywords");?>
		<?$APPLICATION->ShowMeta("description");?>
		<title><?$APPLICATION->ShowTitle()?></title>
		<?$APPLICATION->ShowHead()?>
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
						