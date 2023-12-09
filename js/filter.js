document.addEventListener("DOMContentLoaded", function () {
    // Filter buttons click event
    $(".button").on("click", function () {
        var filterValue = $(this).attr("data-filter");
        
        // Hide all apartment elements
        $(".col-lg-4").hide();
        
        // Show apartment elements that match the selected filter
        if (filterValue === "*") {
            $(".col-lg-4").show();
        } else {
            $(filterValue).show();
        }
    });
});