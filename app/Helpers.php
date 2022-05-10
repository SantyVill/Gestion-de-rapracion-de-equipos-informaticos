<?php

function setActiva($ruta){
    /* return request()->path()==$ruta? 'active':''; */
    return request()->routeIs($ruta)? 'active':'';
}