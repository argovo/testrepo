<?php

$params['title'] = 'The Title';
$params['number'] = '1000';
// getcwd().
$html = parse('../templates/test1.tpl', 'section1', $params);

echo $html;

?>