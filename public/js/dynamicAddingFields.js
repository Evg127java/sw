$(document).ready(function () {
    /* Fields wrapper */
    var wrapper = $(".input_fields_wrap");

    /* Add_button id */
    var add_button = $(".add_field_button");

    /* Click button handling */
    $(add_button).click(function (e) {
        e.preventDefault();
        $(wrapper).append('<div><input type="file" class="file mb-2" name="images[]"/><a href="#" class="remove_field float-right">Remove</a></div>'); //add input box
    });

    /* Click on Remove text handling */
    $(wrapper).on("click", ".remove_field", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
    })
});
