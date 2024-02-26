<?php
  function render_input_square ($index, $letter) {
    if ($letter === ' ') {
      echo '<div class="w-[74px] h-[74px] grid place-items-center text-7xl">
              <div class="w-1/2 h-[7px] bg-white"></div>
            </div>';
    } elseif (isset($_SESSION["hints_index"]) && in_array($index, $_SESSION["hints_index"])) {
      echo "<div class='uppercase w-[74px] h-[74px] grid place-items-center text-7xl'>{$letter}</div>";
    } else {
      echo "<input 
              type='text' 
              name='letter{$index}' 
              class='square border-none uppercase w-[74px] h-[74px] text-4xl text-center drop-shadow bg-gradient-to-br from-[rgb(75,75,75)] to-[rgb(85,85,85)]'
              maxLength='1'
              aria-label='letter {$index}'
              form='handle-game'
              required
            />";
    }
  }
?>