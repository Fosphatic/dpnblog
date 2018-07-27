module.exports = {

  el: '#app',

  name: 'likeAndShare',

  data:{
    msg:'',
    likes: [],
    hasLike: false,
    isAuth: false
  },

  created:function(){
    var postID = document.getElementById("postData");
    var data;
    this.$http.post('api/dpnblog/getlike' , {id:postID.getAttribute('postid'), like:postID.getAttribute('like')} , function(res){

      resJson = res;

      if (resJson.status.status === 200) {
        this.likes = resJson.data.query;
        this.hasLike = resJson.data.hasLike;
        this.isAuth = resJson.auth;
      }

      if (resJson.status.status === 400) {
        this.msg = resJson.status.err;
      }

    })
  },

  computed:{

    countLikes:function(){
      var ob, count, text;
      ob =  Object.keys(this.likes);
      if (ob.length) {
        count = '+'+ ob.length;
        text  = "Like";
      }else{
        text  = ""
        count = "";
      }
      return count + ' ' +this.$trans(text);
    }

  },

  methods: {

    like:function(){
      var postID = document.getElementById("postData");
      var data;
      if (this.isAuth !== false) {
        this.$http.post('api/dpnblog/like' , {id:postID.getAttribute('postid'), like:postID.getAttribute('like')} , function(data){

          json = data;

          if (json.status.status === 200) {
            this.$http.post('api/dpnblog/getlike' , {id:postID.getAttribute('postid'), like:postID.getAttribute('like')} , function(res){

              resJson = res;

              if (resJson.status.status === 200) {
                this.likes = resJson.data.query;
                this.hasLike = resJson.data.hasLike;
                this.isAuth = resJson.auth;
              }

              if (resJson.status.status === 400) {
                this.msg = resJson.status.err;
              }

            })
          }

          if (resJson.status.status === 400) {
            this.msg = resJson.status.err;
          }

        })
      }else {

        this.msg = this.$trans('You must log in first');

      }

    }

  }



}

Vue.ready(module.exports);
