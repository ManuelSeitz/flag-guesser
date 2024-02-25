<?php
  function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
    $output = implode(',', $output);
  
  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

  session_start();
  // Obtener datos de países
  $json_countries_path = "../public/countries.json";
  $json_data = file_get_contents($json_countries_path);

  $_SESSION["countries"] = json_decode($json_data, true);

  $countries = $_SESSION["countries"];

  // Verificar que existan los países
  if ($countries === null) {
    echo "Error";
  } else {

    if (!isset($_SESSION["random_num"])) {
      $_SESSION["random_num"] = rand(0, sizeof($countries) - 1);
    }

    $random_num = $_SESSION["random_num"];

    if (!isset($_SESSION["country_name"])) {
      $_SESSION["country_name"] = $countries[$random_num]['name'];
    }

    $country_name = $_SESSION["country_name"];
    $country_code = $countries[$random_num]['code'];
    $lowercase_country_code = strtolower($country_code);

    // Inicializar contador de partidas en caso de que no exista
    if (!isset($_SESSION["games_count"])) {
      $_SESSION["games_count"] = 0;
    }

    if (!isset($_SESSION["wins"])) {
      $_SESSION["wins"] = 0;
    }

    if (!isset($_SESSION["loses"])) {
      $_SESSION["loses"] = 0;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Manuel Seitz">
  <meta name="description" content="Juego de adivinar banderas creado con PHP">
  <title>Flag Guesser</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100..900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="32x32" href="../public/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../public/favicon-16x16.png">
  <link href="./output.css" rel="stylesheet">
  <link rel="preload" fetchpriority="high" as="image" href="https://flagcdn.com/w320/<?php echo $lowercase_country_code ?>.webp" type="image/webp">
</head>
<body>
  <div class="relative h-screen min-h-[900px] grid place-content-center">
    <main>
      <div class="flex flex-col items-center absolute top-0 right-0 mx-8 my-7 text-2xl font-semibold uppercase">
        Score
        <span 
          class="text-5xl <?php if (isset($_SESSION["is_answer_correct"]) && $_SESSION["is_answer_correct"]) echo 'score-correct-answer'; else if (isset($_SESSION["is_answer_correct"]) && $_SESSION["is_answer_correct"] == false) echo 'score-wrong-answer'; ?>"
        >
          <?php
            if (!isset($_SESSION["score"])) $_SESSION["score"] = 0;
            echo $_SESSION["score"];
          ?>
        </span>
      </div>
      <div class="flex flex-col justify-center items-center gap-10">
        <h1 class="uppercase text-5xl tracking-wide text-center font-bold">Flag Guesser</h1>
        <?php
          $splitted_country_name = str_split($country_name);
          echo 
            "<img 
                src='https://flagcdn.com/w320/{$lowercase_country_code}.webp'
                alt='flag' 
                width='440'
                class='flag'
                draggable='false'
              >";
        ?>
        <form action="./handle-game.php" method="post" class="flex flex-col items-center gap-6 mt-4">
          <div class="max-w-[750px] flex items-center justify-center flex-wrap gap-4 px-8">
            <?php foreach ($splitted_country_name as $index => $letter): ?>
              <?php

                // Renderizado condicional de cada cuadrado
                if ($letter === ' ') {
                  echo '<div class="w-[74px] h-[74px] grid place-items-center text-7xl">
                          <div class="w-1/2 h-[7px] bg-white"></div>
                        </div>';
                } else {
                  echo "<input 
                          type='text' 
                          name='letter{$index}' 
                          class='square border-none uppercase w-[74px] h-[74px] text-4xl text-center drop-shadow bg-gradient-to-br from-[rgb(75,75,75)] to-[rgb(85,85,85)]'
                          maxLength='1'
                          aria-label='letter {$index}'
                          required
                        />";
                }

              ?>
            <?php endforeach; ?>
          </div>
          <input 
            type="submit" 
            value="Guess" 
            class="rounded cursor-pointer shadow text-2xl px-8 py-3 bg-gradient-to-br from-sky-600 to-sky-700 hover:scale-105 transition-transform"
          >
        </form>
      </div>
    </main>
    <footer class="text-lg absolute bottom-0 left-0 p-6 flex items-center gap-5">
      <div>
        Games: 
        <span>
          <!-- Mostrar cantidad de partidas -->
          <?php echo $_SESSION["games_count"]; ?>
        </span>
      </div>
      <div>
        Correct: 
        <span class="text-emerald-500">
          <!-- Mostrar cantidad de respuestas correctas -->
          <?php echo $_SESSION["wins"]; ?>
        </span>
      </div>
      <div>
        Wrong: 
        <span class="text-red-500">
          <!-- Mostrar cantidad de respuestas incorrectas -->
          <?php echo $_SESSION["loses"]; ?>
        </span>
      </div>
    </footer>
  </div>
  <?php debug_to_console($country_name) ?>
</body>
</html>