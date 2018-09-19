<?php $view->script('post', 'dpnblog:app/bundle/post.js', 'vue') ?>
<?php $view->style('dpn-css' , 'dpnblog:assets/css/dpnblog.min.css');?>
<?php $view->style('highlight-css' , 'dpnblog:assets/highlight/styles/atom-one-dark.css') ?>
<?php $view->script('highlight-js' , 'dpnblog:assets//highlight//highlight.pack.js' , ['jquery']) ?>
<script>hljs.initHighlightingOnLoad();</script>
<article class="uk-article">

    <?php if ($image = $post->get('image.src')): ?>
    <img src="<?= $image ?>" alt="<?= $post->get('image.alt') ?>">
    <?php endif ?>

    <h1 class="uk-article-title"><?= $post->title ?></h1>

    <?= $view->render('dpnblog:views/components/author.php') ?>

    <div class="uk-margin"><?= $post->content ?></div>
    <?php if (!empty(array_filter($post->tags))): ?>
      <p class="uk-article-meta">
        <ul class="uk-grid uk-grid-small" data-uk-margin>
          <li>
            Tags:
          </li>
          <?php foreach ($post->tags as $tag): ?>
            <li>
              <a href="<?= $view->url('@blogcategory/tags' , ['tags' => $tag]) ?>" class="uk-text-small"><?= $tag ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </p>
    <?php endif; ?>

    <?= $view->render('dpnblog:views/comments.php') ?>

</article>
