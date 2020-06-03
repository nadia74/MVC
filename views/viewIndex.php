<?php
$this->_t = 'Mon blog';
foreach($articles as $article): ?>
<h2><?= $article->title() ?></h2>
<p><?= $article->content() ?></p>

<?php 
endforeach; ?>