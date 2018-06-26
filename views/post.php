<?php $view->script('post', 'dpnblog:app/bundle/post.js', 'vue') ?>

<article class="uk-article">

    <?php if ($image = $post->get('image.src')): ?>
    <img src="<?= $image ?>" alt="<?= $post->get('image.alt') ?>">
    <?php endif ?>

    <h1 class="uk-article-title"><?= $post->title ?></h1>

    <p class="uk-article-meta">
      <a href="<?= $view->url('@blogcategory/id', ['id' => $post->category->id]) ?>"><?= $post->category->title ?></a>
      <?= __('Written by %name% on %date%', ['%name%' => $this->escape($post->user->name), '%date%' => '<time datetime="'.$post->date->format(\DateTime::ATOM).'" v-cloak>{{ "'.$post->date->format(\DateTime::ATOM).'" | date "longDate" }}</time>' ]) ?>
    </p>

    <div class="uk-margin"><?= $post->content ?></div>
    <?php if (!empty(array_filter($post->tags))): ?>
      <p class="uk-article-meta">
        <ul class="uk-grid uk-grid-small" data-uk-margin>
          <li>
            Tags:
          </li>
          <?php foreach ($post->tags as $tag): ?>
            <li>
              <a href="" class="uk-text-small"><?= $tag ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </p>
    <?php endif; ?>

    <?= $view->render('dpnblog/comments.php') ?>

</article>
