/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

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


/***/ })
/******/ ]);