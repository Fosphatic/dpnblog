<?php if ($like === true): ?>
  <?php $view->script('like', 'dpnblog:app/bundle/like.js', 'vue') ?>
  <?php $view->style('like-css', 'dpnblog:assets/css/like.css') ?>
<?php endif; ?>

<?php if ($like === true): ?>
    <ul class="uk-grid-small uk-grid">

      <li>
        <button class="uk-button uk-button-primary uk-button-small"><i class="uk-icon-facebook"></i> facebook</button>
      </li>

      <li>
        <button class="uk-button uk-button-danger uk-button-small"><i class="uk-icon-google-plus"></i> facebook</button>
      </li>

      <li>
        <button class="uk-button uk-button-primary uk-button-small"><i class="uk-icon-twitter"></i> facebook</button>
      </li>

      <?php if ($like === true): ?>
        <li id="like" class="uk-flex-middle">
          <button class="uk-button uk-button-muted uk-button-small"><i class="uk-icon-heart"></i> Like</button>
          <a class="uk-text-small uk-margin-small-left">+18 liked</a>
        </li>
      <?php endif; ?>
    </ul>
<?php endif; ?>
