<?php

  /*
    Fix per versione superiore alla 3.17
    https://docs.wp-rocket.me/article/1835-automatic-lazy-rendering#:~:text=WP%20Rocket%203.17%20introduces%20a,visitors%20scroll%20down%20the%20page.

    https://www.notion.so/beconcept/Beconcept-Filtro-WPRocket-in-stack-128ed877ea618046a99ec78ba1ef64b1?pvs=4
  */
  add_filter( 'rocket_lrc_optimization', '__return_false' , 999);


?>