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
    // Concatenar cada uno de los inputs del usuario para formar la respuesta completa (excluyendo espacios)
    $answer = $answer . $_POST["letter" . $index];
  }

  // Quitar espacios al nombre del país
  $country_name_without_spaces = str_replace(' ', '', $country_name);

  // Lógica de respuesta correcta/incorrecta
  if (strtolower($country_name_without_spaces) == strtolower($answer)) {
    $_SESSION["wins"] += 1;
    $_SESSION["score"] += 10;
    $_SESSION["is_answer_correct"] = true;
  } else {
    $_SESSION["loses"] += 1;
    $_SESSION["score"] -= 5;
    $_SESSION["is_answer_correct"] = false;
  }

  // Asignar nuevos valores para la siguiente partida
  $_SESSION["random_num"] = rand(0, sizeof($countries));
  $_SESSION["country_name"] = $countries[$_SESSION["random_num"]]['name'];

  // Volver a index.php
  header("Location: index.php");
  exit;
?>