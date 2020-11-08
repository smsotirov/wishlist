// PS Strore Json API URL template.
var apiUrltempl = "https://store.playstation.com/store/api/chihiro/00_09_000/container/{loc2}/{loc1}/999/";

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};//setCookie


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
};//getCookie


$(function() {

    const cookieName = "has_plus";
    const $radios = $("input:radio[name=has_plus]");

    // Check / set the "Has PS Plus" choice
    const hasPlus = getCookie(cookieName);
    if (hasPlus == "") {
        setCookie(cookieName, "1", 365);
    } else {
        $radios.filter("[value=" + hasPlus + "]").prop("checked", true);
    }

    // Set the discounts option and reload the page. 
    $radios.on("click", function () {
        setCookie(cookieName, $("input[name='has_plus']:checked").val(), 365);
        location.reload();
    });


    // Iterate over all games URLs.
    $.each($(".hdn_ids"), function() {

        // Get the locale from saved URL and set the API URL with coresponding values. Then add the game ID to the API URL.
        const value = $(this).val();
        const idxUrl = new URL(value);
        const urlPath = idxUrl.pathname;
        const locale = urlPath.split("/")[1].split("-");
        const apiUrl = apiUrltempl.replace("{loc2}", locale[1].toUpperCase()).replace("{loc1}", locale[0]) + urlPath.split("/").pop();

        $.ajax({
            url: apiUrl,
        }).done(function(data) {

            // Set the game row.
            var row = new Row();
            row.setRow();

            // Set game name, image and remove URL.
            row.setName(data.name, value);
            row.setImage(data.images[0].url);
            row.setRemove(value);

            // Set game price without or with discount.
            if ($.isEmptyObject(data.default_sku.rewards)) {
                row.setPrice(data.default_sku.display_price);
            } else {

                // ... if discount is PS Plus or normal discount.
                if (hasPlus == "1" && typeof data.default_sku.rewards[0].bonus_discount != "undefined") {
                    row.setPrice(data.default_sku.rewards[0].bonus_display_price);
                    row.setOldPrice(data.default_sku.display_price);
                    row.setDiscount(data.default_sku.rewards[0].bonus_discount + "%");
                    row.showPlusIcon();
                } else {
                    row.setPrice(data.default_sku.rewards[0].display_price);
                    row.setOldPrice(data.default_sku.display_price);
                    row.setDiscount(data.default_sku.rewards[0].discount + "%");
                }

                // Set the discount availability dates.
                row.setDiscountDates(data.default_sku.rewards[0].start_date, data.default_sku.rewards[0].end_date);
            }

            // Append the game to the container.
            $("#container").append(row.toHtml());
        });
    });

    // Conformation for game delete.
    $(".confirmation").on("click", function() {
        return confirm("Are you sure?");
    });
});
