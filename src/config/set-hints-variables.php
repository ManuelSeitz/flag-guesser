<?php
  function set_hints_variables() {
    if (!isset($_SESSION["current_hints"])) $_SESSION["current_hints"] = 0;

    if (!isset($_SESSION["total_hints"])) $_SESSION["total_hints"] = 3;
  }
?>