<?php
  function set_stats_variables () {
    if (!isset($_SESSION["games_count"])) $_SESSION["games_count"] = 0;

    if (!isset($_SESSION["wins"])) $_SESSION["wins"] = 0;

    if (!isset($_SESSION["loses"])) $_SESSION["loses"] = 0;

    if (!isset($_SESSION["score"])) $_SESSION["score"] = 0;
  }
?>