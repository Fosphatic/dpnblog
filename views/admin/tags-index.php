<?php $view->script('tags-index' , 'dpnblog:app/bundle/tags-index.js' , 'vue') ?>

<main id="tags">
  <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin="">
    <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin="">

        <h2 class="uk-margin-remove">{{data.tags | count}} Tags</h2>
        <div v-if="selected.length > 0" class="uk-margin-left" >
            <ul class="uk-subnav pk-subnav-icon">
                <li><a class="pk-icon-delete pk-icon-hover" :title="'Delete' | trans" data-uk-tooltip="{delay: 500}" @click="remove" v-confirm="'Delete Posts?'"></a></li>
            </ul>
        </div>

    </div>
    <div>

        <a class="uk-button uk-button-primary" href="#newTags" data-uk-modal>Add Tags</a>

        <div id="newTags" class="uk-modal">
            <div class="uk-modal-dialog">
                <form class="uk-form" @submit.prevent="add">
                    <div class="uk-modal-header"><h3>News Tag Add</h3></div>

                    <div>
                      <div class="uk-form-row">
                        <label class="uk-form-label" for="">Tags Name</label>
                        <div class="uk-form-controls">
                          <input type="text" placeholder="Linux" v-model="form.title" class="uk-form-large uk-width-1-1"/>
                        </div>
                      </div>
                      <div class="uk-form-row">
                        <label class="uk-form-label" for="">Slug (Autoincrement)</label>
                        <div class="uk-form-controls">
                          <input type="text" v-model="form.slug" class="uk-form-large uk-width-1-1"/>
                        </div>
                      </div>
                    </div>

                    <div class="uk-modal-footer uk-text-right">
                      <button class="uk-button uk-modal-close">Cancel</button>
                      <button class="uk-button uk-button-primary js-modal-ok" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
  </div>

  <table class="uk-table uk-table-hover uk-table-middle uk-form">
      <thead>
        <tr>
          <th class="pk-table-width-minimum"><input type="checkbox" v-check-all:selected.literal="input[name=id]"></th>
          <th class="pk-table-width-min-200 pk-table-order uk-visible-hover-inline">Title</th>
          <th class="pk-table-width-100 ">Slug</th>
          <th class="pk-table-width-100 uk-text-right pk-table-order uk-visible-hover-inline">Process</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(indis , tags) in data.tags">
          <td><input type="checkbox" name="id" :value="tags.id"></td>
          <td>{{tags.title}}</td>
          <td>{{tags.slug}}</td>
          <td class="uk-text-right"><a v-on:click="otherRemove(tags.id)" class="pk-icon-delete"></a></td>
        </tr>
      </tbody>

  </table>
  <h3 v-if="data.tags == 0" class="uk-h1 uk-text-muted uk-text-center">{{'No tags found.' | trans}}</h3>
</main>
