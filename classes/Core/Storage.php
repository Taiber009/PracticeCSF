<?php

interface Storage
{
    function saveData($query, $data);
    function getData($query, $data);
}
