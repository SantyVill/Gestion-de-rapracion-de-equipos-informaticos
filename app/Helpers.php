<?php

function setActiva($ruta){
    return request()->routeIs($ruta)? 'active':'';
}