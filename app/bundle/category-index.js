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
	    name: 'category',

	    el  : '#category',

	    data:   {
	        categorys:  window.$data.category,
	        cat: {title:'' , slug: '' , sub_category: '' },
	    },

	    methods: {
	      addCategory: function(event){
	        event.preventDefault();

	        this.$http.post('admin/api/dpnblog/post/categoryadd' , {category:this.cat}, function(){
	          location.reload();
	        }).catch(function(data){
	          UIkit.notify('There is a problem', 'danger');
	        })
	        this.cat = {title:'' , slug: '' , sub_category: '' };
	      }
	    }
	};

	var vm = Vue.ready(module.exports);


/***/ })
/******/ ]);