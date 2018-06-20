module.export = {
  el: '#category',

  data: {
    data: window.$data,
    selected:[]
  },

  filters: {
    count: function(values){
      Object.size = function(obj) {
          var size = 0, key;
          for (key in obj) {
              if (obj.hasOwnProperty(key)) size++;
          }
          return size;
      };
      return Object.size(values);
    }
  },

  methods: {

    change: function(index , status){

      this.$http.post('admin/api/dpnblog/category/change' , {id:index , value:status})
      .then(function(success){
        location.reload();
      })
      .catch(function(error){
        location.reload();
      })

    },

    remove: function(){
      this.$http.post('admin/api/dpnblog/category/remove' , {id:this.selected})
      .then(function(success){
        location.reload();
      })
      .catch(function(error){
        location.reload();
      })
    }

  }
}

Vue.ready(module.export);
