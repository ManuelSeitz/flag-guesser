<?php
  function handle_score_animations () {
    if (isset($_SESSION["is_answer_correct"]) && $_SESSION["is_answer_correct"]) {
      echo 'score-correct-answer';
    } else if (isset($_SESSION["is_answer_correct"]) && $_SESSION["is_answer_correct"] === false) {
      echo 'score-wrong-answer';
    }
  }
?>