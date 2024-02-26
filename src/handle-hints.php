<?php
  session_start();
  $current_hints = $_SESSION["current_hints"];
  $total_hints = $_SESSION["total_hints"];

  if ($current_hints < $total_hints) {
    $_SESSION["current_hints"] += 1;
    if (!isset($_SESSION["hints_index"])) {
      $_SESSION["hints_index"] = [];
    }

    $random_index = rand(0, strlen($_SESSION["country_name"]) - 1);

    while (in_array($random_index, $_SESSION["hints_index"])) {
      $random_index = rand(0, strlen($_SESSION["country_name"]) - 1);
    }

    array_push($_SESSION["hints_index"], $random_index);
  }

  header("Location: index.php");
  exit;
?>