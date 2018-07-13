module.exports = {
  el: '#like',

  data: {
    likes : [],
    timeLoad: true
  },

  created: function(){
    var postID = document.getElementById("like").getAttribute('postid');

    this.$http.post('api/dpnblog/getlike' , {id:postID} , function(data){

      if (data.status == 200) {

        this.$set('likes', data.liked);
        this.timeLoad = false;

      }

    })

  },

  computed: {

    count: function(){

      var ob, count, text;
      ob =  Object.keys(this.likes);
      if (ob.length) {
        count =  '+'+ ob.length;
        text = "Like";
      }else{
        text = ""
        count = "";
      }

      return count + ' ' +this.$trans(text);

    }

  },

  methods: {

    OnLike: function(status , postId){
      this.$http.post('api/dpnblog/onlike' , {like:status , post:postId} ,function(data){
        if (data.status == 200) {

          var postID = document.getElementById("like").getAttribute('postid');

          this.$http.post('api/dpnblog/getlike' , {id:postID} , function(data){

            if (data.status == 200) {

              this.$set('likes', data.liked);
              this.timeLoad = false;

            }

          })

        }

      })

    }

  }

}

Vue.ready(module.exports);
