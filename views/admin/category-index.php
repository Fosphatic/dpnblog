<?php $view->script('category-index' , 'dpnblog:app/bundle/category-index.js' , 'vue'); ?>
<aside id="category" class="uk-form">
  <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin="">
    <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin="">

        <h2 class="uk-margin-remove">{{data.category | count}} <?= $categories ?></h2>
        <div v-if="selected.length > 0" class="uk-margin-left" >
            <ul class="uk-subnav pk-subnav-icon">
                <li><a class="pk-icon-delete pk-icon-hover" :title="'Delete' | trans" data-uk-tooltip="{delay: 500}" @click="remove" v-confirm="'Delete Posts?'"></a></li>
            </ul>
        </div>

    </div>
    <div data-uk-margin="">

        <a class="uk-button uk-button-primary" href="@dpnblog/category/edit">{{'Add Category' | trans}}</a>

    </div>
  </div>
  <table class="uk-table uk-table-hover uk-table-middle">
      <thead>
          <tr>
              <th class="pk-table-width-minimum"><input type="checkbox" v-check-all:selected.literal="input[name=id]" number=""></th>
              <th class="pk-table-min-width-200 pk-table-order uk-visible-hover-inline">Title<i class="uk-icon-justify uk-margin-small-left pk-icon-arrow-down uk-invisible"></i></th>
              <th class="pk-table-width-100 uk-text-center">
                Status
              </th>
              <th v-if="data.sub === 0" class="pk-table-width-200 uk-text-center pk-table-order uk-visible-hover-inline">Sub Category</th>
              <th class="pk-table-width-100 uk-text-center pk-table-order uk-visible-hover-inline">Icon</th>
              <th class="pk-table-width-200 pk-table-min-width-200">URL</th>
          </tr>
      </thead>
      <tbody>

        <tr v-for="category in data.category">
          <td><input type="checkbox" name="id" :value="category.id"></td>
          <td><a :href="$url.route('admin/dpnblog/category/edit' , {id: category.id})">{{category.title}}</a></td>
          <td class="uk-text-center">
            <a v-if="category.status == 2" class="pk-icon-circle-success" title="Published" v-on:click="change(category , 3)"></a>
            <a v-if="category.status == 3" class="pk-icon-circle-danger" title="UnPublished" v-on:click="change(category , 2)"></a>
            <a v-if="category.status == 0" class="pk-icon-circle" title="Draft" v-on:click="change(category , 2)"></a>
            <a v-if="category.status == 1" class="pk-icon-circle-warning" title="Pending" v-on:click="change(category , 2)"></a>
          </td>
          <td v-if="data.sub === 0"  class="uk-text-center"><a :href="$url.route('admin/dpnblog/category' , {sub: category.id})">{{'Go to Sub Category'}}</a></td>
          <td>{{category.data.icon}}</td>
          <td>{{category.slug}}</td>
        </tr>

      </tbody>
  </table>

  <h3 v-if="data.category == 0" class="uk-h1 uk-text-muted uk-text-center">{{'No categories found.' | trans}}</h3>

</aside>
