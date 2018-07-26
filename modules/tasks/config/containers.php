<?php

$container['projects_model'] = function ($c) {
    return new \SON\Framework\Tasks\Models\Projects($c);
};
