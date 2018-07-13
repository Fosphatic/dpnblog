<?php if ($like === true): ?>
  <?php $view->script('like', 'dpnblog:app/bundle/like.js', 'vue') ?>
  <?php $view->style('like-css', 'dpnblog:assets/css/like.css') ?>
<?php endif; ?>

<?php if ($like === true): ?>

  <div id="like" postid="<?= $post->id ?>" class="uk-block uk-block-muted uk-flex uk-flex-middle uk-flex-center">
    <button class="uk-button uk-button-primary uk-button-large" @click="OnLike('post' , '<?= $post->id ?>')"><i class="uk-icon-heart"></i> Like The Post</button>
    <a v-if="timeLoad === false" class="uk-text-lead uk-margin-left" href="#likesModal" data-uk-modal>{{count}}</a>

    <div id="likesModal" class="uk-modal">
      <div class="uk-modal-dialog tm-height-large">
          <a class="uk-modal-close uk-close"></a>
          <ul class="uk-list uk-list-line">
            <li v-for="like in likes">
              <?php if ($app->module('profiles')): ?>
                <?= $view->render('dpnblog:views/components/profile/profiles.php') ?>
              <?php else: ?>
                <?= $view->render('dpnblog:views/components/profile/dpnblog.php') ?>
              <?php endif; ?>
            </li>
          </ul>
      </div>
    </div>

  </div>



<?php endif; ?>
