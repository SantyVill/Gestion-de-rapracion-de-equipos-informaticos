<?php

function setActiva($ruta){
    return request()->path()==$ruta? 'active':'';
}