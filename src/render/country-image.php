<?php
  function render_country_image ($lowercase_country_code) {
    echo "<picture>
            <source
              type='image/webp'
              srcset='https://flagcdn.com/w320/{$lowercase_country_code}.webp,
                https://flagcdn.com/w640/{$lowercase_country_code}.webp 2x'>
            <source
              type='image/png'
              srcset='https://flagcdn.com/w320/{$lowercase_country_code}.png,
                https://flagcdn.com/w640/{$lowercase_country_code}.png 2x'>
            <img 
              src='https://flagcdn.com/w320/{$lowercase_country_code}.webp'
              alt='flag' 
              width='440'
              class='flag'
              draggable='false'
            >
          </picture>";
  }
?>