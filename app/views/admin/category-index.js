module.export = {
  el: '#category',

  data: {
    data: window.$data
  },

  filters: {
    count: function(data){
      var count = '';
      this.$http.post('/admin/api/dpnblog/category/count' , {id:data} , function(success){
        count = success.status;
      }).catch(function(error){
        console.log('error')
      })
      return count;
    }
  }
}

Vue.ready(module.export);
