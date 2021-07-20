<?php

function getCurrentSlug(){
    return request()->path();
}