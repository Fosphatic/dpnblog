module.exports = [

    {
        entry: {
          'admin-category': './app/views/admin/category.js'
        },
        output: {
            filename: "./app/bundle/[name].js"
        },
        module: {
            loaders: [
                { test: /\.vue$/, loader: "vue" }
            ]
        }
    }

];
