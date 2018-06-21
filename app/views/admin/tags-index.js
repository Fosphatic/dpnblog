module.exports = {
  el: '#tags',

  name: 'Tags',

  data: {
      data: window.$data,
      form:{title:'' , slug:''},
      selected : []
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

    add: function(){
      this.$http.post('admin/api/dpnblog/add' , {data:this.form})
      .then(function(res){
        if (res.status === 200) {
          this.form = {title:'' , slug:''};
          location.reload();
        }
      })

      .catch(function(){

      })
    },

    remove: function(){
      this.$http.post('admin/api/dpnblog/removetags' , {id:this.selected})
      .then(function(success){
        location.reload();
      })
      .catch(function(error){
        location.reload();
      })
    },

    otherRemove: function(values){
      this.$http.post('admin/api/dpnblog/removetags' , {id:values})
      .then(function(success){
        location.reload();
      })
      .catch(function(error){
        location.reload();
      })
    }

  }

};

Vue.ready(module.exports);
