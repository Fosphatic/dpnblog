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

        settings: require('../../components/category-settings.vue')

    }

};

Vue.ready(window.Category);
