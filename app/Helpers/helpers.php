<?php

function isRouteActive($routeName, $active = 'active')
{
    return request()->routeIs($routeName) ? $active : '';
}
