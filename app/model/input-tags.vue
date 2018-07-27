<template>
  <div>
    <div v-if="tags.length > 0" class="uk-panel uk-panel-box" style="padding:10px;">
      <ul class="uk-grid uk-grid-small" data-uk-margin="">
        <li v-for="(indis , tag) in tags">
          <span @click="remove(indis)" class="uk-badge uk-badge-success">
            {{tag}}
            <i class="uk-icon-close"></i>
          </span>
        </li>
      </ul>
    </div>
    <input class="uk-form-large uk-width-1-1" v-model="modelTag" v-bind:placeholder="'Press Space' | trans" @keyup.ctrl.space="addTags">
  </div>
</template>

<script>
  export default {

    props: ['tags' , 'placeholder'],

    data:{
      modelTag:''
    },

    methods: {
      addTags: function(event){
        this.tags.push(this.modelTag);
        this.modelTag = '';
      },

      remove:function(indis){
        this.tags.splice(indis, 1);
      }

    }
  }
</script>
