<?php $view->script('category-index' , 'dpnblog:app/bundle/category-index.js' , 'vue'); ?>
<aside id="category">

    <div class="uk-padding">
        <form class="uk-form" @submit="addCategory">
            <div class="uk-clearfix">
                <h1 class="uk-h2 uk-align-left">{{ 'Add New A Category' | trans }}</h1>
                <div class="uk-align-right">
                    <button class="uk-button uk-button-primary" type="submit">{{ 'Add' | trans }}</button>
                </div>
            </div>
            <div class="uk-grid uk-grid-large uk-margin">
                <div class="uk-width-medium-1-3">
                    <label class="uk-margin-small">{{'Category Name' | trans}}</label>
                    <input type="text" class="uk-width-1-1" v-model="catArray.title" required>
                </div>
                <div class="uk-width-medium-1-3">
                    <label class="uk-margin-small" v-model="">{{'Slug' | trans}}</label>
                    <input type="text" class="uk-width-1-1" v-model="catArray.slug">
                </div>
                <div class="uk-width-medium-1-3">
                    <label class="uk-margin-small">{{'Child Category' | trans}}</label>
                    <span class="uk-display-block uk-badge uk-badge-danger uk-margin-small" v-if="category.length == 0">{{'Not Found Category' | trans}}</span>
                    <select class="uk-width-1-1 uk-display-block" v-if="category.length != 0" v-model="catArray.sub_category">
                        <option v-for="cat in category" v-bind:value="cat.id">{{cat.title}}</option>
                    </select>
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
