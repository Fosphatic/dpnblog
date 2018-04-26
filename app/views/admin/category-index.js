module.exports = {
    name: 'category',

    el  : '#category',

    data:   {
        category:  window.$data.category,
        catArray: {title: '', slug: '', sub_category: ''}
    },

    methods: {
      addCategory: function(event){
        event.preventDefault();
        this.$http.post('admin/pastheme/update' , {array:this.catArray}, function(){
          UIkit.notify('Saved', '');
        }).catch(function(data){
          UIkit.notify(data, 'danger');
        })
      }
    }
};

Vue.ready(module.exports);
