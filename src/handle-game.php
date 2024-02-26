<?php
  session_start();

  $countries = $_SESSION["countries"];
  $_SESSION["games_count"] += 1;
  $score = $_SESSION["score"];

  $random_num = $_SESSION["random_num"];
  $country_name = $_SESSION["country_name"];

  $answer = '';
  // Recorrer cada letra del país
  foreach (str_split($country_name) as $index => $letter) {
    if ($letter == ' ') continue;
    if (isset($_SESSION["hints_index"])) {
      foreach ($_SESSION["hints_index"] as $hint_index) {
        if ($index == $hint_index) {
          $answer = $answer . $letter;
        }
      }
    }
    // Concatenar cada uno de los inputs del usuario para formar la respuesta completa (excluyendo espacios)
    $answer = $answer . $_POST["letter" . $index];
  }

  // Quitar espacios al nombre del país
  $country_name_without_spaces = str_replace(' ', '', $country_name);

  // Lógica de respuesta correcta/incorrecta
  if (strtolower($country_name_without_spaces) == strtolower($answer)) {
    $_SESSION["wins"] += 1;
    $_SESSION["score"] += 20 - $_SESSION["current_hints"] * 5;
    $_SESSION["is_answer_correct"] = true;
  } else {
    $_SESSION["loses"] += 1;
    $_SESSION["score"] -= 10;
    if ($_SESSION["score"] < 0) {
      $_SESSION["score"] = 0;
    }
    $_SESSION["is_answer_correct"] = false;
  }

  // Asignar nuevos valores para la siguiente partida
  $_SESSION["random_num"] = rand(0, sizeof($countries));
  $_SESSION["country_name"] = $countries[$_SESSION["random_num"]]['name'];
  $_SESSION["current_hints"] = 0;
  $_SESSION["hints_index"] = [];

  // Volver a index.php
  header("Location: index.php");
  exit;
?>