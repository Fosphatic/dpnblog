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

	window.Category = {

	    el: '#category',

	    name: 'Category',

	    data: function () {
	        return {
	            data: window.$data,
	            category: window.$data.category,
	            sections: []
	        }
	    },

	    created: function () {

	        var sections = [];

	        _.forIn(this.$options.components, function (component, name) {

	            var options = component.options || {};

	            if (options.section) {
	                sections.push(_.extend({name: name, priority: 0}, options.section));
	            }

	        });

	        this.$set('sections', _.sortBy(sections, 'priority'));
	    },

	    ready: function () {
	        this.tab = UIkit.tab(this.$els.tab, {connect: this.$els.content});

	    },

	    methods: {

	        save: function () {
	            var data = {category: this.category, id: this.category.id};

	            this.$http.post('admin/api/dpnblog/category/save' , {data:data} , function(success){
	                UIkit.notify('Saved.', '');
	                window.history.replaceState({}, '', this.$url.route('admin/dpnblog/category/edit', {id: success.data.id}))

	                this.$set('category', success.data);

	            }).catch(function(error) {
	                UIkit.notify('Hata', 'danger');
	            });

	        }

	    },

	    components: {

	        settings: __webpack_require__(1)

	    }

	};

	Vue.ready(window.Category);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

	var __vue_script__, __vue_template__
	var __vue_styles__ = {}
	__vue_script__ = __webpack_require__(2)
	if (Object.keys(__vue_script__).some(function (key) { return key !== "default" && key !== "__esModule" })) {
	  console.warn("[vue-loader] app\\components\\category-settings.vue: named exports in *.vue files are ignored.")}
	__vue_template__ = __webpack_require__(3)
	module.exports = __vue_script__ || {}
	if (module.exports.__esModule) module.exports = module.exports.default
	var __vue_options__ = typeof module.exports === "function" ? (module.exports.options || (module.exports.options = {})) : module.exports
	if (__vue_template__) {
	__vue_options__.template = __vue_template__
	}
	if (!__vue_options__.computed) __vue_options__.computed = {}
	Object.keys(__vue_styles__).forEach(function (key) {
	var module = __vue_styles__[key]
	__vue_options__.computed[key] = function () { return module }
	})
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  var id = "_v-11de93ca/category-settings.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, __vue_template__)
	  }
	})()}

/***/ }),
/* 2 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.default = {

	    props: ['data', 'category'],

	    section: {
	        label: 'Category'
	    }
	};

/***/ }),
/* 3 */
/***/ (function(module, exports) {

	module.exports = "\n<div class=\"uk-grid pk-grid-large pk-width-sidebar-large uk-form-stacked\" data-uk-grid-margin>\n    <div class=\"pk-width-content\">\n\n        <div class=\"uk-form-row\">\n            <input class=\"uk-width-1-1 uk-form-large\" type=\"text\" :placeholder=\"'Enter Title' | trans\" v-model=\"category.title\" v-validate:required>\n        </div>\n        <hr />\n        <div class=\"uk-form-row\">\n          <input id=\"form-meta-title\" class=\"uk-width-1-1 uk-form-large\" type=\"text\" :placeholder=\"'Meta Title' | trans\" v-model=\"category.data.meta['og:title']\">\n        </div>\n        <div class=\"uk-form-row\">\n          <textarea class=\"uk-width-1-1 uk-form-large uk-height-medium\" id=\"form-meta-description\" :placeholder=\"'Meta Desc' | trans\" rows=\"8\" v-model=\"category.data.meta['og:description']\"></textarea>\n        </div>\n\n    </div>\n\n    <div class=\"pk-width-sidebar\">\n\n      <div class=\"uk-panel uk-panel-box\">\n        <div>\n          <label class=\"uk-form-label\">{{'Sub Category' | trans}}</label>\n\n          <ul class=\"uk-list uk-form-row\">\n            <li v-if=\"data.other == 0\">\n              <p class=\"uk-text-small uk-text-center\">\n                {{'Not Found Sub Category' | trans}}\n              </p>\n            </li>\n            <li class=\"uk-form-controls\" v-for=\"sub in data.other\">\n              <label class=\"uk-form-label\">\n                <input type=\"checkbox\" :value=\"sub.id\" v-model=\"category.sub_category\">\n                {{sub.title}}\n              </label>\n            </li>\n          </ul>\n\n        </div>\n      </div>\n\n      <div class=\"uk-form-row uk-margin\">\n          <label for=\"form-slug\" class=\"uk-form-label\">Slug</label>\n          <div class=\"uk-form-controls\">\n              <input id=\"form-slug\" class=\"uk-width-1-1\" v-model=\"category.slug\" type=\"text\">\n          </div>\n      </div>\n\n\n      <div class=\"uk-form-row uk-margin\">\n          <label for=\"form-slug\" class=\"uk-form-label\">Icon</label>\n          <div class=\"uk-form-controls\">\n              <input id=\"form-slug\" list=\"iconsList\" v-model=\"category.data.icon\" class=\"uk-width-1-1\" type=\"text\">\n          </div>\n          <datalist id=\"iconsList\">\n            <option v-for=\"icon in data.icons\" :value=\"icon\">{{icon}}</option>\n          </datalist>\n          <p v-if=\"data.icons.length = 0\" class=\"uk-text-small uk-margin-small-left uk-margin-small-top\">\n            <a :href=\"$url.route('/admin/dpnblog/settings/icon')\">{{'First you need to add icon.' | trans}}</a>\n          </p>\n      </div>\n    </div>\n</div>\n";

/***/ })
/******/ ]);