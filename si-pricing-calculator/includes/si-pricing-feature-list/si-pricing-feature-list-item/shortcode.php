<?php
$title     = ( $title     != ''     ) ? $title : 'Set a Title';
$link     = ( $link     != ''     ) ? $link : '';

$output = "<a href='{$link}'>{$title}</a>";
echo $output;
?>