<script type="text/html" id="right-block-sell-top">
    <% if(main.sell.length > 0 ) { %>
    <div class="my-catalog-its-buy">
        <div class="my-catalog-little-prod">
            <p class="my-catalog-little-heanding"><span><%= name %></span></p>
            <% _.each(main.sell, function(main) { %>
            <div class="my-catalog-top-prod">
                <img src="<%= main.image %>" class="my-catalog-little-prod-img">
                <div>
                    <% var totaltotal = sellProd.reviewSort(main.total_review,main.review); %>
                </div>
                <p class="my-catalog-little-prod-title"><%= main.name %></p>
                <p class="my-catalog-little-prod-new-price">
                <% if(main.special > 0) { %>
                <span class="my-catalog-little-prod-old-price"><%= main.special %></span><%= main.price %></p>
                <% } else { %>
                <p class="my-catalog-little-prod-new-price"><%= main.price %></p>
                <% } %>
                    <div class="my-product-rating-two">
                    <p class="my-product-review-num">
                        <% if(isNaN(totaltotal)) { %>
                        <span class="my-review-rating-bad"></span>
                        <span class="my-review-rating-bad"></span>
                        <span class="my-review-rating-bad"></span>
                        <span class="my-review-rating-bad"></span>
                        <span class="my-review-rating-bad"></span>
                        <% } else { %>
                        <% for(var i = 1; i <= 5; i++) { %>
                        <% if(totaltotal < i) { %>
                        <span class="my-review-rating-bad"></span>
                        <% } else { %>
                        <span class="my-review-rating"></span>
                        <% } %>
                        <% } %>
                        <% } %>
                        <span class="my-review-rating-count">Отзывов <%= main.total_review %></span></p>
                </div>
            </div>
            <% }); %>
        </div>
    </div>
    <% } %>
</script>
<script>
    $(document).ready(function(){
        console.log(sellProd.getUrl('path').substring(0,2));
        sellProd.get(1,'.for-sell-top','Только что<br>купили','#right-block-sell-top',sellProd.getUrl('path').substring(0,2));
        sellProd.get(2,'.for-sell-top','Топ продаж','#right-block-sell',sellProd.getUrl('path').substring(0,2));
    });

</script>