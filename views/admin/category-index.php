<?php $view->script('category-index' , 'dpnblog:app/bundle/category-index.js' , 'vue'); ?>
<aside id="category" class="uk-form">
  <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin="">
    <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin="">

        <h2 class="uk-margin-remove">{{data.category.length}} Category</h2>

        <div class="pk-search">
            <div class="uk-search">
                <input class="uk-search-field" type="text">
            </div>
        </div>

    </div>
    <div data-uk-margin="">

        <a class="uk-button uk-button-primary" href="/admin/dpnblog/category/edit">{{'Add Category' | trans}}</a>

    </div>
  </div>
  <table class="uk-table uk-table-hover uk-table-middle">
      <thead>
          <tr>
              <th class="pk-table-width-minimum"><input type="checkbox" number=""></th>
              <th class="pk-table-min-width-200 pk-table-order uk-visible-hover-inline">Title<i class="uk-icon-justify uk-margin-small-left pk-icon-arrow-down uk-invisible"></i></th>
              <th class="pk-table-width-100 uk-text-center">
                Status
              </th>
              <th class="pk-table-width-100 uk-text-center pk-table-order uk-visible-hover-inline">Sub Category</th>
              <th class="pk-table-width-100 uk-text-center pk-table-order uk-visible-hover-inline">Icon</th>
              <th class="pk-table-width-200 pk-table-min-width-200">URL</th>
          </tr>
      </thead>
      <tbody>

        <tr v-for="category in data.category">
          <td><input type="checkbox" name="id" value="1"></td>
          <td><a :href="$url.route('admin/dpnblog/category/edit' , {id: category.id})">{{category.title}}</a></td>
          <td class="uk-text-center"><a class="pk-icon-circle" title="Draft"></a></td>
          <td>{{category.id | count}}</td>
          <td>{{category.icon}}</td>
          <td>{{category.slug}}</td>
        </tr>

      </tbody>
  </table>

  <h3 v-if="data.category == 0" class="uk-h1 uk-text-muted uk-text-center">{{'No categorys found.' | trans}}</h3>

</aside>
