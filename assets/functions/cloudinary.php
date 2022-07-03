<?php

require_once get_template_directory() . '/vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Cloudinary;

$config = Configuration::instance();
$config->cloud->cloudName = 'imaginal-marketing-group';
$config->cloud->apiKey = '225831879718358';
$config->cloud->apiSecret = 'ZFLswV3NOtAvobCTXtfiqEYzb7g';
$config->url->secure = true;

$cloudinary = new Cloudinary($config);