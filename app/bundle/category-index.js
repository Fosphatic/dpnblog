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
/***/ (function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(module) {module.export = {
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

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(4)(module)))

/***/ }),
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */
/***/ (function(module, exports) {

	module.exports = function(module) {
		if(!module.webpackPolyfill) {
			module.deprecate = function() {};
			module.paths = [];
			// module.parent = undefined by default
			module.children = [];
			module.webpackPolyfill = 1;
		}
		return module;
	}


/***/ })
/******/ ]);