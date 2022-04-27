<?php

function get_product_cart() {
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['buy'];
    } else {
        return false;
    }
}

function get_total_cart() {
    if (isset($_SESSION['cart']))
        return $_SESSION['cart']['info']['total'];
}

function get_number_order_cart() {
    if (isset($_SESSION['cart']))
        return $_SESSION['cart']['info']['num_order'];
}