// PS Strore Json API URL for 'en-bg' locale 
var apiUrl = "https://store.playstation.com/store/api/chihiro/00_09_000/container/BG/en/999/";

$(function() {

    // iterate over all games IDs
    $.each($(".hdn_ids"), function(idx) {

        $.ajax({
            url: apiUrl + $(this).val(),
        }).done(function(data) {

            var row = new Row();

            // Set the row
            row.setRow();

            // Set game name, image and remove ID
            row.setName(data.name, data.id);
            row.setImage(data.images[0].url);
            row.setRemove(data.id);    

            // Set game price without or with discount
            if ($.isEmptyObject(data.default_sku.rewards)) {
                row.setPrice(data.default_sku.display_price);
            } else {

                // if discount is PS Plus or normal discount
                if (typeof data.default_sku.rewards[0].bonus_discount != "undefined") {
                    row.setPrice(data.default_sku.rewards[0].bonus_display_price);
                    row.setOldPrice(data.default_sku.display_price);
                    row.setDiscount(data.default_sku.rewards[0].bonus_discount + "%");
                    row.showPlusIcon();
                } else {
                    row.setPrice(data.default_sku.rewards[0].display_price);
                    row.setOldPrice(data.default_sku.display_price);
                    row.setDiscount(data.default_sku.rewards[0].discount + "%");
                }

                // Set the doscount availability dates
                row.setDiscountDates(data.default_sku.rewards[0].start_date, data.default_sku.rewards[0].end_date);
            }

            // Append the game to the container
            $("#container").append(row.toHtml());
        });
    });
});
