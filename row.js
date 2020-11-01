/**
 * Test comment 
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

        this.setName = function(name) {
            this.$row.find(".name").html(name);
        }; //setName

        this.setPrice = function(price) {
            this.$row.find(".price").html(price);
        }; //setPrice

        this.setRemove = function(id) {
            this.$row.find(".delete a").attr("href", "action.php?delete=" + id);
        }; //setPrice

        this.toHtml = function() {
            return this.$row.html();
        }// toHtml
    }
}//Row
