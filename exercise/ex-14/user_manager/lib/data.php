<?php

function show_array($data) {
    if (isset($data)) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
