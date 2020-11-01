var spiUrl = "https://store.playstation.com/store/api/chihiro/00_09_000/container/BG/en/999/";

$(function() {

    var $container = $("#container");

    $.each($(".hdn_ids"), function(idx) {

        $.ajax({
            url: spiUrl + $(this).val(),
        }).done(function(data) {

            var row = new Row();

            row.setRow();
            row.setName(data.name);
            row.setImage(data.images[0].url);
            row.setPrice(data.default_sku.display_price);
            row.setRemove(data.id);

            if ($("#spinner").is(":visible")) {
                $container.html();
            }
            
            $container.append(row.toHtml());

            console.log(data);
        });
    });
});