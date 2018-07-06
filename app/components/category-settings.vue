<template>
  <div class="uk-grid pk-grid-large pk-width-sidebar-large uk-form-stacked" data-uk-grid-margin>
      <div class="pk-width-content">

          <div class="uk-form-row">
              <input class="uk-width-1-1 uk-form-large" type="text" :placeholder="'Enter Title' | trans" v-model="category.title" v-validate:required>
          </div>
          <hr />
          <div class="uk-form-row">
            <input id="form-meta-title" class="uk-width-1-1 uk-form-large" type="text" :placeholder="'Meta Title' | trans" v-model="category.data.meta['og:title']">
          </div>
          <div class="uk-form-row">
            <textarea class="uk-width-1-1 uk-form-large uk-height-medium" id="form-meta-description" :placeholder="'Meta Desc' | trans" rows="8" v-model="category.data.meta['og:description']"></textarea>
          </div>

      </div>

      <div class="pk-width-sidebar">

        <div class="uk-panel uk-panel-box">
          <div>
            <label class="uk-form-label">{{'Sub Category' | trans}}</label>

            <ul class="uk-list uk-form-row">
              <li v-if="data.other == 0">
                <p class="uk-text-small uk-text-center">
                  {{'Not Found Sub Category' | trans}}
                </p>
              </li>
              <li class="uk-form-controls" v-for="sub in data.other">
                <label class="uk-form-label">
                  <input type="checkbox" :value="sub.id" v-model="category.sub_category">
                  {{sub.title}}
                </label>
              </li>
            </ul>

          </div>
        </div>

        <div class="uk-form-row uk-margin">
            <label for="form-slug" class="uk-form-label">Slug</label>
            <div class="uk-form-controls">
                <input id="form-slug" class="uk-width-1-1" v-model="category.slug" type="text">
            </div>
        </div>


        <div class="uk-form-row uk-margin">
            <label for="form-slug" class="uk-form-label">Icon</label>
            <div class="uk-form-controls">
                <input id="form-slug" list="iconsList" v-model="category.data.icon" class="uk-width-1-1" type="text">
            </div>
            <datalist id="iconsList">
              <option v-for="icon in data.icons" :value="icon">{{icon}}</option>
            </datalist>
            <p v-if="data.icons.length = 0" class="uk-text-small uk-margin-small-left uk-margin-small-top">
              <a :href="$url.route('/admin/dpnblog/settings/icon')">{{'First you need to add icon.' | trans}}</a>
            </p>
        </div>
      </div>
  </div>
</template>

<script>
  export default {

      props: ['data' , 'category'],

      section: {
          label: 'Category'
      }
  };
</script>
