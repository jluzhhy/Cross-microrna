<?php
    require('lib/sphinxapi.php');
    
    $searchd = new SphinxClient;
    $searchd->setServer("localhost", 9312);
    $SPHINX_MAX_MATCHES = 5000000;
    // $searchd->setMatchMode(SPH_MATCH_ANY);
    // $searchd->setMatchMode(SPH_MATCH_EXTENDED);
    // $searchd->setMaxQueryTime(10);
?>
