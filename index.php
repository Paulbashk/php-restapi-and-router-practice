<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT');
	header('Access-Control-Allow-Headers: Origin, Accept, Authorization, Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
	require_once 'database/database.php';
	require_once 'functions/Core.php';
	require_once 'router/Router.php';