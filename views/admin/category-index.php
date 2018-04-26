<?php $view->script('category-index' , 'dpnblog:app/bundle/category-index.js' , 'vue'); ?>
<aside id="category">

    <div class="uk-padding">
        <form>
            <div class="uk-flex">
                <h1 class="uk-h2">{{ 'Add New A Category' | trans }}</h1>
                <div class="uk-float-right">
                    <button class="uk-button uk-button-primary">{{ 'Add' | trans }}</button>
                </div>
            </div>
        </form>
    </div>

    <ul>
        <li v-for="cat in category">
            {{cat.title}}
        </li>
    </ul>

</aside>