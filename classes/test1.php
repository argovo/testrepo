<?php

$params['title'] = 'The Title';
$params['number'] = '1000';

$html = parse('templates/test1.tpl', 'section1', $params);

echo $html;

?>