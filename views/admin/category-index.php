<?php $view->script('category-index' , 'dpnblog:app/bundle/category-index.js' , 'vue'); ?>
<aside id="category" class="uk-form">
  <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin="">
    <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin="">

        <h2 class="uk-margin-remove">0 Category</h2>



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
                  <div class="uk-form-select pk-filter"> <span>Status</span> <select> <option value="">Status</option> <optgroup label="Filter by"> <option value="0">Draft</option><option value="1">Pending Review</option><option value="2">Published</option><option value="3">Unpublished</option> </optgroup>  </select>  </div>
              </th>
              <th class="pk-table-width-100">
                  <div class="uk-form-select pk-filter"> <span>Author</span> <select> <option value="">Author</option> <optgroup label="Filter by">  </optgroup>  </select>  </div>

              </th>
              <th class="pk-table-width-100 uk-text-center pk-table-order uk-visible-hover-inline">Comments<i class="uk-icon-justify uk-margin-small-left pk-icon-arrow-down uk-invisible"></i></th>
              <th class="pk-table-width-100 pk-table-order uk-visible-hover-inline uk-active">Date<i class="uk-icon-justify uk-margin-small-left pk-icon-arrow-up"></i></th>
              <th class="pk-table-width-200 pk-table-min-width-200">URL</th>
          </tr>
      </thead>
      <tbody>
        <tr>
          <tr>
            <td><input type="checkbox" name="id" value="1"></td>
            <td>
            </td>
          </tr>
        </tr>
      </tbody>
  </table>
  <h3 class="uk-h1 uk-text-muted uk-text-center" style="">No categorys found.</h3>
</aside>
