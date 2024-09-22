<?php

function formatarData($data)
{
    if (gettype($data) != 'timestamp') {
        $data = strtotime($data);
    }
    return date('d/m/Y', $data);
}

function formatarDataPorAno($data)
{
    if (gettype($data) != 'timestamp') {
        $data = strtotime($data);
    }
    return date('Y-m-d', $data);
}
