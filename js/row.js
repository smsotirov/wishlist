/**
 * This is javascript object representing one game row.
 */
class Row {
    constructor() {
        this.$row = null;

        this.setRow = function() {
            this.$row = $("#template").clone();
        }; //setRow

        this.setImage = function(src) {
            this.$row.find(".image img").attr("src", src);
        }; //setImage

        this.setName = function(name, id) {
            this.$row.find(".name").find(".game-name").html(name);
            this.$row.find(".name").find(".game-url").attr("href", "https://store.playstation.com/en-bg/product/" + id);
        }; //setName

        this.setPrice = function(price) {
            this.$row.find(".price").html(price);
        }; //setPrice

        this.setOldPrice = function(old_price) {
            this.$row.find(".old-price").html(old_price);
        }; //setOldPrice

        this.setDiscount = function(discount) {
            this.$row.find(".discount").html(discount);
        }; //setDiscount

        this.setRemove = function(id) {
            this.$row.find(".delete a").attr("href", "action.php?delete=" + id);
        }; //setRemove

        this.setDiscountDates = function(start, end) {
            const dstart = new Date(start);
            const dend = new Date(end);
            this.$row.find(".date-start").html(dstart.toLocaleDateString());
            this.$row.find(".date-end").html(dend.toLocaleDateString());
        }; //setDiscountDates

        this.showPlusIcon = function() {
            this.$row.find(".plus-icon-container").show();
            this.$row.find(".price").addClass("plus-price");
        };//showPlusIcon

        this.toHtml = function() {
            return this.$row.html();
        };// toHtml
    };
};//Row
