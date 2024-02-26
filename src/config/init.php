<?php
  function get_countries () {
    $json_countries_path = "C:/xampp/htdocs/flag-guesser/public/countries.json";
    $json_data = file_get_contents($json_countries_path);

    $_SESSION["countries"] = json_decode($json_data, true);

    return $_SESSION["countries"];
  }

  function initialize_session_variables () {
    include 'set-stats-variables.php';
    include 'set-hints-variables.php';
    $countries = $_SESSION["countries"];
    
    if (!isset($_SESSION["random_num"])) $_SESSION["random_num"] = rand(0, sizeof($countries) - 1);
    $random_num = $_SESSION["random_num"];

    if (!isset($_SESSION["country_name"])) $_SESSION["country_name"] = $countries[$random_num]['name'];

    set_stats_variables();
    
    set_hints_variables();
  }
?>