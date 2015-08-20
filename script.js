var sellProd = {
    get: function(limit,select,name,temp,category)
    {
        $.ajax({
            url     : 'index.php?route=product/category/getLastProduct',
            type    : 'post',
            data    : 'limit=' + limit + '&category=' + category,
            dataType: 'json',
            success: function(json) {
                var category_id = sellProd.getUrl('path');
                console.log(json);
                console.log(json.sell);
                var template = _.template($(temp).html());
                $(select).append(template({
                    main        : json,
                    name        : name,
                    categoryId  : category_id,
                }));
            }
        })
    },

    getUrl: function(name){
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    },

    reviewSort: function(count, array){
        var totalReting = _.pluck(array,'rating');

        var totalRetingInt = totalReting.map(function (x) {
            return parseInt(x, 10);
        });

        var sum = _.reduce(totalRetingInt, function(memo, num){
                return (memo + num); }, 0)/count;

        var totalSum = Math.round(sum);

        return totalSum;
    }
};