<?php

$menu = [['label' => 'Home', 'href' => 'index.php'], 
        ['label' => 'Welcome', 'href' => 'sucess.php'],
        ['label' => 'Logout', 'href' => 'logout.php']];
    ;
    foreach($menu as $a) {
        ?><li><a href="<?php echo $a['href']?>"><?php echo $a['label'] ?></a></li><?php
    }